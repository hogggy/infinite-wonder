@extends('layouts.master')

@section('content')
    <div class="col-lg-4 col-lg-offset-1">
        <img src="http://placehold.it/400x500" alt="">
    </div>
    <div class="col-lg-6">

        <!-- Title -->
        <div class="row text-center">
            <h3>{{ $product->name }}</h3>
        </div>
        <!-- /.row -->
        <hr>

        <!-- Page Features -->
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <p>{{ $product->desc }}</p>
            </div>
        </div>
        <hr>
        <div class="row text-center">
            <div class="col-sm-6">
                <h5 class="price">${{ $product->price }}</h5>
            </div>
            <div class="col-sm-6 text-right">
                <button class="to-cart" id="{{ $product->id }}">Add To Cart</button>
            </div>
        </div>
    </div>

    @include('modal.addToCart')
@stop

@section('javascript')
    <script src="{{ URL::asset('js/home.js') }}"></script>
@stop