@extends('admin.template')

@section('pagetitle')
Sub-Categories Info
@endsection

@section('content')
<div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
   <div class="card">
      <h5 class="card-header">SubCategory Information</h5>
      @if(session()->has('success'))
      <div class="alert alert-success">
         {{ session()->get('success') }}
      </div>
      @endif

      <div class="card-body p-0">
         <div class="table-responsive">
            <table class="table">

               <a href="{{ route('Add SubCategory') }}" class="btn btn-primary btn-sm mx-3 my-2">Add New SubCategory</a>
               <thead class="bg-light">
                  <tr class="border-0">
                     <th class="border-0">#</th>
                     <th class="border-0">SubCategory Name</th>
                     <th class="border-0">Category Name</th>
                     <th class="border-0">SubCategory Product Count</th>
                     <th class="border-0">Slug</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($subcategories as $subcategory)
                  <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{ $subcategory->subcategory_name }}</td>
                     <td>{{ $subcategory->category_name }}</td>
                     <td>{{ $subcategory->product_count }}</td>
                     <td>{{ $subcategory->slug }}</td>
                     <td>
                        <a href="{{ route('editsubcategory', $subcategory->id) }}" class="btn btn-primary btn-sm">Edit</a>
                     </td>
                     <td>
                        <a href="{{ route('deletesubcategory', $subcategory->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteSubCategoryModal{{ $subcategory->id }}">Delete</a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

@foreach ($subcategories as $subcategory)
<div class="modal fade" id="deleteSubCategoryModal{{ $subcategory->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel{{ $subcategory->id }}" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="deleteCategoryModalLabel{{ $subcategory->id }}">Confirm Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            Are you sure you want to delete this SubCategory?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a href="{{ route('deletesubcategory', $subcategory->id) }}" class="btn btn-danger">Delete</a>
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
Sub-Categories
@endsection