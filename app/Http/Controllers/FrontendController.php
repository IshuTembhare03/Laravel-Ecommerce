<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('featured', 1)
            ->where('status', 1)
            ->with('images')
            ->take(6)
            ->get();
        
        $categories = Category::where('status', 1)->take(6)->get();
        
        return view('frontend.home', compact('featuredProducts', 'categories'));
    }

    public function products(Request $request)
    {
        $query = Product::where('status', 1)->with('images', 'category');
        
        if ($request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }
        
        $products = $query->paginate(9);
        $categories = Category::where('status', 1)->get();
        
        return view('frontend.products', compact('products', 'categories'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)
            ->with('images', 'category')
            ->firstOrFail();
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->with('images')
            ->take(4)
            ->get();
        
        return view('frontend.product-detail', compact('product', 'relatedProducts'));
    }

    public function cart()
    {
        if (Auth::check()) {
            $cartItems = \App\Models\Cart::where('user_id', Auth::id())
                ->with('product.images')
                ->get();
        } else {
            $cartItems = collect(session('cart', []))->map(function($item) {
                $product = Product::with('images')->find($item['product_id']);
                $item['product'] = $product;
                return (object) $item;
            });
        }
        
        return view('frontend.cart', compact('cartItems'));
    }

    public function checkout()
    {
        if (Auth::check()) {
            $cartItems = \App\Models\Cart::where('user_id', Auth::id())
                ->with('product.images')
                ->get();
        } else {
            $cartItems = collect(session('cart', []))->map(function($item) {
                $product = Product::with('images')->find($item['product_id']);
                $item['product'] = $product;
                return (object) $item;
            });
        }
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }
        
        return view('frontend.checkout', compact('cartItems'));
    }

    public function orderSuccess()
    {
        return view('frontend.order-success');
    }
}