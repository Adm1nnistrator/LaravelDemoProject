@extends('admin.template')

@section('pagetitle')
Add SubCategory
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
            <h4 class="card-title text-center">Add Subcategory</h4>
            <form method="post" action="{{ route('storesubcategory') }}">
                @csrf
                <div class="mb-3">
                    <label for="subcategory_name" class="form-label">SubCategory Name:</label>
                    <input type="text" id="subcategory_name" name="subcategory_name" class="form-control" required>
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
                <button type="submit" class="btn btn-primary">Add Subcategory</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('breadcrumb')
Add New Sub-Category
@endsection