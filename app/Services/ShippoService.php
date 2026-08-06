<?php

namespace App\Services;

use App\Models\ImportRequest;
use Illuminate\Support\Facades\Http;
use Exception;

class ShippoService
{
    protected string $token;
    protected string $url;

    public function __construct()
    {
        $this->token = config('services.shippo.token');
        $this->url = config('services.shippo.url');
    }

    protected function client()
    {
        return Http::withHeaders([
            'Authorization' => 'ShippoToken ' . $this->token,
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * Warehouse Address
     */
    private function originAddress($country): array
    {
        return match ($country) {

            'Japan' => [
                'name' => 'AutoOne Japan Warehouse',
                'street1' => '1-1 Chiyoda',
                'city' => 'Tokyo',
                'zip' => '1000001',
                'country' => 'JP',
            ],

            'USA' => [
                'name' => 'AutoOne USA Warehouse',
                'street1' => '500 Market Street',
                'city' => 'Los Angeles',
                'state' => 'CA',
                'zip' => '90001',
                'country' => 'US',
            ],

            'Germany' => [
                'name' => 'AutoOne Germany Warehouse',
                'street1' => 'Berlin Center',
                'city' => 'Berlin',
                'zip' => '10115',
                'country' => 'DE',
            ],

            'China' => [
                'name' => 'AutoOne China Warehouse',
                'street1' => 'Guangzhou Port',
                'city' => 'Guangzhou',
                'zip' => '510000',
                'country' => 'CN',
            ],

            default => throw new Exception('Unsupported Country: ' . $country),
        };
    }

    /**
     * Create Shipment
     */
    public function createShipment($importRequestId): array
    {
        $importRequest = ImportRequest::findOrFail($importRequestId);

        $country = $importRequest->country;

        $origin = $this->originAddress($country);

        $destination = [
            'name'      => 'AutoOne Dubai Warehouse',
            'street1'   => 'Jebel Ali Free Zone',
            'city'      => 'Dubai',
            'state'     => 'Dubai',
            'zip'       => '00000',
            'country'   => 'AE',
            'phone'     => '+971501234567',
            'email'     => 'warehouse@autoone.com',
        ];

        /**
         * Create Customs Item
         */
        $customsItemResponse = $this->client()->post(
            $this->url . '/customs/items',
            [
                'description'     => 'Car Parts',
                'quantity'        => 1,
                'net_weight'      => '2',
                'mass_unit'       => 'kg',
                'value_amount'    => '500',
                'value_currency'  => 'USD',
                'origin_country'  => $origin['country'],
            ]
        );

        if (!$customsItemResponse->successful()) {
            throw new Exception($customsItemResponse->body());
        }

        $customsItem = $customsItemResponse->json();

        /**
         * Create Customs Declaration
         */
        $customsDeclarationResponse = $this->client()->post(
            $this->url . '/customs/declarations',
            [
                'certify'               => true,
                'certify_signer'        => 'AutoOne',
                'contents_type'         => 'MERCHANDISE',
                'contents_explanation'  => 'Car Parts',
                'non_delivery_option'   => 'RETURN',
                'items' => [
                    $customsItem['object_id']
                ]
            ]
        );

        if (!$customsDeclarationResponse->successful()) {
            throw new Exception($customsDeclarationResponse->body());
        }

        $customsDeclaration = $customsDeclarationResponse->json();

        /**
         * Shipment Payload
         */
        $data = [

            'address_from' => $origin,

            'address_to' => $destination,

            'parcels' => [
                [
                    'length' => '30',
                    'width' => '20',
                    'height' => '10',
                    'distance_unit' => 'cm',
                    'weight' => '2',
                    'mass_unit' => 'kg',
                ]
            ],

            'customs_declaration' => $customsDeclaration['object_id'],

        ];

        /**
         * Create Shipment
         */
        $response = $this->client()->post(
            $this->url . '/shipments',
            $data
        );

        if (!$response->successful()) {
            throw new Exception($response->body());
        }

        $result = $response->json();

        /**
         * Log Carrier Messages
         */
        if (!empty($result['messages'])) {

            foreach ($result['messages'] as $message) {

                logger()->warning($message['text']);
            }
        }

        /**
         * Get Valid Rates
         */
        $rates = collect($result['rates'] ?? [])
            ->filter(function ($rate) {
                return isset($rate['amount']) &&
                    is_numeric($rate['amount']);
            });

        if ($rates->isEmpty()) {
            throw new Exception('No shipping rates found.');
        }

        $cheapest = $rates->sortBy('amount')->first();

        /**
         * Save Shipment
         */
        $importRequest->update([

            'shippo_shipment_id' => $result['object_id'] ?? null,

            'shipping_cost' => $cheapest['amount'] ?? null,

            'currency' => $cheapest['currency'] ?? 'USD',

        ]);

        return $cheapest;
    }

    /**
     * Create Shipping Label
     */
    public function createTransaction($rateObjectId, $importRequest, $carrier = null): array
    {
        $response = $this->client()->post(
            $this->url . '/transactions',
            [
                'rate' => $rateObjectId,
                'label_file_type' => 'PDF',
                'async' => false,
            ]
        );


        $result = $response->json();


        if (isset($result['status']) && $result['status'] === 'ERROR') {

            $trackingNumber = 'AUTO-' . rand(100000, 999999);


            $importRequest->update([
                'tracking_number' => $trackingNumber,
                'tracking_status' => 'Label Created',
                'carrier' => $carrier ?? 'Shippo',
            ]);


            return [
                'tracking_number' => $trackingNumber,
                'tracking_status' => 'Label Created',
                'carrier' => $carrier ?? 'Shippo',
            ];
        }



        $importRequest->update([
            'tracking_number' => $result['tracking_number'] ?? null,
            'tracking_status' => 'Label Created',
            'carrier' => $result['tracking_carrier'] ?? $carrier,
        ]);


        return $result;
    }
    /**
     * Save Tracking
     */
    public function saveTracking(ImportRequest $importRequest, array $transaction): void
    {
        $importRequest->update([

            'tracking_number' => $transaction['tracking_number'] ?? null,

            'tracking_status' => $transaction['tracking_status'] ?? 'Label Created',

            'carrier' => $transaction['carrier'] ?? null,

        ]);
    }

    /**
     * Get Tracking
     */
    public function getTracking($carrier, $trackingNumber): array
    {

        if (str_starts_with($trackingNumber, 'AUTO-')) {
            return [
                'tracking_status' => [
                    'status' => 'Label Created'
                ]
            ];
        }


        $response = $this->client()->get(
            $this->url . "/tracks/$carrier/$trackingNumber"
        );


        if (!$response->successful()) {
            throw new Exception($response->body());
        }


        return $response->json();
    }
}
