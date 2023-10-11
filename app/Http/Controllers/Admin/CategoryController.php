<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function Home(){
        $categories = Category::orderBy('category_name')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function AddCategory(){
        return view('admin.category.add');
    }
    
    public function StoreCategory(Request $request){
        $this->validate($request, [
            'category_name' =>'required|unique:categories',
        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ','-',$request->category_name))
        ]);

        return redirect()->route('All Categories')->with('success', 'Category Added Successfully');
    }

    public function EditCategory($id){
        $category_info = Category::findOrFail($id);
        return view('admin.category.edit', compact('category_info'));
    }

    public function UpdateCategory(Request $request){
        $category_id = $request->category_id;
        $this->validate($request, [
            'category_name' =>'required|unique:categories,category_name,'.$category_id,
        ]);

        Category::where('id', $category_id)->update([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ','-',$request->category_name))
        ]);

        return redirect()->route('All Categories')->with('success', 'Category Updated Successfully');
    }

    public function DeleteCategory($id){
        Category::where('id', $id)->delete();
        return redirect()->route('All Categories')->with('success', 'Category Deleted Successfully');
    }
}
