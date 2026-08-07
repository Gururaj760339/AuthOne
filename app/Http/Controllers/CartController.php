<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Show Cart
     */
    public function showCart()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $cart->load('items.sparePart');

        return view('spare_parts.carts.show', compact('cart'));
    }

    /**
     * Add Spare Part to Cart
     */
    public function addCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $part = SparePart::findOrFail($id);

        $quantity = $request->quantity ?? 1;

        // Stock check
        if (isset($part->stock) && $quantity > $part->stock) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('spare_part_id', $part->id)
            ->first();

        if ($item) {

            $newQuantity = $item->quantity + $quantity;

            if (isset($part->stock) && $newQuantity > $part->stock) {
                return back()->with('error', 'Not enough stock available.');
            }

            $item->update([
                'quantity' => $newQuantity,
                'price' => $part->price,
            ]);

        } else {

            CartItem::create([
                'cart_id' => $cart->id,
                'spare_part_id' => $part->id,
                'quantity' => $quantity,
                'price' => $part->price,
            ]);
        }

        return redirect()
            ->route('customer.cart')
            ->with('success', 'Spare part added to cart successfully.');
    }

    /**
     * Update Cart Quantity
     */
    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item = CartItem::with('sparePart')
            ->where('id', $id)
            ->whereHas('cart', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        if (
            isset($item->sparePart->stock) &&
            $request->quantity > $item->sparePart->stock
        ) {
            return back()->with('error', 'Not enough stock available.');
        }

        $item->update([
            'quantity' => $request->quantity,
            'price' => $item->sparePart->price,
        ]);

        return back()->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove Item
     */
    public function removeCart($id)
    {
        $item = CartItem::where('id', $id)
            ->whereHas('cart', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $item->delete();

        return back()->with('success', 'Item removed from cart.');
    }

    /**
     * Clear Cart
     */
    public function clearCart()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $cart->items()->delete();
        }

        return back()->with('success', 'Cart cleared successfully.');
    }
}