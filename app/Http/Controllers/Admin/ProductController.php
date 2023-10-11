<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function Home()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }

    public function AddProduct()
    {
        $categories = Category::get();
        $subcategories = SubCategory::get();
        return view('admin.product.add', compact('categories', 'subcategories'));
    }


    public function StoreProduct(Request $request)
{
    $request->validate([
        'product_name' => 'required|unique:products',
        'product_short_des' => 'required',
        'price' => 'required|numeric|min:1',
        'quantity' => 'required|numeric|min:1',
        'category_id' => [
            'required',
            Rule::notIn([-1]),
        ],
        'subcategory_id' => [
            'required',
            Rule::notIn([-1]),
        ],
        'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'category_id.not_in' => 'Please select a valid category.',
        'subcategory_id.not_in' => 'Please select a valid subcategory.',
        'price.min' => 'The price must be at least 1.',
        'quantity.min' => 'The quantity must be at least 1.',
    ]);

    $category_id = $request->category_id;
    $category_name = Category::where('id', $category_id)->value('category_name');
    $subcategory_id = $request->subcategory_id;
    $subcategory_name = SubCategory::where('id', $subcategory_id)->value('subcategory_name');

    if ($request->hasFile('product_image')) {
        $image = $request->file('product_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);

        // Save the image path to the database
        $imagePath = 'images/' . $imageName;
    } else {
        // Handle the case when no image is uploaded
        $imagePath = null; // or the default image path
    }

    // Use the "create" method to add a new product
    Product::create([
        'product_name' => $request->product_name,
        'product_short_des' => $request->product_short_des,
        'product_long_des' => $request->product_long_des,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'product_category_id' => $category_id,
        'product_category_name' => $category_name,
        'slug' => strtolower(str_replace(' ', '-', $request->product_name)),
        'product_subcategory_id' => $subcategory_id,
        'product_subcategory_name' => $subcategory_name,
        'product_image' => $imagePath,
    ]);

    Category::where('id', $category_id)->increment('product_count', 1);
    SubCategory::where('id', $subcategory_id)->increment('product_count', 1);

    return redirect()->route('All Products')->with('success', 'Product Added Successfully');
}


    public function EditProduct($id)
    {
        // Retrieve the product by its ID
        $product = Product::findOrFail($id);

        // Fetch categories and subcategories
        $categories = Category::get();
        $subcategories = SubCategory::get();

        return view('admin.product.edit', compact('product', 'categories', 'subcategories'));
    }

    public function UpdateProduct(Request $request)
    {
        $product = Product::findOrFail($request->id);

        // Validate the form data
        $request->validate([
            'product_name' => [
                'required',
                Rule::unique('products')->ignore($product->id), // Ignore the current product
            ],
            'product_short_des' => 'required',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'category_id' => [
                'required',
                Rule::notIn([-1]),
            ],
            'subcategory_id' => [
                'required',
                Rule::notIn([-1]),
            ],
            'product_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'category_id.not_in' => 'Please select a valid category.',
            'subcategory_id.not_in' => 'Please select a valid subcategory.',
            'price.min' => 'The price must be at least 1.',
            'quantity.min' => 'The quantity must be at least 1.',
        ]);

        // Update product details
        $product->product_name = $request->input('product_name');
        $product->product_short_des = $request->input('product_short_des');
        $product->product_long_des = $request->input('product_long_des');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');

        // Update category and subcategory details
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $product->product_category_id = $category_id;
        $product->product_category_name = Category::where('id', $category_id)->value('category_name');
        $product->product_subcategory_id = $subcategory_id;
        $product->product_subcategory_name = SubCategory::where('id', $subcategory_id)->value('subcategory_name');

        // Handle image update
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            // Save the new image path to the database
            $product->product_image = 'images/' . $imageName;
        }

        // Update the product
        $product->slug = Str::slug($product->product_name); // Update slug if needed
        $product->save();

        // Redirect with a success message
        return redirect()->route('All Products')->with('success', 'Product Updated Successfully');
    }

    public function DeleteProduct($id)
{
    // Retrieve the product by its ID
    $product = Product::findOrFail($id);

    // Check if the product has an associated image
    if (!empty($product->product_image)) {
        // Delete the product image file
        $imagePath = public_path($product->product_image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Decrement product counts in the category and subcategory
    Category::where('id', $product->product_category_id)->decrement('product_count', 1);
    SubCategory::where('id', $product->product_subcategory_id)->decrement('product_count', 1);

    // Delete the product from the database
    $product->delete();

    return redirect()->route('All Products')->with('success', 'Product Deleted Successfully');
}
}
