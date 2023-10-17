@extends('admin.template')

@section('pagetitle')
New Sale
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
            <h4 class="card-title text-center">Add New Sales</h4>
            <form method="post" action="{{ route('storesale') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="sale_name" class="form-label">Sale Name</label>
                    <input class="form-control" type="text" id="sale_name" name="sale_name">
                </div>

                <div class="form-group">
                    <label for="sale_from" class="form-label">Sale Start Date</label>
                    <input class="form-control" type="datetime-local" id="sale_from" name="sale_from">
                </div>

                <div class="form-group">
                    <label for="sale_to" class="form-label">Sale End Date</label>
                    <input class="form-control" type="datetime-local" id="sale_to" name="sale_to">
                </div>

                <div class="form-group">
                    <label for="sale_percent" class="form-label">Sale Percent</label>
                    <input class="form-control" type="number" id="sale_percent" name="sale_percent">
                </div>

                <div class="form-group">
                    <label class="form-label">Select Products</label>
                    <div class="dropdown-scrollable">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="productDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select Products
                        </button>
                        <div class="dropdown-menu" style="height: 500px; padding:15px; overflow:scroll; top:0px;" aria-labelledby="productDropdown">
                            @foreach ($products as $product)
                            <div class="form-check d-flex align-item-center">
                                <input class="form-check-input" type="checkbox" id="product_{{ $product->id }}" name="selected_products[]" value="{{ $product->id }}">
                                <label class="form-check-label " style="font-size: 16px;" for="product_{{ $product->id }}">
                                    {{ $product->product_name }}
                                </label>
                            </div>
                            <div class="form-check d-flex align-item-center">
                                <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}" width="50" height="50">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>

        </div>
    </div>
</div>

<!-- <script>
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
</script> -->

@endsection

@section('breadcrumb')
Add New Sales
@endsection