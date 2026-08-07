<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    /**
     * Vendor Order List
     */
    public function showVendorOrder()
    {
        $vendorId = Auth::id();

        $orders = Order::whereHas('items.sparePart', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })
            ->with([
                'user',
                'items' => function ($query) use ($vendorId) {
                    $query->whereHas('sparePart', function ($q) use ($vendorId) {
                        $q->where('vendor_id', $vendorId);
                    })->with('sparePart');
                }
            ])
            ->latest()
            ->paginate(15);

        return view('vendor.spare_parts.orders.show', compact('orders'));
    }


    /**
     * Vendor Order Details
     */
    public function showVendorOrderDetails($id)
    {
        $vendorId = Auth::id();

        $order = Order::whereHas('items.sparePart', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })
            ->with([
                'user',
                'items' => function ($query) use ($vendorId) {
                    $query->whereHas('sparePart', function ($q) use ($vendorId) {
                        $q->where('vendor_id', $vendorId);
                    })->with('sparePart');
                }
            ])
            ->findOrFail($id);

        return view('vendor.spare_parts.orders.details',compact('order'));
    }


    /**
     * Update Order Status
     */
    public function updateVendorOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
        ]);

        $vendorId = Auth::id();

        $order = Order::whereHas('items.sparePart', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })
            ->findOrFail($id);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with(
            'success',
            'Order status updated successfully.'
        );
    }
}
