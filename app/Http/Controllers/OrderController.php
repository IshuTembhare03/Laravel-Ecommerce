<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);
        
        $userId = Auth::check() ? Auth::id() : null;
        
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get();
        } else {
            $cartData = session('cart', []);
            $cartItems = collect(array_map(function($item) {
                return (object) [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'product' => Product::find($item['product_id']),
                ];
            }, $cartData));
        }
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }
        
        $total = 0;
        foreach ($cartItems as $item) {
            if (!$item->product || $item->product->status != 1) {
                return redirect()->route('cart')->with('error', 'Some products are no longer available');
            }
            $total += $item->product->price * $item->quantity;
        }
        
        $order = Order::create([
            'user_id' => $userId,
            'order_number' => 'ORD-' . Str::upper(Str::random(10)),
            'total' => $total,
            'status' => 'pending',
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ]);
            
            $product = Product::find($item->product_id);
            $product->decrement('quantity', $item->quantity);
        }
        
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }
        
        return redirect()->route('order.success')->with('success', 'Order placed successfully! Order number: ' . $order->order_number);
    }
}