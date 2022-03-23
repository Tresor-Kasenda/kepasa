@extends('layouts.front')

@section('content')
    <div class="clearfix"></div>

    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="user-profile-titlebar">
                        <div class="user-profile-avatar">
                            <img
                                @if(auth()->user()->profile->image == null)
                                src="{{ asset('assets/images/profile.jpg') }}"
                                alt="{{ auth()->user()->name ?? "" }}"
                                @else
                                src="{{ asset('storage/'.auth()->user()->profile->image) }}"
                                alt="{{ auth()->user()->name ?? "" }}"
                                @endif
                            >
                        </div>
                        <div class="user-profile-name">
                            <a href="{{ route('user.home.index') }}">
                                <h2>{{ auth()->user()->name ?? "" }}  {{ auth()->user()->lastName ?? "" }}</h2>
                            </a>
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
                <div class="text-center justify-content-center">
                    <a href="{{ route('logout') }}" class="send-message-to-owner button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="sl sl-icon-logout"></i>
                        <span>Sign out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>

            <div class="col-lg-8 col-md-8 padding-left-30">
                <h3 class="margin-top-0 margin-bottom-40">{{ auth()->user()->name ?? "" }}'s events</h3>
                <div class="row">
                    <div id="titlebar" class="listing-titlebar">
                        <div class="listing-titlebar-title">
                            <h2>
                                {{ strtoupper($invoice->event->title) ?? "" }}
                                <span class="listing-tag">{{ $invoice->event->category->name ?? "" }}</span>
                            </h2>
                            <span>
                            <a href="#listing-location" class="listing-address">
                                <i class="fa fa-map-marker"></i>
                                {{ $invoice->event->address }}, {{ $invoice->event->city }}
                            </a> <br>
                            <a href="#listing-location" class="listing-address">
                                <i class="fa fa-map-signs"></i>
                                Country: {{ $invoice->event->country }},
                            </a> <br>
                            <a href="#listing-location" class="listing-address">
                                <i class="fa fa-calendar-times-o"></i>
                                Date : {{ $invoice->event->date }}
                            </a>
                        </span> <br>
                            <span>
                            <a href="#listing-location" class="listing-address">
                                <i class="fa fa-money"></i>
                                Prices: $ {{ $invoice->totalAmount ?? "" }}
                            </a><br>
                            <a href="#listing-location" class="listing-address">
                                <i class="fa fa-times"></i>
                                Time : {{ $invoice->event->startTime ?? "" }}-{{ $invoice->event->endTime ?? "" }}
                            </a>
                        </span>
                        </div>
                    </div>

                    <div class="listing-section">
                        <p>
                            {{ $invoice->event->description ?? "" }}
                        </p>

                        <h3 class="listing-desc-headline margin-top-70">Gallery</h3>
                        <div class="listing-slider-small mfp-gallery-container margin-bottom-0">
                            <a
                                href="{{ asset('storage/'.$invoice->event->image) }}"
                                data-background-image="{{ asset('storage/'.$invoice->event->image) }}"
                                class="item mfp-gallery" title="{{ $invoice->event->title ?? "" }}"
                            ></a>
                            @each('apps.components._image', $invoice->event->media, 'image')
                        </div>
                        <a
                            href="{{ route('user.invoice.download', $invoice->key) }}"
                            class="button fullwidth margin-top-25"
                        >Download Invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
