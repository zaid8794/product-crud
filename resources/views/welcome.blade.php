@extends('layout.app')
@section('title', 'Home')
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
        <div class="row">
            <!-- Product Card -->
            @foreach ($products as $product)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->product_image) }}" class="float-center" width="200px"
                            alt="Product Image">
                        <div class="card-body">
                            <a href="/product/{{ $product->slug }}">
                                <h5 class="card-title">{{ $product->product_name }}</h5>
                            </a>
                            <p class="card-text">{{ $product->product_description }}</p>
                            <p class="card-text"><strong>{{ $product->product_price }}</strong></p>
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- You can add more cards here -->
        </div>
    </div>
@endsection
