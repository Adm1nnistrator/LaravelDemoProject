@extends('admin.template')

@section('pagetitle')
Edit SubCategory
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
            <h4 class="card-title text-center">Edit Subcategory</h4>
            <form method="post" action="{{ route('updateSubCate') }}">
                @csrf
                <div class="mb-3">
                    <input type="hidden" value="{{ $subcategory->id }}" name="subcategory_id">
                    <label for="subcategory_name" class="form-label">SubCategory Name:</label>
                    <input type="text" id="subcategory_name" name="subcategory_name" class="form-control" 
                    value="{{ $subcategory->subcategory_name }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Edit Subcategory</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('breadcrumb')
Add New Sub-Category
@endsection