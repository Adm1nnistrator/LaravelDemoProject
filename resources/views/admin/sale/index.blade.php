@extends('admin.template')

@section('pagetitle')
Sales Infomation
@endsection

@section('content')
<div class="col-lg-12 col-md-6 col-sm-12 col-12">
   <div class="card">
      <h5 class="card-header">Sales Information</h5>
      @if(session()->has('success'))
      <div class="alert alert-success">
         {{ session()->get('success') }}
      </div>
      @endif

      <div class="card-body p-0">
         <div class="table-responsive">
            <table class="table">

               <a href="{{ route('addsale') }}" class="btn btn-primary btn-sm mx-3 my-2">Add New Sale</a>
               <thead class="bg-light">
                  <tr class="border-0">
                     <th class="border-0">#</th>
                     <th class="border-0">Sale Name</th>
                     <th class="border-0">Sale Start Date</th>
                     <th class="border-0">Sale End Date</th>
                     <th class="border-0">Sale Active Status</th>
                     <th class="border-0">Sale Percent(%)</th>
                     <th class="border-0">Slug</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($sales as $sale)
                  <tr class="h-25 inline-block">
                     <td>{{ $loop->iteration }}</td>
                     <td>{{ $sale->sale_name }}</td>
                     <td>{{ $sale->sale_from }}</td>
                     <td>{{ $sale->sale_to }}</td>
                     <td>{{ $sale->is_sale_active }}</td>
                     <td>{{ $sale->sale_percent }}</td>
                     <td>{{ $sale->slug }}</td>
                     <td>
                        <a href="" class="btn btn-primary btn-sm">Edit</a>
                     </td>
                     <td>
                        <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteSaleModal{{ $sale->id }}">Delete</a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<!-- @foreach ($sales as $sale)
<div class="modal fade" id="deleteSaleModal{{ $sale->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteSaleModalLabel{{ $sale->id }}" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="deleteSaleModalLabel{{ $sale->id }}">Confirm Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            Are you sure you want to delete this Sale?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a href="{{ route('deleteproduct', $sale->id) }}" class="btn btn-danger">Delete</a>
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
</script> -->

@endsection

@section('breadcrumb')
Sales
@endsection