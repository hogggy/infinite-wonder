@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/shop.css') }}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 text-center">
            <h3>Hydration Packs</h3>
        </div>
    </div>
    <hr>
    <div class="row text-center">
        @foreach ($products as $product)
            <div class="col-md-3 col-sm-6">
                <div class="product">
                    <a class="product" href="/product/{{ $product->id }}" rel="bookmark">
                        <img src="{{ URL::asset('images/products/' . $product->id . "/main.jpg") }}" alt="">
                    </a>
                </div>
                <div class="row text-left">
                    <div class="col-sm-12">
                        <h5 class="entry-title">
                            <a href="/product/{{ $product->id }}" rel="bookmark">{{ $product->name }}</a>
                        </h5>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="price">${{ $product->price }}</h5>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button class="to-cart" id="{{ $product->id }}">Add To Cart</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-lg-12">
        <div class="text-center col-lg-4 col-lg-offset-4">
            {!! $products->render() !!}
        </div>
    </div>
    @include('modal.addToCart')
@stop

@section('javascript')
    <script src="{{ URL::asset('js/home.js') }}"></script>
    <script src="{{ URL::asset('js/shop.js') }}"></script>
@stop