<?php

namespace App\Http\Controllers\Index;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index($category_id = null)
    {
        $categories = Category::all();
        $products = Product::where(['is_show' => true]);
        if ($category_id) {
            $products = $products->where(['category_id' => $category_id]);
        }
        $products = $products->get();

        return view('design_index.shop.index', ['products' => $products, 'categories' => $categories, 'category_id' => $category_id]);
    }
}
