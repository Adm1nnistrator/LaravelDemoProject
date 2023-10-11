@extends('admin.template')

@section('pagetitle')
Product Infomation
@endsection

@section('content')
<div class="col-lg-12 col-md-6 col-sm-12 col-12">
   <div class="card">
      <h5 class="card-header">Product Information</h5>
      @if(session()->has('success'))
      <div class="alert alert-success">
         {{ session()->get('success') }}
      </div>
      @endif

      <div class="card-body p-0">
         <div class="table-responsive">
            <table class="table">

               <a href="{{ route('Add Product') }}" class="btn btn-primary btn-sm mx-3 my-2">Add New Product</a>
               <thead class="bg-light">
                  <tr class="border-0">
                     <th class="border-0">#</th>
                     <th class="border-0">Product Name</th>
                     <th class="border-0">Product Short Description</th>
                     <th class="border-0">Product Long Description</th>
                     <th class="border-0">Product Price</th>
                     <th class="border-0">Product Quantity</th>
                     <th class="border-0">Category</th>
                     <th class="border-0">SubCategory</th>
                     <th class="border-0">Slug</th>
                     <th class="border-0">Product Image</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($products as $product)
                  <tr class="h-25 inline-block">
                     <td>{{ $loop->iteration }}</td>
                     <td>{{ $product->product_name }}</td>
                     <td>{{ $product->product_short_des }}</td>
                     <td>{{ $product->product_long_des }}</td>
                     <td>{{ $product->price }}</td>
                     <td>{{ $product->quantity }}</td>
                     <td>{{ $product->product_category_name }}</td>
                     <td>{{ $product->product_subcategory_name }}</td>
                     <td>{{ $product->slug }}</td>
                     <td>
                        <!-- Display the product image if available -->
                        @if ($product->product_image)
                        <img src="{{ asset($product->product_image) }}" alt="Product Image" width="100">
                        @endif
                     </td>
                     <td>
                        <a href="{{ route('editproduct', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                     </td>
                     <td>
                        <a href="{{ route('deleteproduct', $product->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteProductModal{{ $product->id }}">Delete</a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@foreach ($products as $product)
<div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel{{ $product->id }}" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="deleteProductModalLabel{{ $product->id }}">Confirm Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            Are you sure you want to delete this Product?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a href="{{ route('deleteproduct', $product->id) }}" class="btn btn-danger">Delete</a>
         </div>
      </div>
   </div>
</div>
@endforeach
<script>
   // JavaScript to handle the modal display
   document.addEventListener('DOMContentLoaded', function() {
      var deleteButtons = document.querySelectorAll('[data-toggle="modal"]');

      deleteButtons.forEach(function(button) {
         button.addEventListener('click', function() {
            var targetModalId = button.getAttribute('data-target').replace('#', '');
            var targetModal = document.getElementById(targetModalId);
            if (targetModal) {
               var modal = new bootstrap.Modal(targetModal);
               modal.show();
            }
         });
      });
   });
</script>

@endsection

@section('breadcrumb')
Products
@endsection