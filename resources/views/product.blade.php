@extends('layouts.master')

@section('content')
    <div class="col-lg-4 col-lg-offset-1">
        <div id="productCarousel" class="carousel slide" data-ride="carousel">
            <!-- Carousel indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for carousel items -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="http://placehold.it/400x500" alt="First Slide">
                </div>
                <div class="item">
                    <img src="http://placehold.it/400x500" alt="Second Slide">
                </div>
                <div class="item">
                    <img src="http://placehold.it/400x500" alt="Third Slide">
                </div>
            </div>
            <!-- Carousel controls -->
            <a class="carousel-control left" href="#productCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="carousel-control right" href="#productCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
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