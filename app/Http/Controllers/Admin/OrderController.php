<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function Home(){
        return view('admin.order.index');
    }

    public function AddOrder(){
        return view('admin.order.add');
    }
}
