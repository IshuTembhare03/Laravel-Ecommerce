<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\ProductImage;

$products = Product::all();
foreach ($products as $product) {
    echo "Product: " . $product->name . "\n";
    foreach ($product->images as $img) {
        echo "  Image: " . $img->image . "\n";
    }
}