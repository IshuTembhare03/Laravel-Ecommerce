<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@royalfurniture.com',
            'password' => Hash::make('password123'),
            'is_admin' => 1,
        ]);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'is_admin' => 0,
        ]);

        $categories = [
            ['name' => 'Sofas', 'slug' => 'sofas', 'description' => 'Luxury sofas and couches for your living room'],
            ['name' => 'Chairs', 'slug' => 'chairs', 'description' => 'Elegant chairs for dining and relaxation'],
            ['name' => 'Tables', 'slug' => 'tables', 'description' => 'Coffee tables, dining tables, and more'],
            ['name' => 'Beds', 'slug' => 'beds', 'description' => 'Premium bedroom furniture'],
            ['name' => 'Storage', 'slug' => 'storage', 'description' => 'Cabinets, wardrobes, and storage solutions'],
        ];

        $categoryModels = [];
        foreach ($categories as $cat) {
            $categoryModels[] = Category::create(array_merge($cat, ['status' => 1]));
        }

        $products = [
            [
                'name' => 'Modern Velvet Sofa',
                'slug' => 'modern-velvet-sofa',
                'description' => 'Luxurious velvet sofa with clean lines. Perfect for modern living rooms. Features premium fabric and comfortable cushions.',
                'price' => 2499.99,
                'quantity' => 10,
                'category_id' => $categoryModels[0]->id,
                'featured' => 1,
                'status' => 1,
                'images' => [
                    'https://images.unsplash.com/photo-1555041469-a296c8b43070?w=800',
                    'https://images.unsplash.com/photo-1550254478-90a83360a7d3?w=800',
                ]
            ],
            [
                'name' => 'Leather Armchair',
                'slug' => 'leather-armchair',
                'description' => 'Premium Italian leather armchair with walnut wood arms. Classic design meets comfort.',
                'price' => 899.99,
                'quantity' => 20,
                'category_id' => $categoryModels[1]->id,
                'featured' => 1,
                'status' => 1,
                'images' => [
                    'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=800',
                ]
            ],
            [
                'name' => 'Marble Coffee Table',
                'slug' => 'marble-coffee-table',
                'description' => 'Elegant marble top coffee table with brass legs. A statement piece for any living room.',
                'price' => 599.99,
                'quantity' => 15,
                'category_id' => $categoryModels[2]->id,
                'featured' => 1,
                'status' => 1,
                'images' => [
                    'https://images.unsplash.com/photo-1533090481720-856c6e3ed196?w=800',
                    'https://images.unsplash.com/photo-1532372576444-dda954194e64?w=800',
                ]
            ],
            [
                'name' => 'King Size Platform Bed',
                'slug' => 'king-size-platform-bed',
                'description' => 'Modern king size platform bed with upholstered headboard. Solid construction.',
                'price' => 1899.99,
                'quantity' => 8,
                'category_id' => $categoryModels[3]->id,
                'featured' => 1,
                'status' => 1,
                'images' => [
                    'https://images.unsplash.com/photo-1505693416388-b0346efee539?w=800',
                    'https://images.unsplash.com/photo-1522771739844-6a9df6d9d56c?w=800',
                ]
            ],
            [
                'name' => 'Oak Dining Table',
                'slug' => 'oak-dining-table',
                'description' => 'Solid oak dining table that seats 8 people. Perfect for family gatherings.',
                'price' => 1599.99,
                'quantity' => 12,
                'category_id' => $categoryModels[2]->id,
                'featured' => 1,
                'status' => 1,
                'images' => [
                    'https://images.unsplash.com/photo-1617806118233-bd1cc05a6e51?w=800',
                    'https://images.unsplash.com/photo-1595428774223-ef5267592000?w=800',
                ]
            ],
            [
                'name' => 'Sectional Modern Sofa',
                'slug' => 'sectional-modern-sofa',
                'description' => 'L-shaped modern sectional sofa in grey fabric. Great for large spaces.',
                'price' => 3299.99,
                'quantity' => 5,
                'category_id' => $categoryModels[0]->id,
                'featured' => 0,
                'status' => 1,
                'images' => [
                    'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=800',
                ]
            ],
            [
                'name' => 'Wooden Dining Chairs',
                'slug' => 'wooden-dining-chairs',
                'description' => 'Set of 4 wooden dining chairs with cushioned seats.',
                'price' => 399.99,
                'quantity' => 25,
                'category_id' => $categoryModels[1]->id,
                'featured' => 0,
                'status' => 1,
                'images' => [
                    'https://images.unsplash.com/photo-1549187774-b4c9e3e5cd84?w=800',
                ]
            ],
            [
                'name' => 'Bookshelf Storage',
                'slug' => 'bookshelf-storage',
                'description' => 'Modern bookshelf with ample storage space. Fits any decor.',
                'price' => 449.99,
                'quantity' => 18,
                'category_id' => $categoryModels[4]->id,
                'featured' => 0,
                'status' => 1,
                'images' => [
                    'https://images.unsplash.com/photo-1594620302200-9896d21c0c23?w=800',
                ]
            ],
        ];

        foreach ($products as $productData) {
            $images = $productData['images'] ?? [];
            unset($productData['images']);
            
            $product = Product::create($productData);
            
            foreach ($images as $imageUrl) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imageUrl,
                ]);
            }
        }
    }
}