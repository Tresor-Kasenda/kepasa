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
                <div class="row margin-bottom-25 margin-top-30">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="fullwidth-filters">
                            <div class="sort-by">
                                <div class="sort-by-select">
                                    <select data-placeholder="Default order" class="chosen-select-no-single">
                                        <option>Default Order</option>
                                        <option>Highest Rated</option>
                                        <option>Most Reviewed</option>
                                        <option>Newest Listings</option>
                                        <option>Oldest Listings</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
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
                    <div class="col-lg-6 col-md-12">
                        <a href="#" class="listing-item-container">
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
                    <div class="col-lg-6 col-md-12">
                        <a href="#" class="listing-item-container">
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
                    <div class="col-lg-6 col-md-12">
                        <a href="#" class="listing-item-container">
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
            <div class="col-lg-3 col-md-3">
                <div class="sidebar right">
                    <div class="widget margin-top-40">
                        <h3 class="margin-top-0 margin-bottom-30">Popular Events in Africa</h3>
                        <ul class="widget-tabs">
                            <li>
                                <div class="widget-content">
                                    <div class="widget-thumb">
                                        <a href="">
                                            <img src="" alt="">
                                        </a>
                                    </div>
                                    <div class="widget-text">
                                        <h5>
                                            <a href="">Hotels for All Budgets </a>
                                        </h5>
                                        <span>October 26, 2016</span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
