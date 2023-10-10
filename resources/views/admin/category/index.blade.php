@extends('admin.template')

@section('pagetitle')
Categories Info
@endsection

@section('content')
<div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
   <div class="card">
      <h5 class="card-header">Category Information</h5>
      @if(session()->has('success'))
      <div class="alert alert-success">
         {{ session()->get('success') }}
      </div>
      @endif

      <div class="card-body p-0">
         <div class="table-responsive">
            <table class="table">

               <a href="{{ route('Add Category') }}" class="btn btn-primary btn-sm mx-3 my-2">Add New Category</a>
               <thead class="bg-light">
                  <tr class="border-0">
                     <th class="border-0">#</th>
                     <th class="border-0">Category Name</th>
                     <th class="border-0">Sub Category Count</th>
                     <th class="border-0">Category Product Count</th>
                     <th class="border-0">Slug</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($categories as $category)
                  <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{ $category->category_name }}</td>
                     <td>{{ $category->subcategory_count}}</td>
                     <td>{{ $category->subcategory_count}}</td>
                     <td>{{ $category->slug }}</td>
                     <td>
                        <a href="{{ route('editcategory', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                     </td>
                     <td>
                        <a href="" class="btn btn-danger btn-sm">Delete</a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection

@section('breadcrumb')
Categories
@endsection