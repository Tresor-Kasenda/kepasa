@extends('layouts.apps')

@section('title', "Kepasa")

@section('content')
    <div class="clearfix"></div>

    <div class="main-search-container full-height alt-search-box centered" data-background-image="{{ asset('assets/images/banner0.jpg') }}">
        <div class="main-search-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form method="get" id="search-data">
                            <div class="main-search-input">
                                <div class="main-search-input-headline">
                                    <h3>Select the country for the city you are looking for.</h3>
                                </div>
                                <div class="main-search-input-item">
                                    <select data-placeholder="All Country" name="country" id="country" class="chosen-select" >
                                        <option>All Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->countryCode }}">
                                                {{ $country->countryName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="main-search-input-item" id="city">
                                    <div class="viewRender"></div>
                                </div>
                                <button class="button">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="fullwidth padding-top-10 padding-bottom-10" data-background-color="#ffffff">
        <div class="container">
            <div id="error" class="padding-top-15"></div>
            <div class="row">
                <div class="renderSearch"></div>
            </div>
        </div>
    </section>

    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Event in promotion {{ $location->cityName ?? "" }}</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('event.index') }}">All Event</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="fullwidth padding-top-30 padding-bottom-40" data-background-color="#ffffff">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(count($events) > 0)
                        <div class="simple-slick-carousel dots-nav">
                            @foreach($events as $event)
                                <div class="carousel-item">
                                    <a href="{{ route('event.show',$event->key) }}" class="listing-item-container">
                                        <div class="listing-item">
                                            <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}">
                                            <div class="listing-item-details">
                                                <ul>
                                                    <li>{{ $event->startTime }}-{{ $event->endTime }}, {{ $event->date  }}</li>
                                                </ul>
                                            </div>
                                            <div class="listing-item-content">
                                                <span class="tag">{{ strtoupper($event->category->name) ?? "" }}</span>
                                                <h3>
                                                    {{ strtoupper($event->title) ?? "" }}
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
            </div>
        </div>
    </section>

    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Featured Cities</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a class="text-teal-dim" href="{{ route('promotion.request') }}">Promote Your City.</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @if(count($cities) > 0)
        <section class="fullwidth padding-top-50 padding-bottom-70" data-background-color="#ffffff">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="simple-slick-carousel dots-nav">
                            @foreach($cities as $city)
                                <div class="carousel-item">
                                    <a href="{{ route('city.detail', ['cityName' => $city->cityName]) }}" class="listing-item-container">
                                        <div class="listing-item">
                                            <img src="" alt="{{ $city->cityName }}">
                                            <div class="listing-item-content">
                                                <h3>{{ strtoupper($city->cityName) ?? "" }}</h3>
                                                <span>languages: {{ $event->languages ?? "" }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#country").change(function () {
                const country = $("#country option:selected").val()
                $.ajax({
                    type: "post",
                    url: `{{ route('cities.listens') }}`,
                    data: {
                        country: country,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType : 'json',
                    success: function(response){
                        if (response){
                            $('.viewRender').html(response.views);
                        }
                    }
                })
            })

            $('#search-data').submit(function (e) {
                e.preventDefault();
                const country = $('#country').val()
                const city = $('#cityName').val()
                $.ajax({
                    type: "get",
                    url: `{{ route('search.events') }}`,
                    data: {
                        country: country,
                        city: city
                    },
                    dataType : 'json',
                    success: function(response){
                        if (response.search){
                            $('.renderSearch').html(response.search)
                        }else {
                            console.log(response.messages)
                            $('#error').html('<div class="col-md-12"><div class="notification success closeable margin-bottom-30"><p><strong>Sorry</strong>' + response.messages+ '</p><a class="close"></a></div></div>');
                        }
                    }
                })
            })
        })
    </script>
@endsection

@section('styles')
    <style>
        .main-search-input select, .main-search-input select:focus {
            font-size: 16px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 1px 3px 0px rgb(0 0 0 / 8%);
            background: #fff;
            height: 55px;
            padding: 12px 18px;
            border-radius: 4px;
        }
    </style>
@endsection
