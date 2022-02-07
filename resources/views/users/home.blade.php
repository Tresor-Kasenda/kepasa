@extends('layouts.front')

@section('content')
    <div class="clearfix"></div>

    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="user-profile-titlebar">
                        <div class="user-profile-avatar">
                            <img src="{{ asset('storage/'.auth()->user()->profile->image) }}" alt="{{ auth()->user()->name ?? "" }}">
                        </div>
                        <div class="user-profile-name">
                            <h2>{{ auth()->user()->name ?? "" }}  {{ auth()->user()->lastName ?? "" }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row sticky-wrapper">
            <div class="col-lg-4 col-md-4 margin-top-0">
                <a href="{{ route('user.home.edit', auth()->user()->key) }}" class="btn btn-primary verified-badge">
                    <i class="sl sl-icon-user-following"></i> Modifier le compte
                </a>
                <div class="boxed-widget margin-top-30 margin-bottom-50">
                    <h3>Contact</h3>
                    <ul class="listing-details-sidebar">
                        <li>
                            <i class="sl sl-icon-phone"></i> Tel 1:  {{ auth()->user()->phones ?? "" }}
                        </li>
                        <li>
                            <i class="sl sl-icon-phone"></i> Tel 2:  {{ auth()->user()->profile->alternativePhones ?? "" }}
                        </li>
                        <li>
                            <i class="fa fa-envelope-o"></i>
                            Email: <a href="{{ auth()->user()->email ?? "" }}">{{ auth()->user()->email ?? "" }}</a>
                        </li>
                        <li>
                            <i class="fa fa-times"></i>
                            Country: {{ auth()->user()->profile->country ?? "" }}
                        </li>
                        <li>
                            <i class="fa fa-times"></i>
                            City: {{ auth()->user()->profile->city ?? "" }}
                        </li>
                    </ul>

                    <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                        <div class="small-dialog-header">
                            <h3>Send Message</h3>
                        </div>
                        <div class="message-reply margin-top-0">
                            <textarea cols="40" rows="3" placeholder="Your message to Tom"></textarea>
                            <button class="button">Send Message</button>
                        </div>
                    </div>

                    <a href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> Send Message</a>
                </div>
            </div>

            <div class="col-lg-8 col-md-8 padding-left-30">
                <h3 class="margin-top-0 margin-bottom-40">{{ auth()->user()->name ?? "" }}'s Listings events</h3>
                <div class="row">
                    @foreach(auth()->user()->events as $event)
                        <div class="col-lg-12 col-md-12">
                            <div class="listing-item-container list-layout">
                                <a href="" class="listing-item">
                                    <div class="listing-item-image">
                                        <img src="" alt="">
                                    </div>
                                    <div class="listing-item-content">
                                        <div class="listing-badge now-open">Now Open</div>
                                        <div class="listing-item-inner">
                                            <h3>Tom's Restaurant</h3>
                                            <span>964 School Street, New York</span>
                                            <div class="star-rating" data-rating="3.5">
                                                <div class="rating-counter">(12 reviews)</div>
                                            </div>
                                        </div>
                                        <span class="like-icon"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
