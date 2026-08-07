<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * All Orders
     */
    public function adminShowOrder(Request $request)
    {
        $query = Order::with([
            'user',
            'items.sparePart.vendor',
        ])->latest();

        // Search by order number / customer name / phone
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('order_number', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_phone', 'like', "%{$search}%")
                    ->orWhere('customer_email', 'like', "%{$search}%");

            });
        }

        // Filter by order status
        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {

            $query->where(
                'payment_status',
                $request->payment_status
            );
        }

        $orders = $query->paginate(20)->withQueryString();

        return view('admin.spare_parts.orders.show',compact('orders'));
    }


    /**
     * Order Details
     */
    public function adminShowOrderDetails($id)
    {
        $order = Order::with([
            'user',
            'items.sparePart.vendor',
        ])->findOrFail($id);

        return view('admin.spare_parts.orders.details',compact('order'));
    }


    /**
     * Update Order Status
     */
    public function adminUpdateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => [
                'required',
                'in:pending,confirmed,processing,shipped,delivered,cancelled',
            ],
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with(
            'success',
            'Order status updated successfully.'
        );
    }


    /**
     * Update Payment Status
     */
    public function adminUpdatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => [
                'required',
                'in:pending,paid,failed,refunded',
            ],
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'payment_status' => $request->payment_status,
        ]);

        return back()->with(
            'success',
            'Payment status updated successfully.'
        );
    }


    /**
     * Delete Order
     */
    public function destroyOrder($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return redirect()
            ->route('admin.spare-parts.orders')
            ->with(
                'success',
                'Order deleted successfully.'
            );
    }
}