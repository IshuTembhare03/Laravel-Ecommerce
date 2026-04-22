<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $product = Product::findOrFail($request->product_id);
        
        if ($product->quantity < $request->quantity) {
            return back()->with('error', 'Not enough stock available');
        }
        
        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();
            
            if ($cartItem) {
                $newQuantity = $cartItem->quantity + $request->quantity;
                if ($product->quantity < $newQuantity) {
                    return back()->with('error', 'Not enough stock available');
                }
                $cartItem->update(['quantity' => $newQuantity]);
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                ]);
            }
        } else {
            $cart = session('cart', []);
            $found = false;
            foreach ($cart as &$item) {
                if ($item['product_id'] == $request->product_id) {
                    $item['quantity'] += $request->quantity;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $cart[] = [
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                ];
            }
            session(['cart' => $cart]);
        }
        
        return back()->with('success', 'Product added to cart');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        if (Auth::check()) {
            $cartItem = Cart::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
            
            $product = Product::findOrFail($cartItem->product_id);
            
            if ($product->quantity < $request->quantity) {
                return back()->with('error', 'Not enough stock available');
            }
            
            $cartItem->update(['quantity' => $request->quantity]);
        } else {
            $cart = session('cart', []);
            foreach ($cart as &$item) {
                if ($item['product_id'] == $id) {
                    $product = Product::findOrFail($item['product_id']);
                    if ($product->quantity < $request->quantity) {
                        return back()->with('error', 'Not enough stock available');
                    }
                    $item['quantity'] = $request->quantity;
                    break;
                }
            }
            session(['cart' => $cart]);
        }
        
        return back()->with('success', 'Cart updated');
    }

    public function remove($id)
    {
        if (Auth::check()) {
            Cart::where('id', $id)
                ->where('user_id', Auth::id())
                ->delete();
        } else {
            $cart = session('cart', []);
            $cart = array_values(array_filter($cart, function($item) use ($id) {
                return $item['product_id'] != $id;
            }));
            session(['cart' => $cart]);
        }
        
        return back()->with('success', 'Item removed from cart');
    }

    public function clear()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }
        
        return back()->with('success', 'Cart cleared');
    }

    public function count()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->sum('quantity');
        } else {
            return array_sum(array_column(session('cart', []), 'quantity'));
        }
    }
}