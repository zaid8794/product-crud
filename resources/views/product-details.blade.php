@extends('layout.app')
@section('title', $product->product_slug)
@section('main')
    <div class="mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->product_name }}</li>
            </ol>
        </nav>
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
        <div class="row">
            <!-- Main Product Details Section -->
            <div class="col-md-8">
                <div class="card">
                    <img src="{{ asset('storage/' . $product->product_image) }}" width="300px" alt="Product Image">
                    <div class="card-body">
                        <h3 class="card-title">{{ $product->product_name }}</h3>
                        <p class="card-text"><strong>{{ $product->product_price }}</strong></p>
                        <p class="card-text">Category : <strong>{{ $product->category->category_name }}</strong></p>
                        <p class="card-text">{{ $product->product_description }}</p>

                        <!-- Add to Cart and Wishlist Buttons -->
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Relevant Products Area -->
            <div class="col-md-4">
                <h4>Related Products</h4>
                <div class="row">
                    @foreach ($relatedProduct as $item)
                        <!-- Product Card 1 -->
                        <div class="col-6 mb-4">
                            <div class="card" style="width: 100%;">
                                <img src="{{ asset('storage/' . $item->product_image) }}" class="card-img-top"
                                    alt="Related Product 1">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->product_name }}</h5>
                                    <p class="card-text"><strong>{{ $item->product_price }}</strong></p>
                                    <a href="/product/{{ $item->slug }}" class="btn btn-outline-primary btn-sm">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
