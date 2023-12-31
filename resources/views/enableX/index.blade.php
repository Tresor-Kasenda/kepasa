@extends('layouts.enablex')

@section('title', "Event online room")

@section('content')
    <div class="wrapper">
{{--        <div class="preloader"></div>--}}
        <div class="site-overlay"></div>
        @include('enableX.components._sidebar')
        @include('enableX.components._option')
        @include('enableX.components._header')
        <div class="site-content" id="video-container">
            <div class="content-area">
                <div class="container-fluid px-0 relative" id="testDiv">
                    <div class="only-par-msg alert alert-danger-fill alert-dismissible  fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 id="availabilty_msg">No one joined this Session</h4>
                    </div>
                    <div class="only-mod-msg alert alert-danger-fill alert-dismissible  fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="watermark text-center mt-3">
                        <img class="img-fluid" id="water-mark-image" src="https://kepasa.africa/logo3.png">
                    </div>
                    <div class="confo-container conf-visible" style="display: none;">
                        <div id="layout_manager" class="" style="height: 100%;width:100%;"></div>
                    </div>
                </div>
            </div>
        </div>
        @include('enableX._footer')
    </div>
@endsection
