<?php

namespace App\Http\Controllers;

use App\Services\ShippoService;
use App\Models\ImportRequest;

class ImportController extends Controller
{
    protected $shippo;

    public function __construct(ShippoService $shippo)
    {
        $this->shippo = $shippo;
    }

    public function createShipment($id)
    {
        $importRequest = ImportRequest::findOrFail($id);

        $rate = $this->shippo->createShipment($id);


        $transaction = $this->shippo->createTransaction(
            $rate['object_id'],
            $importRequest,
            $rate['provider']
        );

        $this->shippo->saveTracking($importRequest, $transaction);

        return response()->json([
            'message' => 'Shipment created successfully.',
            'tracking_number' => $transaction['tracking_number'] ?? null,
        ]);
    }
}
