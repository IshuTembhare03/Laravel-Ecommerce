<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $revenue = Order::where('status', 'completed')->sum('total');
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'productsCount', 'ordersCount', 'revenue', 'recentOrders'
        ));
    }

    public function productsIndex()
    {
        $products = Product::with('category', 'images')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function productsCreate()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function productsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_urls.*' => 'nullable|url',
        ]);
        
        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'status' => $request->status ? 1 : 0,
            'featured' => $request->featured ? 1 : 0,
        ]);
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('products', $filename, 'public');
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $filename,
                ]);
            }
        }
        
        if ($request->image_urls) {
            foreach ($request->image_urls as $url) {
                if ($url && filter_var($url, FILTER_VALIDATE_URL)) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $url,
                    ]);
                }
            }
        }
        
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function productsEdit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::where('status', 1)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function productsUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_urls.*' => 'nullable|url',
        ]);
        
        $product = Product::findOrFail($id);
        
        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'status' => $request->status ? 1 : 0,
            'featured' => $request->featured ? 1 : 0,
        ]);
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('products', $filename, 'public');
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $filename,
                ]);
            }
        }
        
        if ($request->image_urls) {
            foreach ($request->image_urls as $url) {
                if ($url && filter_var($url, FILTER_VALIDATE_URL)) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $url,
                    ]);
                }
            }
        }
        
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function productsDestroy($id)
    {
        $product = Product::findOrFail($id);
        
        foreach ($product->images as $image) {
            $path = $image->image;
            if ($path && !filter_var($path, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete('products/' . $path);
            }
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    public function productImageDestroy($id)
    {
        $image = ProductImage::findOrFail($id);
        $path = $image->image;
        if ($path && !filter_var($path, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete('products/' . $path);
        }
        $image->delete();
        
        return response()->json(['success' => true]);
    }

    public function categoriesIndex()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function categoriesCreate()
    {
        return view('admin.categories.create');
    }

    public function categoriesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'description' => $request->description,
            'status' => $request->status ? 1 : 0,
        ];
        
        if ($request->hasFile('image')) {
            $filename = time() . '-' . Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('categories', $filename, 'public');
            $data['image'] = $filename;
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->image_url;
        }
        
        Category::create($data);
        
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function categoriesEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function categoriesUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
        ]);
        
        $category = Category::findOrFail($id);
        
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'description' => $request->description,
            'status' => $request->status ? 1 : 0,
        ];
        
        if ($request->hasFile('image')) {
            if ($category->image && !filter_var($category->image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete('categories/' . $category->image);
            }
            $filename = time() . '-' . Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('categories', $filename, 'public');
            $data['image'] = $filename;
        } elseif ($request->image_url && filter_var($request->image_url, FILTER_VALIDATE_URL)) {
            if ($category->image && !filter_var($category->image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete('categories/' . $category->image);
            }
            $data['image'] = $request->image_url;
        }
        
        $category->update($data);
        
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function categoriesDestroy($id)
    {
        $category = Category::findOrFail($id);
        
        if ($category->image && !filter_var($category->image, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete('categories/' . $category->image);
        }
        
        $category->delete();
        
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }

    public function ordersIndex()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function ordersShow($id)
    {
        $order = Order::with('user', 'items.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function ordersUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);
        
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        
        return redirect()->route('admin.orders.index')->with('success', 'Order status updated');
    }
}