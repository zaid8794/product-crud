@extends('layout.app')
@section('title', 'Cart')
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
        <h2 class="mb-4">Shopping Cart</h2>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                    $total = 0;
                @endphp
                @if (count($cart))
                    @foreach ($cart as $item)
                        @php
                            $subtotal = $item->qty * $item->product->product_price;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $item->product->product_image) }}" alt="Product Image"
                                        style="width: 100px; height: 120px;" class="me-3">
                                    <span>{{ $item->product->product_name }}</span>
                                </div>
                            </td>
                            <td>{{ '₹ ' . $item->product->product_price }}</td>
                            <td>
                                <input type="number" value="{{ $item->qty }}" min="1" class="form-control"
                                    style="width: 80px;">
                            </td>
                            <td>{{ '₹ ' . $subtotal }}</td>
                            <td>
                                <a href="cart/{{ $item->id }}/delete" class="btn btn-danger btn-sm">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr align="center">
                        <td colspan="5">
                            No Record
                        </td>
                    </tr>
                @endif
                <tr>
                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                    <td><strong>{{ '₹ ' . $total }}</strong></td>
                </tr>
            </tbody>
        </table>
        <!-- Checkout Button -->
        <div class="text-end">
            <a href="{{ route('checkout.index') }}" class="btn btn-primary">Proceed to Checkout</a>
        </div>
    </div>
@endsection
