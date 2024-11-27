@extends('layout.app')
@section('title', 'Product')
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
            <div class="bg-primary text-white card-header ">
                <h5 class="mb-0">
                    Product List
                    <a href="{{ route('product.create') }}" class="btn btn-warning float-end">Add Product</a>
                </h5>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Product Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($product))
                            @foreach ($product as $item)
                                <!-- Example Data -->
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->category->category_name }}</td>
                                    <td><img src="{{ asset('storage/' . $item->product_image) }}" alt="" width="100px"></td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->product_price }}</td>
                                    <td>{{ $item->product_description }}</td>
                                    <td>
                                        <a href="product/{{ $item->id }}/delete"
                                            class="btn btn-sm btn-danger">Delete</a>
                                        <a href="product/{{ $item->id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr align="center">
                                <td colspan="7">
                                    No Records
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
