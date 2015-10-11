@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/my-cart.css') }}">
@stop

@section('content')
    <div class="review">
        <div class="col-md-6 col-sm-12">
            <ul>
                <li class="row columnCaptions text-left">
                    <span>Address</span>
                    <span><a class="edit" id="edit-address">Edit</a></span>
                </li>
                <li class="row reviewBox" id="address-review"></li>
                <li class="row columnCaptions text-left">
                    <span>Billing</span>
                    <span><a class="edit" id="edit-billing">Edit</a></span>
                </li>
                <li class="row reviewBox" id="billing-review">
                    <p class="address">William Hogben</p>
                    <p class="address">William Hogben</p>
                    <p class="address">William Hogben</p>
                    <p class="address">William Hogben</p>
                </li>
            </ul>
        </div>

        <div class="col-md-6 col-sm-12 text-left">
            <ul class="review-list">
                <li class="row columnCaptions text-left">
                    <span>Cart</span>
                    <span><a class="edit" id="edit-cart">Edit</a></span>
                </li>
                <li class="row">
                    <span class="quantity">1</span>
                    <span class="itemName">Birthday Cake</span>
                    <span class="price">$49.95</span>
                </li>
                <li class="row">
                    <span class="quantity">50</span>
                    <span class="itemName">Party Cups</span>
                    <span class="price">$5.00</span>
                </li>
                <li class="row">
                    <span class="quantity">20</span>
                    <span class="itemName">Beer kegs</span>
                    <span class="price">$919.99</span>
                </li>
                <li class="row">
                    <span class="quantity">18</span>
                    <span class="itemName">Pound of beef</span>
                    <span class="price">$269.45</span>
                </li>
                <li class="row">
                    <span class="quantity">1</span>
                    <span class="itemName">Bullet-proof vest</span>
                    <span class="price">$450.00</span>
                </li>
            </ul>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <ul>
                <li class="row totals">
                    <span class="itemName">Total:</span>
                    <span class="price">$1694.43</span>
                    <span class="order"><a class="text-center">ORDER</a></span>
                </li>
            </ul>
        </div>
    </div>
@stop

@section('javascript')
    <script src="{{ URL::asset('js/my-cart.js') }}"></script>
    <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
    <div id="popover" style="display: none">
        <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
        <a href="#"><span class="glyphicon glyphicon-remove"></span></a>
    </div>
    <script type="text/javascript">
        // This identifies your website in the createToken call below
        Stripe.setPublishableKey('pk_test_KK86wStSLGipxPiHhEgVL1cM');
        // ...
    </script>
@stop

