@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/review.css') }}">
@stop

@section('content')
    <div class="col-lg-6 col-lg-offset-3">

        <!-- Title -->
        <div class="row text-center">
            <h2>Review Order</h2>
        </div>
        <!-- /.row -->
        <hr>
        <!-- Page Features -->
        <div class="review-group">
            <div class="row">
                <div class="title">
                    <h4>Shipping Info:</h4>
                    <a href="/my-cart?section=shipping">Edit</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p>
                        {{ $shipping->name }}<br/>{{ $shipping->address1 }}<br/>
                        @if (!empty($shipping->address2)) {{$shipping->address2}}<br/> @endif
                        {{ $shipping->city }}, {{ $shipping->state }} {{ $shipping->postal }}<br/>
                        @if ($shipping->country !== "US") {{ $shipping->country }}<br/>@endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Page Features -->
        <div class="review-group">
            <div class="row">
                <div class="title">
                    <h4>Billing Info:</h4>
                    <a href="/my-cart?section=billing">Edit</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p>
                        {{ $billing->name }}<br/>{{ $billing->address1 }}<br/>
                        @if (!empty($billing->address2)) {{$billing->address2}}<br/> @endif
                        {{ $billing->city }}, {{ $billing->state }} {{ $billing->postal }}<br/>
                        @if ($billing->country !== "US") {{ $billing->country }}<br/>@endif
                    </p>
                </div>
                <div class="col-sm-6 text-right">
                    <p>
                        ************{{ $cart->last_four }}<br/>Expires: {{ $cart->exp_month }}/{{ $cart->exp_year }}<br/>
                    </p>
                </div>
            </div>
        </div>

        <div class="review-group">
            <div class="row">
                <div class="title">
                    <h4>Cart:</h4>
                    <a href="/my-cart?section=cart">Edit</a>
                </div>
            </div>
            <table class="table cart-table">
                <thead>
                    <tr>
                        <th>Quantity</th>
                        <th>Name</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td class="quantity">{{ $item->quantity }}</td>
                        <td class="name">{{ $item->product->name }}</td>
                        <td class="price">${{ $item->product->price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <hr>

        <div class="col-md-6">
            <table class="table prices-table">
                <tbody>
                    <tr>
                        <td>Sub-Total</td>
                        <td>${{ $cartTotalPrice }}</td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>${{ $shippingCost }}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>${{ $cartTotalPrice + $shippingCost }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6 text-right">
            <a href="/thank-you?token-id={{ $token }}&cart-id={{ $cart->id }}">
                <button id="confirm">
                    Confirm Purchase
                </button>
            </a>
        </div>
    </div>
@stop

@section('javascript')
    <script src="{{ URL::asset('js/review.js') }}"></script>
@stop