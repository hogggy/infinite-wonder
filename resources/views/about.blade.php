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
                Stuff about our company blah blah blah we build stuff blah blah
                blah this is the stuff we make and we are cool blah blah 123 bl
                blah this is the stuff we make and we are cool blah blah 123 bl
                Stuff about our company blah blah blah we build stuff blah blah
            </p>
            <p>
                This is another paragraph I am a robot beep boop this is the things
                i say blah blah blah
            </p>
        </div>
    </div>

    @include('modal.addToCart')
@stop

@section('javascript')
    <script src="{{ URL::asset('js/about.js') }}"></script>
@stop