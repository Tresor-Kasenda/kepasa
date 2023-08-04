@extends('layouts.apps')

@section('title', "Kepasa")

@section('content')
    <div class="clearfix"></div>

    <div class="main-search-container full-height alt-search-box centered"
         data-background-image="{{ asset('assets/images/banner0.jpg') }}">
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
                                    <select data-placeholder="All Country" name="country" id="country"
                                            class="chosen-select">
                                        <option>All Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->country_code }}">
                                                {{ $country->country_name ?? "" }}
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

    <section class="fullwidth padding-top-50 padding-bottom-10" data-background-color="#ffffff">
        <div class="container">
            <div id="error" class="padding-top-15"></div>
            <div class="row">
                <div class="renderSearch"></div>
            </div>
        </div>
    </section>

    <div class="container" id="listenCities">
        <div class="row">
            <div class="col-md-12">
                <h3 class="headline centered margin-bottom-35 margin-top-70">Popular Cities <span>Browse listings in popular places</span>
                </h3>
            </div>

            <livewire:city/>
        </div>
    </div>

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

    <section id="eventsListens" class="fullwidth padding-top-30 padding-bottom-40" data-background-color="#ffffff">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(count($events) > 0)
                        <div class="simple-slick-carousel dots-nav">
                            @each('apps.components._card', $events, 'event', 'apps.components._empty')
                        </div>
                    @else
                        <div class="text-center justify-content-center">
                            <h4>&#128549; No events in <span
                                    style='color: #f91942; font-weight: 700;'>{{ $location->cityName ?? "" }}</span>
                            </h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#country").change(function () {
                const country = $("#country option:selected").val()
                $.ajax({
                    type: "get",
                    url: `{{ route('country.index') }}`,
                    data: {
                        country: country,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response) {
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
                    url: `{{ route('event.search') }}`,
                    data: {
                        country: country,
                        city: city
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.search) {
                            $('.renderSearch').html(response.search)
                            $('#titlebar').hide()
                            $('#listenCities').hide()
                            $('#eventsListens').hide()
                        } else {
                            $('#error').html('<div class="col-md-12">' +
                                '<div class="notification success closeable margin-bottom-30">' +
                                '<p> <strong>Sorry </strong>' + response.messages + '</p><a class="close"></a>' +
                                '</div>' +
                                '</div>');
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
