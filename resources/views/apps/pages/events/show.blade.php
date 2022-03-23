@extends('layouts.front')

@section('title', "Detail  sur l'evenement")

@section('content')
    <div class="single-listing-page-titlebar"></div>

    <div class="container">
        <div class="row sticky-wrapper">
            <div class="col-lg-8 col-md-8 padding-right-30">
                <div id="titlebar" class="listing-titlebar">
                    <div class="listing-titlebar-title">
                        <h2>
                            {{ strtoupper($event->title) ?? "" }}
                            <span class="listing-tag">{{ $event->category->name ?? "" }}</span>
                        </h2>
                        <span>
                            <a href="#listing-location" class="listing-address">
                                <i class="fa fa-map-marker"></i>
                                {{ $event->address }}, {{ $event->city }}
                            </a> <br>
                            <a href="#listing-location" class="listing-address">
                                <i class="fa fa-map-signs"></i>
                                Country: {{ $event->country }},
                            </a> <br>
                            <a href="#listing-location" class="listing-address">
                                <i class="fa fa-calendar-times-o"></i>
                                Date : {{ $event->date }}
                            </a>
                        </span> <br>
                        <span>
                            <a href="#listing-location" class="listing-address">
                                <i class="fa fa-money"></i>
                                Prices: ${{ $event->buyerPrice ?? "" }}
                            </a><br>
                            <a href="#listing-location" class="listing-address">
                                <i class="fa fa-times"></i>
                                Time : {{ $event->startTime ?? "" }}-{{ $event->endTime ?? "" }}
                            </a>
                        </span> <br>
{{--                        @auth()--}}
{{--                            @if($event->category_id = 1)--}}
{{--                                <span>--}}
{{--                                <form action="" method="post" class="d-inline">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="title" value="{{ $event->title ?? "" }}">--}}
{{--                                    <button type="submit" class="listing-tag">--}}
{{--                                        <i class="sl sl-icon-camrecorder"></i> Join event--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            </span>--}}
{{--                            @endif--}}
{{--                        @endauth--}}
                    </div>
                </div>

                <div class="listing-section">
                    <p>
                        {{ $event->description ?? "" }}
                    </p>

                    <h3 class="listing-desc-headline margin-top-70">Gallery</h3>
                    <div class="listing-slider-small mfp-gallery-container margin-bottom-0">
                        <a
                            href="{{ asset('storage/'.$event->image) }}"
                            data-background-image="{{ asset('storage/'.$event->image) }}"
                            class="item mfp-gallery" title="{{ $event->title ?? "" }}"
                        ></a>
                        @each('apps.components._image', $event->media, 'image')
                    </div>
                    <a
                        href="{{ route('user.booking.event', $event->key) }}"
                        class="button fullwidth margin-top-25"
                    >Book</a>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 margin-top-75 sticky">
                <div class="sidebar right">
                    <div class="widget margin-top-40">
                        <h3 class="margin-top-0 margin-bottom-30">Popular Events in Africa</h3>
                        <ul class="widget-tabs">
                            <x-sidebar>
                                @each('apps.partials.card', $events, 'event', 'apps.pages.events._empty')
                            </x-sidebar>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
