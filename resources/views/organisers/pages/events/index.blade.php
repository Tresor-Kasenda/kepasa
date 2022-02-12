@extends('layouts.organiser')

@section('title', "Modification des informations de l'organteur d'evenement")

@section('content')
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Listens events</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li>
                            <a
                                href="{{ route('organiser.events.create') }}"
                                class="button border"
                            >
                                Add Listing <i class="sl sl-icon-plus"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <h4>Events Listings</h4>
                <ul>
                    <li>
                        <div class="list-box-listing">
                            <div class="list-box-listing-img">
                                <a href="#">
                                    <img src="" alt="">
                                </a>
                            </div>
                            <div class="list-box-listing-content">
                                <div class="inner">
                                    <span class="tag">Education</span>
                                    <h3><a href="#">Tom's Restaurant</a></h3>
                                    <span>964 School Street, New York</span>
                                    <div class="star-rating">
                                        <span class="message-by">0 ticket(s) bought <span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-to-right">
                            <a href="#" class="button gray approve">
                                <i class="sl sl-icon-check"></i> Booking
                            </a>
                            <a href="#" class="button gray">
                                <i class="sl sl-icon-note"></i> Edit
                            </a>
                            <a href="#" class="button gray">
                                <i class="sl sl-icon-close"></i> Delete
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .list-box-listing-content .inner{
            top: 0;
        }
        .tag{
            background-color: #64bc36;
            color: #fff;
            padding: 6px 15px;
            line-height: 20px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 50px

        }
        .message-by{
            background-color: #e9e9e9;
            border-radius: 50px;
            line-height: 20px;
            font-size: 12px;
            color: #666;
            font-style: normal;
            padding: 3px 8px;
            margin-left: 3px;
            max-height: 1.4rem;
            text-align: left;
        }
        .message-by{
            padding-bottom: 20px;
        }
    </style>
@endsection
