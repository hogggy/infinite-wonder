@extends('layouts.master')

@section('content')
    <div class="col-lg-6 col-lg-offset-3">

        <!-- Title -->
        <div class="row text-center">
            <h2>About Us</h2>
        </div>
        <!-- /.row -->
        <hr>

        <!-- Page Features -->
        <div class="row">
            <p>
                Infinite Wonder is happy to introduce our first hydration pack. Light, durable, and covered
                in extraordinary visionary art the design allows for a nearly seamless representation of the
                featured artwork. This provides the unique experience of actually carrying a beautiful art
                print that just so happens to be the perfect hydration pack to keep you hands free for your
                outdoor activities.
            </p>
            <p>
                Infinite Wonder is a small business founded in Peoria, Illinois by music festival and outdoor
                enthusiasts. We hope that our products can be appreciated by all those who love adventures
                and we will continue to support and promote artists as we grow and expand our inventory.
                New products coming June 2016!
            </p>
        </div>

        <hr>

        <!-- Title -->
        <div class="row text-center">
            <h2>Contact Us</h2>
        </div>
        <!-- /.row -->
        <hr>

        <!-- Page Features -->
        <div class="row">
            <p>
                Artists, musicians, teams, clubs, businesses, and personal orders or collaborations
                are more than welcome! Please contact us.
            </p>
            <p>
                Any questions, concerns, or comments please don't hesitate to email us. You will receive a response
                within approximately 24 hours. We will promptly work to satisfy all of your needs!
            </p>
        </div>
    </div>

    @include('modal.addToCart')
@stop

@section('javascript')
    <script src="{{ URL::asset('js/about.js') }}"></script>
@stop