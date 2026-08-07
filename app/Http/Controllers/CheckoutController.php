<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Checkout page
     */
    public function checkoutPage()
    {
        $cart = Cart::where('user_id', Auth::id())
            ->with('items.sparePart')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('customer.cart')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $shippingCost = 0;
        $tax = 0;
        $discount = 0;

        $total = $subtotal + $shippingCost + $tax - $discount;

        return view('spare_parts.checkout.show', compact(
            'cart',
            'subtotal',
            'shippingCost',
            'tax',
            'discount',
            'total'
        ));
    }


    /**
     * Place Order
     */
    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'required|string|max:30',

            'shipping_address' => 'required|string|max:1000',
            'shipping_city' => 'required|string|max:255',
            'shipping_country' => 'required|string|max:255',

            'payment_method' => 'required|in:stripe,paytabs,sslcommerz,aamarpay,bkash,nagad,cash_on_delivery',

            'customer_note' => 'nullable|string|max:1000',
        ]);


        DB::beginTransaction();

        try {

            $cart = Cart::where('user_id', Auth::id())
                ->with('items.sparePart')
                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                return redirect()
                    ->route('customer.cart')
                    ->with('error', 'Your cart is empty.');
            }


            /*
            |--------------------------------------------------------------------------
            | Check Stock
            |--------------------------------------------------------------------------
            */

            foreach ($cart->items as $item) {

                $part = $item->sparePart;

                if (!$part) {
                    throw new \Exception(
                        'One of the products in your cart is no longer available.'
                    );
                }

                if (
                    isset($part->stock) &&
                    $item->quantity > $part->stock
                ) {
                    throw new \Exception(
                        $part->name . ' does not have enough stock.'
                    );
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Calculate Amount
            |--------------------------------------------------------------------------
            */

            $subtotal = $cart->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            $shippingCost = 0;
            $tax = 0;
            $discount = 0;

            $total = $subtotal
                + $shippingCost
                + $tax
                - $discount;


            /*
            |--------------------------------------------------------------------------
            | Create Order
            |--------------------------------------------------------------------------
            */

            $order = Order::create([

                'user_id' => Auth::id(),

                'order_number' =>
                'AO-' . date('Ymd') . '-' . strtoupper(
                    substr(uniqid(), -6)
                ),

                'customer_name' =>
                $request->customer_name,

                'customer_email' =>
                $request->customer_email,

                'customer_phone' =>
                $request->customer_phone,

                'shipping_address' =>
                $request->shipping_address,

                'shipping_city' =>
                $request->shipping_city,

                'shipping_country' =>
                $request->shipping_country,

                'subtotal' =>
                $subtotal,

                'shipping_cost' =>
                $shippingCost,

                'tax' =>
                $tax,

                'discount' =>
                $discount,

                'total_amount' =>
                $total,

                'currency' =>
                'AED',

                'payment_method' =>
                $request->payment_method,

                'payment_status' =>
                $request->payment_method === 'cash_on_delivery'
                    ? 'pending'
                    : 'pending',

                'status' =>
                'pending',

                'customer_note' =>
                $request->customer_note,

                'ordered_at' =>
                now(),
            ]);


            /*
            |--------------------------------------------------------------------------
            | Create Order Items + Reduce Stock
            |--------------------------------------------------------------------------
            */

            foreach ($cart->items as $item) {

                $part = $item->sparePart;


                OrderItem::create([

                    'order_id' =>
                    $order->id,

                    'spare_part_id' =>
                    $part->id,

                    'part_name' =>
                    $part->name,

                    'quantity' =>
                    $item->quantity,

                    'price' =>
                    $item->price,

                    'subtotal' =>
                    $item->price * $item->quantity,
                ]);


                /*
                |--------------------------------------------------------------------------
                | Reduce Stock
                |--------------------------------------------------------------------------
                */

                if (isset($part->stock)) {

                    $part->decrement(
                        'stock',
                        $item->quantity
                    );
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Clear Cart
            |--------------------------------------------------------------------------
            */

            $cart->items()->delete();


            DB::commit();

            // Stripe Payment
            if ($request->payment_method === 'stripe') {

                return redirect()
                    ->route('stripe.checkout.spare_parts', $order->id);
            }

            return redirect()
                ->route('customer.order.success', $order->id)
                ->with(
                    'success',
                    'Your order has been placed successfully.'
                );
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }


    /**
     * Order Success
     */
    public function orderSuccess($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with('items')
            ->findOrFail($id);

        return view('spare_parts.order.success', compact('order'));
    }


    /**
     * Order History
     */
    public function orderHistory()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items')
            ->latest()
            ->paginate(10);

        return view('spare_parts.order.history', compact('orders'));
    }


    /**
     * Order Details
     */
    public function showOrder($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with('items.sparePart')
            ->findOrFail($id);

        return view('spare_parts.order.details', compact('order'));
    }
}
