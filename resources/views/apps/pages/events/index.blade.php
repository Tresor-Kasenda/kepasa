@extends('layouts.front')

@section('title', "Liste des evenements organiser")

@section('content')
    <div class="clearfix"></div>
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>All Events</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li>
                                <a href="{{ route('home.index') }}">Home</a></li>
                            <li>Events</li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 padding-right-30">
                @if(count($events) > 0)
                    <div class="row">
                        @foreach($events as $event)
                            <div class="col-lg-6 col-md-12">
                                <a href="#" class="listing-item-container">
                                    <div class="listing-item">
                                        <img src="" alt="">

                                        <div class="listing-badge now-open">Now Open</div>

                                        <div class="listing-item-content">
                                            <span class="tag">Eat & Drink</span>
                                            <h3>Tom's Restaurant <i class="verified-icon"></i></h3>
                                            <span>964 School Street, New York</span>
                                        </div>
                                        <span class="like-icon"></span>
                                    </div>
                                    <div class="star-rating" data-rating="3.5">
                                        <div class="rating-counter">(12 reviews)</div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center justify-content-center">
                        <h4>&#128549; No events in <span style='color: #f91942; font-weight: 700;'>{{ $location->cityName ?? "" }}</span></h4>
                    </div>
                @endif
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="sidebar right">
                    <div class="widget margin-top-40">
                        <h3 class="margin-top-0 margin-bottom-30">Popular Events in Africa</h3>
                        <ul class="widget-tabs">
                            @if(count($events) > 0)
                                <x-sidebar events="{{ $events }}" />
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
