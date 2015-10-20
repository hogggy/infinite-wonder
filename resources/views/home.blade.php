@extends('layouts.master')

@section('content')
    <div class="row carousel-holder">
        <div class="col-md-12">
            <div id="carousel-homepage" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-homepage" data-slide-to="0" class="active"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img class="slide-image active" src="{{ URL::asset('images/home/all-bags.jpg') }}" alt="">
                    </div>
                </div>
                <!--<a class="left carousel-control" href="#carousel-homepage" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-homepage" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>-->
            </div>
        </div>
    </div>
    <hr>

    <!-- Title -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <h3>Hydration Packs</h3>
        </div>
    </div>
    <!-- /.row -->
    <hr>

    <!-- Page Features -->
    <div class="row text-center">
        @foreach ($products as $product)
            <div class="col-md-3 col-sm-6">
                <div class="product">
                    <a href="/product/{{ $product->id }}" class="product"  rel="bookmark">
                        <img src="{{ URL::asset('images/products/' . $product->id . "/main.jpg") }}" alt="Product main image">
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

    @include('modal.addToCart')
@stop

@section('javascript')
    <script src="{{ URL::asset('js/home.js') }}"></script>
@stop