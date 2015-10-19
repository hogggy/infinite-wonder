@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/review.css') }}">
@stop

@section('content')
    <div class="col-lg-6 col-lg-offset-3">

        <!-- Title -->
        <div class="row text-center">
            <h2>Ordered Completed!</h2>
        </div>
        <!-- /.row -->
        <hr>
        <p>
            Your new gear from fullprintcamping.com is on the way. An email has been sent to you with your
            order receipt. You can review your order <a href="/order-details/{{ $cartId }}">here</a>
        </p>

    </div>
@stop