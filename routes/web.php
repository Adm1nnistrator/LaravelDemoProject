<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Sales;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(HomeController::class)->group(function(){
    Route::get('/home', 'home')->name('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'Test')->name('admin Dashboard');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/categories', 'Home')->name('All Categories');
        Route::get('/admin/addcategory', 'AddCategory')->name('Add Category');
        Route::post('/admin/storecategory', 'StoreCategory')->name('storecategory');
        Route::get('/admin/editcategory/{id}', 'EditCategory')->name('editcategory');
        Route::post('/admin/updatecategory', 'UpdateCategory')->name('updatecategory');
        Route::get('/admin/deletecategory/{id}','DeleteCategory')->name('deletecategory');
    });

    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/admin/subcategories', 'Home')->name('All SubCategories');
        Route::get('/admin/addsubcategory', 'AddSubCategory')->name('Add SubCategory');        
        Route::post('/admin/storesubcategory', 'StoreSubCategory')->name('storesubcategory');
        Route::get('/admin/editsubcategory/{id}', 'EditSubCategory')->name('editsubcategory');
        Route::post('/admin/updatesubcategory', 'UpdateSubCategory')->name('updateSubCate');
        Route::get('/admin/deletesubcategory/{id}','DeleteSubCategory')->name('deletesubcategory');
        
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/products', 'Home')->name('All Products');
        Route::get('/admin/addproduct', 'AddProduct')->name('Add Product');
        Route::post('/admin/storeproduct', 'StoreProduct')->name('storeproduct');
        Route::get('/admin/editproduct/{id}', 'EditProduct')->name('editproduct');
        Route::post('/admin/updateproduct', 'UpdateProduct')->name('updateproduct');
        Route::get('/admin/deleteproduct/{id}','DeleteProduct')->name('deleteproduct');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/orders', 'Home')->name('All Orders');
        Route::get('/admin/addorder', 'AddOrder')->name('Add Order');
    });
    Route::controller(SaleController::class)->group(function () {
        Route::get('/admin/sales', 'Home')->name('sales');
        Route::get('/admin/addsales', 'AddSales')->name('addsale');
        Route::post('/admin/storesale', 'StoreSale')->name('storesale');
    });
});

require __DIR__ . '/auth.php';
