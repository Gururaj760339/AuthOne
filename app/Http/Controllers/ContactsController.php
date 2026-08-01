<?php

namespace App\Http\Controllers;

use App\Models\RentalBooking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ContactsController extends Controller
{
    /**
     * Download Rental Contract PDF
     */
    public function rentalContractDownload($bookingId)
    {
        $booking = RentalBooking::with([
            'user',
            'rental.car.carBrand'
        ])->findOrFail($bookingId);

        $days = Carbon::parse($booking->pickup_date)
            ->diffInDays(Carbon::parse($booking->return_date));

        $total = $days * $booking->rental->price_per_day;

        if ($booking->user_id != auth()->id()) {
            abort(403);
        }

        $data = [
            'booking' => $booking,
            'customer' => $booking->user,
            'car' => $booking->rental->car,
            'today' => now()->format('d M Y'),
            'total' => $total
        ];

        $pdf = Pdf::loadView('contracts.rental_contract', $data);

        return $pdf->download(
            'Rental_Contract_' . $booking->id . '.pdf'
        );
    }

    /**
     * View Contract in Browser
     */
    public function rentalContractPreview($bookingId)
    {
        $booking = RentalBooking::with([
            'user',
            'rental.car.carBrand',
        ])->findOrFail($bookingId);

        $days = Carbon::parse($booking->pickup_date)
            ->diffInDays(Carbon::parse($booking->return_date));

        $total = $days * $booking->rental->price_per_day;


        if ($booking->user_id != auth()->id()) {
            abort(403);
        }


        $pdf = Pdf::loadView('contracts.rental_contract', [
            'booking' => $booking,
            'customer' => $booking->user,
            'car' => $booking->rental->car,
            'today' => now()->format('d M Y'),
            'total' => $total
        ]);

        return $pdf->stream(
            'Rental_Contract_' . $booking->id . '.pdf'
        );
    }

    public function showContact($id)
    {
        $booking = RentalBooking::with([
            'user',
            'rental',
            'rental.car'
        ])->findOrFail($id);

        if ($booking->user_id != auth()->id()) {
            abort(403);
        }

        return view('contracts.show_contract', compact('booking'));
    }
}
