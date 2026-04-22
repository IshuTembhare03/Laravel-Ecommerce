<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function products(Request $request): JsonResponse
    {
        $query = Product::where('status', 1)->with('images');
        
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        
        if ($request->featured) {
            $query->where('featured', 1);
        }
        
        $products = $query->orderBy('id', 'desc')->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function product($id): JsonResponse
    {
        $product = Product::with('images', 'category')->find($id);
        
        if (!$product || $product->status != 1) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $product,
        ]);
    }

    public function featuredProducts(): JsonResponse
    {
        $products = Product::where('featured', 1)
            ->where('status', 1)
            ->with('images')
            ->take(6)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function categories(): JsonResponse
    {
        $categories = Category::where('status', 1)->get();
        
        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    public function cart(): JsonResponse
    {
        $userId = Auth::id();
        
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }
        
        $cartItems = Cart::where('user_id', $userId)
            ->with('product.images')
            ->get();
        
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }
        
        return response()->json([
            'success' => true,
            'data' => $cartItems,
            'total' => $total,
        ]);
    }

    public function addToCart(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }
        
        $product = Product::find($request->product_id);
        
        if ($product->quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock',
            ], 400);
        }
        
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();
        
        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($product->quantity < $newQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not enough stock',
                ], 400);
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Added to cart',
        ]);
    }

    public function updateCart(Request $request, $id): JsonResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }
        
        $cartItem = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();
        
        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found',
            ], 404);
        }
        
        $product = Product::find($cartItem->product_id);
        
        if ($product->quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock',
            ], 400);
        }
        
        $cartItem->update(['quantity' => $request->quantity]);
        
        return response()->json([
            'success' => true,
            'message' => 'Cart updated',
        ]);
    }

    public function removeFromCart($id): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }
        
        Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Removed from cart',
        ]);
    }
}