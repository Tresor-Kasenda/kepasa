@extends('layouts.apps')

@section('title', "Kepasa Lubumbashi")

@section('content')
    <div class="clearfix"></div>

    <div class="main-search-container full-height alt-search-box centered" data-background-image="{{ asset('assets/images/banner0.jpg') }}">
        <div class="main-search-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
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
                                <select name="cityName" id="cityName" class="chosen-select"></select>
                            </div>
                            <button class="button" id="submit">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Event in promotion</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('event.index') }}">All Event</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="fullwidth padding-top-50 padding-bottom-70" data-background-color="#ffffff">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="simple-slick-carousel dots-nav">
                        @foreach($events as $event)
                            <div class="carousel-item">
                                <a href="{{ route('events.show', ['detail' => $event->key]) }}" class="listing-item-container">
                                    <div class="listing-item">
                                        <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}">
                                        <div class="listing-item-details">
                                            <ul>
                                                <li>{{ $event->startTime }}-{{ $event->endTime }}, {{ $event->date  }}</li>
                                            </ul>
                                        </div>
                                        <div class="listing-item-content">
                                            <span class="tag">{{ strtoupper($event->category->name) ?? "" }}</span>
                                            <h3>{{ strtoupper($event->title) ?? "" }}</h3>
                                            <span>{{ $event->address ?? "" }}, {{ $event->city }}</span>
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

    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Featured Cities</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('promotion.request') }}">Promote Your City.</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

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

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#city').hide()
            $("#country").change(function () {
                const country = $("#country option:selected").val()
                $("#cityName").html('');
                $.ajax({
                    type: "post",
                    url: `{{ route('cities.listens') }}`,
                    data: {
                        country: country,
                        _token: '{{csrf_token()}}'
                    },
                    dataType : 'json',
                    success: function(response){
                        if (response){
                            $('div#city, select#cityName').show()
                            $('#cityName').html('<option>Select City</option>')
                            $.each(response.cities,function(key,value){
                                $('#cityName').append('<option value=" ' + value.id + '">' + value.cityName + '</option>');
                            });
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
