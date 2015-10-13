@extends('layouts.master')

@section('content')
    <div class="row carousel-holder">
        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img class="slide-image" src="http://placehold.it/1200x500" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" src="http://placehold.it/1200x500" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" src="http://placehold.it/1200x500" alt="">
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
    <hr>

    <!-- Title -->
    <div class="row">
        <div class="col-lg-2 col-lg-offset-5">
            <h3>Top Sellers</h3>
        </div>
    </div>
    <!-- /.row -->
    <hr>

    <!-- Page Features -->
    <div class="row text-center">
        @foreach ($products as $product)
            <div class="col-md-3 col-sm-6">
                <a href="/product/{{ $product->id }}" rel="bookmark">
                    <img src="http://placehold.it/400x500" alt="">
                </a>
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