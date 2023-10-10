<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function Home(){
        $categories = Category::all();
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
}
