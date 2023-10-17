<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::get();
        $categories = Category::pluck('category_name')->toArray();
        $firstFiveCategories = array_slice($categories, 0, 5);

        // Retrieve all active sales that meet the condition
        $activeSales = Sales::where('sale_to', '>', now())
            ->orderBy('sale_to', 'asc')
            ->get();

        $nearestSale = $activeSales->first();

        $allSaleProducts = Product::whereIn('sale_id', $activeSales->pluck('id'))->get();

        // Retrieve 5 products created within the last 7 days
        $newProducts = Product::where('created_at', '>=', now()->subDays(7))
            ->get();

        $topSaleProducts = Product::orderBy('product_sale_count','desc')->take(5)->get();
        return view('client.indextemplate', compact('products', 'firstFiveCategories', 'activeSales', 'allSaleProducts', 'nearestSale', 'newProducts', 'topSaleProducts'));
    }
}
