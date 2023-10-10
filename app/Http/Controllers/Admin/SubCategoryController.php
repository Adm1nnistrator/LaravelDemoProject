<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function Home(){
        return view('admin.subcate.index');
    }

    public function AddSubCategory(){
        return view('admin.subcate.add');
    }
}
