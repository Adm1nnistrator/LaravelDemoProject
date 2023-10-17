@extends('admin.template')

@section('pagetitle')
New Product
@endsection

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            <div class="form-group">
               <label for="product_name" class="form-label">Product Name</label>
               <input class="form-control" type="text" id="product_name" name="product_name">
            </div>

            <div class="form-group">
               <label for="product_short_des" class="form-label">Product Short Description</label>
               <input class="form-control" type="text" id="product_short_des" name="product_short_des">
            </div>

            <div class="form-group">
               <label for="product_long_des" class="form-label">Product Long Description</label>
               <input class="form-control" type="text" id="product_long_des" name="product_long_des">
            </div>

            <div class="form-group">
               <label for="price" class="form-label">Product Price</label>
               <input class="form-control" type="text" id="price" name="price">
            </div>

            <div class="form-group">
               <label for="quantity" class="form-label">Product Quantity</label>
               <input class="form-control" type="text" id="quantity" name="quantity">
            </div>
            <div class="mb-3">
               <label for="category_name" class="form-label">Category:</label>
               <select class="form-select form-control input-group" id="category_id" name="category_id" aria-label="Default select example">
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

<script>
   $(document).ready(function() {
      $('#category_id').on('change', function() {
         var categoryId = $(this).val();
         if (categoryId != -1) {
            // Send an AJAX request to fetch subcategories for the selected category
            $.ajax({
               type: "GET",
               url: "/get_subcategories.php?category_id=" + categoryId, // Replace with the correct path to your PHP script
               success: function(data) {
                  // Populate the subcategory select element with the received data
                  $('#subcategory_id').empty();
                  $('#subcategory_id').append('<option value="-1" selected>Choose SubCategory</option>');
                  $.each(data, function(key, value) {
                     $('#subcategory_id').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                  });
               }
            });
         } else {
            // Reset the subcategory select when no category is selected
            $('#subcategory_id').empty();
            $('#subcategory_id').append('<option value="-1" selected>Choose SubCategory</option>');
         }
      });
   });
</script>

@endsection

@section('breadcrumb')
Add New Product
@endsection