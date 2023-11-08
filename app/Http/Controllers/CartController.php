<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user(); 
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        return view('carts.index', compact('cartItems'));
    }

    public function addToCart(Request $request, $productId)
    {
        $user = auth()->user(); 
        $productId = (int)$productId;
        $product = Product::find($productId);

        $quantity = $request->input('quantity');

        $existingCartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->increment('quantity');
            $existingCartItem->update(['price' => $product->price * $existingCartItem->quantity]);
        } else {
            $cartItem = new Cart();
            $cartItem->user_id = $user->id;
            $cartItem->product_id = $productId;
            $cartItem->quantity = $quantity;
            $cartItem->price = $product->price * $quantity;
            $cartItem->save();
        }

        return redirect()->route('carts.index')->with('success', 'Product added to cart.');
    }


    public function updateCartItem(Request $request, $cartItemId)
    {
        $cartItem = Cart::findOrFail($cartItemId);

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->route('carts.index')->with('success', 'Cart updated successfully.');
    }


    public function removeFromCart($cartItemId)
    {
        $cartItem = Cart::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->route('carts.index')->with('success', 'Product removed from cart.');
    }
}
