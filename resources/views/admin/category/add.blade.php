@extends('admin.template')

@section('pagetitle')
Add Category
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
        <h4 class="card-title text-center">Add Category</h4>
        <form method="post" action="{{ route('storecategory') }}">
         @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Category Name:</label>
            <input type="text" id="category_name" name="category_name" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
      </div>
    </div>
  </div>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $category_name = $_POST['category_name'];
  
  // Add category to database
  // ...

}

?>
@endsection

@section('breadcrumb')
   Add New Category
@endsection