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

                            <div class="main-search-input-item">
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
                        <div class="carousel-item">
                            <a href="" class="listing-item-container">
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
                        <div class="carousel-item">
                            <a href="" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="" alt="">
                                    <div class="listing-item-details">
                                        <ul>
                                            <li>Friday, August 10</li>
                                        </ul>
                                    </div>
                                    <div class="listing-item-content">
                                        <span class="tag">Events</span>
                                        <h3>Sticky Band</h3>
                                        <span>Bishop Avenue, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="5.0">
                                    <div class="rating-counter">(23 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="" alt="">
                                    <div class="listing-item-details">
                                        <ul>
                                            <li>Starting from $59 per night</li>
                                        </ul>
                                    </div>
                                    <div class="listing-item-content">
                                        <span class="tag">Hotels</span>
                                        <h3>Hotel Govendor</h3>
                                        <span>778 Country Street, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="2.0">
                                    <div class="rating-counter">(17 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="" alt="">

                                    <div class="listing-badge now-open">Now Open</div>

                                    <div class="listing-item-content">
                                        <span class="tag">Eat & Drink</span>
                                        <h3>Burger House <i class="verified-icon"></i></h3>
                                        <span>2726 Shinn Street, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="5.0">
                                    <div class="rating-counter">(31 reviews)</div>
                                </div>
                            </a>
                        </div>
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
                        <div class="carousel-item">
                            <a href="" class="listing-item-container">
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
                        <div class="carousel-item">
                            <a href="" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="" alt="">
                                    <div class="listing-item-details">
                                        <ul>
                                            <li>Friday, August 10</li>
                                        </ul>
                                    </div>
                                    <div class="listing-item-content">
                                        <span class="tag">Events</span>
                                        <h3>Sticky Band</h3>
                                        <span>Bishop Avenue, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="5.0">
                                    <div class="rating-counter">(23 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="" alt="">
                                    <div class="listing-item-details">
                                        <ul>
                                            <li>Starting from $59 per night</li>
                                        </ul>
                                    </div>
                                    <div class="listing-item-content">
                                        <span class="tag">Hotels</span>
                                        <h3>Hotel Govendor</h3>
                                        <span>778 Country Street, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="2.0">
                                    <div class="rating-counter">(17 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="" alt="">

                                    <div class="listing-badge now-open">Now Open</div>

                                    <div class="listing-item-content">
                                        <span class="tag">Eat & Drink</span>
                                        <h3>Burger House <i class="verified-icon"></i></h3>
                                        <span>2726 Shinn Street, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="5.0">
                                    <div class="rating-counter">(31 reviews)</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#country").change(function () {
                const country = $("#country option:selected").val()
                $.ajax({
                    type: "post",
                    url: `{{ route('cities.listens') }}`,
                    data: {country: country},
                    dataType: "json",
                    success: function(response){
                        $('#cityName').show();
                        $.each(response, function (key, value) {
                            $('#cityName').append('<option value=" ' + value.id + '">' + value.cityName + '</option>');
                        })
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
