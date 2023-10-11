@extends('admin.template')

@section('pagetitle')
Edit Product
@endsection

@section('content')
<h1>Edit Product</h1>
<form method="POST" action="{{ route('updateproduct') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" value="{{ $product->id }}" name="id">

    <!-- Input fields for editing product details -->
    <div class="form-group">
        <label for="product_name" class="form-label">Product Name</label>
        <input class="form-control" type="text" id="product_name" name="product_name" value="{{ $product->product_name }}">
    </div>

    <div class="form-group" >
        <label for="product_short_des" class="form-label">Product Short Description</label>
        <input class="form-control" type="text" id="product_short_des" name="product_short_des" value="{{ $product->product_short_des }}">
    </div>

    <div class="form-group">
        <label for="product_long_des" class="form-label">Product Long Description</label>
        <input class="form-control" type="text" id="product_long_des" name="product_long_des" value="{{ $product->product_long_des }}">
    </div>

    <div class="form-group">
        <label for="price" class="form-label">Product Price</label>
        <input class="form-control" type="text" id="price" name="price" value="{{ $product->price}}">
    </div>

    <div class="form-group">
        <label for="quantity" class="form-label">Product Quantity</label>
        <input class="form-control" type="text" id="quantity" name="quantity" value="{{ $product->quantity }}">
    </div>
    <!-- Add fields for other product details -->

    <!-- Dropdown list for categories -->
    <div class="form-group">
        <label for="category_id">Category</label>
        <select id="category_id" name="category_id" class="form-select form-control input-group">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id === $product->product_category_id ? 'selected' : '' }}>
                {{ $category->category_name }}
            </option>
            @endforeach
        </select>
    </div>

    <!-- Dropdown list for subcategories -->
    <div class="form-group">
        <label for="subcategory_id">Subcategory</label>
        <select id="subcategory_id" name="subcategory_id" class="form-select form-control input-group">
            @foreach ($subcategories as $subcategory)
            <option value="{{ $subcategory->id }}" {{ $subcategory->id === $product->product_subcategory_id ? 'selected' : '' }}>
                {{ $subcategory->subcategory_name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="product_image" class="form-label">Product Image</label>
        @if ($product->product_image)
        <img src="{{ asset($product->product_image) }}" alt="Current Image" width="100" class="form-control">
        @endif
        <input type="file" id="product_image" name="product_image" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update Product</button>
</form>
@endsection

@section('breadcrumb')
Edit Product
@endsection