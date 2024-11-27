@extends('layout.app')
@section('title','My Orders')
@section('main')
    <div class="mt-5">
        <h2 class="mb-4">My Orders</h2>
        @if (count($orders))
            @foreach ($orders as $orderNo => $product)
                <!-- Order Card 1 -->
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><strong>Order #{{ $orderNo }}</strong></span>
                        <span class="badge bg-primary">Processing</span>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Order Date: <span class="text-muted"></span></h6>
                        <h6 class="card-title">Total: <span class="text-muted">$129.99</span></h6>
                        <p class="card-text">
                            <strong>Items:</strong>
                        <ul class="list-unstyled mb-0">
                            @php
                                $subtotal = 0;
                                $total = 0;
                            @endphp
                            @foreach ($product as $value)
                                @php
                                    $subtotal = $value->qty * $value->product->product_price;
                                    $total += $subtotal;
                                @endphp
                                <li>{{ $value->product->product_name }} </li>
                                <li>Qty :{{ $value->qty . ' x ' . '₹' . $value->product->product_price }}</li>
                                <li>Subtotal : <strong>{{ '₹' . $subtotal }}</li></strong>
                                <br>
                            @endforeach
                        </ul>
                        </p>
                    </div>
                    <div class="card-footer text-end">
                        <p>Total : <strong>{{ '₹' . $total }}</strong> </p>
                    </div>
                </div>
            @endforeach
        @else
            <h1>No Orders</h1>
        @endif
    </div>
@endsection
