@extends('layout.app')
@section('main')
    <form action="{{ route('checkout.store') }}" method="post">
        @csrf
        <div class="container mt-5">
            <h2 class="mb-4">Checkout</h2>
            <div class="row">
                <!-- Mini Cart List -->
                <div class="col-md-4">
                    <h4>Cart Summary</h4>
                    <ul class="list-group">
                        @php
                            $subtotal = 0;
                            $total = 0;
                        @endphp
                        @foreach ($cart as $item)
                            @php
                                $subtotal = $item->qty * $item->product->product_price;
                                $total += $subtotal;
                            @endphp
                            <!-- Product 1 -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item->product->product_name }}</strong><br>
                                    <small>Qty: {{ $item->qty . ' x ' . '₹' . $item->product->product_price }}</small>
                                </div>
                                <span>{{ '₹' . $subtotal }}</span>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Total</strong>
                            <strong>{{ '₹' . $total }}</strong>
                        </li>
                    </ul>
                </div>

                <!-- Address Form -->
                <div class="col-md-4">
                    <h4>Shipping Address</h4>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="ship_name" id="name" placeholder="John Doe">
                        @error('ship_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="ship_email"
                            placeholder="example@example.com">
                        @error('ship_email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="ship_phone"
                            placeholder="+1234567890">
                        @error('ship_phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" rows="3" name="ship_address"
                            placeholder="123 Main Street, City, State, ZIP"></textarea>
                        @error('ship_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="col-md-4">
                    <h4>Payment Method</h4>
                    <!-- Cash on Delivery -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="cashOnDelivery"
                            value="cod">
                        <label class="form-check-label" for="cashOnDelivery">
                            Cash on Delivery
                        </label>
                    </div>
                    <!-- Net Banking -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="netBanking"
                            value="netBanking">
                        <label class="form-check-label" for="netBanking">
                            Net Banking
                        </label>
                    </div>
                    <!-- UPI -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="upi" value="upi">
                        <label class="form-check-label" for="upi">
                            UPI
                        </label>
                    </div>
                    @error('payment_method')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Proceed Button -->
            <div class="text-end mt-4">
                <button class="btn btn-primary">Place Order</button>
            </div>
        </div>
    </form>
@endsection
