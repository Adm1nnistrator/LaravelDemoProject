@extends('admin.template')

@section('pagetitle')
Edit Category
@endsection

@section('content')
<?php
$old_name = $category_info->category_name;
?>
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
      <h4 class="card-title text-center">Edit Category</h4>
      <form method="POST" action="{{ route('updatecategory') }}">
        @csrf
        <input type="hidden" value="{{ $category_info->id }}" name="category_id">
        <div class="mb-3">
          <label for="name" class="form-label">Category Name:</label>
          <input type="text" id="category_name" name="category_name"
           class="form-control" required value="{{ $old_name }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Category</button>
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
Edit Category
@endsection