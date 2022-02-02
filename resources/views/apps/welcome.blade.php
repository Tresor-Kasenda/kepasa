@extends('layouts.apps')

@section('title', "Kepasa Lubumbashi")

@section('content')
    <div class="clearfix"></div>

    <div class="main-search-container full-height alt-search-box centered" data-background-image="">
        <div class="main-search-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-search-input">
                            <div class="main-search-input-headline">
                                <h2>Find deals for any season</h2>
                            </div>
                            <div class="main-search-input-item">
                                <select data-placeholder="All Categories" class="chosen-select" >
                                    <option>All Categories</option>
                                    <option>Shops</option>
                                    <option>Hotels</option>
                                    <option>Restaurants</option>
                                    <option>Fitness</option>
                                    <option>Events</option>
                                </select>
                            </div>
                            <button class="button" onclick="window.location.href=''">Search</button>
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
