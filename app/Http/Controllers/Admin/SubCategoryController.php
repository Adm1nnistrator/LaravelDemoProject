<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    public function Home()
    {
        $subcategories = SubCategory::orderBy('category_name')->get(); // Use get() to fetch the records

        return view('admin.subcate.index', compact('subcategories')); // Pass 'subcate' as a string
    }


    public function AddSubCategory()
    {
        $categories = Category::get();
        return view('admin.subcate.add', compact('categories'));
    }


    public function StoreSubCategory(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required|unique:sub_categories',
            'category_id' => [
                'required',
                Rule::notIn([-1]),
            ],
        ]);

        $category_id = $request->category_id;
        $category_name = Category::where('id', $category_id)->value('category_name');

        SubCategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
            'category_id' => $category_id,
            'category_name' => $category_name,
        ]);

        Category::where('id', $category_id)->increment('subcategory_count', 1);

        return redirect()->route('All SubCategories')->with('success', 'SubCategory Added Successfully');
    }


    public function EditSubCategory($id)
    {
        $subcategory = SubCategory::find($id);
        $categories = Category::get();
        return view('admin.subcate.edit', compact('subcategory', 'categories'));
    }


    public function UpdateSubCategory(Request $request)
    {

        $subcatid = $request->subcategory_id;
        $this->validate($request, [
            'subcategory_name' => 'required|unique:sub_categories,subcategory_name,' . $subcatid,

        ]);

        SubCategory::findOrFail($subcatid)->update([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
        ]);

        return redirect()->route('All SubCategories')->with('success', 'SubCategory Updated Successfully');
    }


    public function DeleteSubCategory($id)
    {
        $subcategory=SubCategory::findOrFail($id);
        Category::where('id', $subcategory->category_id)->decrement('subcategory_count', 1);
        $subcategory->delete();
        return redirect()->route('All SubCategories')->with('success', 'SubCategory Deleted Successfully');
    }
    
}
