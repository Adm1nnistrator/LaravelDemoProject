<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Home(){
        return view('admin.product.index');
    }

    public function AddProduct(){
        return view('admin.product.add');
    }
}
