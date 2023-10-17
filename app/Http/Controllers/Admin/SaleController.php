<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sales;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    public function Home()
    {
        $sales = Sales::orderBy('is_sale_active')->get();
        
        return view('admin.sale.index', compact('sales'));
    }

    public function AddSales()
    {
        $products = Product::orderBy('product_category_name')->get();
        return view('admin.sale.add', compact('products'));
    }

    public function StoreSale(Request $request)
    {
        $rules = [
            'sale_name' => 'required',
            'sale_from' => 'required|date|after_or_equal:now',
            'sale_to' => 'required|date|after:sale_from',
            'sale_percent' => 'required|numeric|between:1,99',
            'selected_products' => 'required|array|min:1',
        ];

        $messages = [
            'sale_from.after_or_equal' => 'The Sale Start Date must be a date and cannot be in the past.',
            'sale_to.after' => 'The Sale End Date must be a date and cannot be before the Sale Start Date.',
            'sale_percent.between' => 'The Sale Percent must be between 1 and 99.',
            'selected_products.required' => 'Please select at least one product.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $sale = Sales::create([
            'sale_name' => $request->sale_name,
            'sale_from' => $request->sale_from,
            'sale_to' => $request->sale_to,
            'sale_percent' => $request->sale_percent,
            'slug' => strtolower(str_replace(' ', '-', $request->sale_name)),
        ]);

        // Update the sale_id for selected products
        foreach ($request->selected_products as $productId) {
            Product::where('id', $productId)->update(['sale_id' => $sale->id]);
        }

        return redirect()->route('sales')->with('success', 'Sale Added Successfully');
    }
}

