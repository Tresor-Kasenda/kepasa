@extends('layouts.front')

@section('title', "Liste des evenements event")

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
                                <a href="{{ route('home.index') }}">Home</a>
                            </li>
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
                                <a href="{{ route('event.show',$event->key) }}" class="listing-item-container">
                                    <div class="listing-item">
                                        <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}">
                                        <div class="listing-item-content">
                                            <span class="tag">{{ strtoupper($event->category->name) ?? "" }}</span>
                                            <h3>
                                                {{ $event->title ?? "" }}
                                                @if($event->promoted == true)
                                                    <i class="verified-icon"></i>
                                                @endif
                                            </h3>
                                            <span>{{ $event->address ?? "" }}, {{ $event->city }}</span>
                                        </div>
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
