@extends('layout.app')
@section('title', 'Edit Product')
@section('main')
    <div class="mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Update Product</h5>
            </div>
            <div class="card-body">
                <form action="/product/{{ $product->id }}/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <!-- Category Name -->
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Product Category</label>
                        <select class="form-control" id="productCategory" name="category_id">
                            <option value="{{ $product->category_id }}">{{ $product->category->category_name }}</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @endforeach

                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" value="{{ $product->product_name }}" id="productName"
                            placeholder="Enter Product name" name="product_name">
                        @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Product Price</label>
                        <input type="text" class="form-control" value="{{ $product->product_price }}" id="productPrice"
                            placeholder="Enter Product Price" name="product_price">
                        @error('product_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea class="form-control" id="productDescription" name="product_description" rows="4"
                            placeholder="Enter Product description">{{ $product->product_description }}</textarea>
                        @error('product_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <img src="{{ asset('storage/' . $product->product_image) }}"
                            style="max-width: 200px; max-height: 100px;" alt="">
                        <input type="hidden" name="old_product_image" value="{{ $product->product_image }}">
                        <input type="file" class="form-control" id="productImage" name="new_product_image">
                        @error('product_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div id="imagePreview">

                        </div>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">Save Product</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#productImage').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').html('<img src="' + e.target.result +
                        '" style="max-width: 300px; max-height: 300px;" />');
                }
                reader.readAsDataURL(event.target.files[0]);
            });
        });
    </script>
@endsection
