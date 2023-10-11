@extends('admin.template')

@section('pagetitle')
New Product
@endsection

@section('content')
<div class="container mt-5">
   <div class="card">
      <div class="card-body">
         @if ($errors->any())
         <div class="alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
         @endif
         <h4 class="card-title text-center">Add New Product</h4>
         <form method="post" action="{{ route('storeproduct') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
               <label for="product_name" class="form-label">Product Name:</label>
               <input type="text" id="product_name" name="product_name" class="form-control" required>
            </div>
            <div class="mb-3">
               <label for="product_short_des" class="form-label">Product Short Description:</label>
               <input type="text" id="product_short_des" name="product_short_des" class="form-control" required>
            </div>
            <div class="mb-3">
               <label for="product_long_des" class="form-label">Product Long Description:</label>
               <input type="text" id="product_long_des" name="product_long_des" class="form-control" required>
            </div>
            <div class="mb-3">
               <label for="price" class="form-label">Product Price($):</label>
               <input type="" id="price" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
               <label for="quantity" class="form-label">Product Quantity:</label>
               <input type="text" id="quantity" name="quantity" class="form-control" required>
            </div>
            <div class="mb-3">
               <label for="category_name" class="form-label">Category:</label>
               <select class="form-select form-control input-group" id="category_id" name="category_id">
                  <option value="-1" selected>Choose Category</option>
                  @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                  @endforeach
               </select>
            </div>
            <div class="mb-3">
               <label for="subcategory_name" class="form-label">SubCategory:</label>
               <select class="form-select form-control input-group" id="subcategory_id" name="subcategory_id">
                  <option value="-1" selected>Choose SubCategory</option>
                  @foreach ($subcategories as $subcategory)
                  <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                  @endforeach
               </select>
            </div>
            <div class="mb-3">
               <label for="product_image" class="form-label">Product Image:</label>
               <input type="file" id="product_image" name="product_image" class="form-control" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
         </form>
      </div>
   </div>
</div>
@endsection

@section('breadcrumb')
Add New Product
@endsection