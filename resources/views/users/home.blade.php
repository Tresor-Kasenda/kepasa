@extends('layouts.front')

@section('content')
    <div class="clearfix"></div>

    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="event-profile-titlebar">
                        <div class="event-profile-avatar">
                            <img
                                @if(auth()->event()->profile->image == null)
                                    src="{{ asset('assets/images/profile.jpg') }}"
                                    alt="{{ auth()->event()->name ?? "" }}"
                                @else
                                    src="{{ asset('storage/'.auth()->event()->profile->image) }}"
                                    alt="{{ auth()->event()->name ?? "" }}"
                                @endif
                            >
                        </div>
                        <div class="event-profile-name">
                            <a href="{{ route('event.home.index') }}">
                                <h2>{{ auth()->event()->name ?? "" }}  {{ auth()->event()->lastName ?? "" }}</h2>
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
                <a href="{{ route('event.home.edit', auth()->event()->key) }}" class="btn btn-primary verified-badge">
                    <i class="sl sl-icon-event-following"></i> Modifier le compte
                </a>
                <div class="boxed-widget margin-top-30 margin-bottom-50">
                    <h3>Contact</h3>
                    <ul class="listing-details-sidebar">
                        <li>
                            <i class="sl sl-icon-phone"></i> Tel 1:  {{ auth()->event()->phones ?? "" }}
                        </li>
                        <li>
                            <i class="sl sl-icon-phone"></i> Tel 2:  {{ auth()->event()->profile->alternativePhones ?? "" }}
                        </li>
                        <li>
                            <i class="fa fa-envelope-o"></i>
                            Email: <a href="{{ auth()->event()->email ?? "" }}">{{ auth()->event()->email ?? "" }}</a>
                        </li>
                        <li>
                            <i class="fa fa-times"></i>
                            Country: {{ auth()->event()->profile->country ?? "" }}
                        </li>
                        <li>
                            <i class="fa fa-times"></i>
                            City: {{ auth()->event()->profile->city ?? "" }}
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
                <h3 class="margin-top-0 margin-bottom-40">{{ auth()->event()->name ?? "" }}'s events</h3>
                <div class="row">
                    @foreach($invoices as $invoice)
                        <div class="col-lg-12 col-md-12">
                            <div class="listing-item-container list-layout">
                                <a href="{{ route('event.home.show', $invoice->key) }}" class="listing-item">
                                    <div class="listing-item-image">
                                        <img src="{{ asset('storage/'.$invoice->event->image) }}" alt="{{ $invoice->event->title }}">
                                        <span class="tag">{{ $invoice->event->category->name }}</span>
                                    </div>
                                    <div class="listing-item-content">
                                        @if($invoice->event->status == \App\Enums\StatusEnum::POSTPONE)
                                            <div class="listing-badge now-open">Event reporter</div>
                                        @endif
                                        <div class="listing-item-inner">
                                            <h3>{{ $invoice->event->title ?? "" }}</h3>
                                            <span>{{ $invoice->event->address ?? "" }}, {{ $invoice->event->address ?? "" }}</span>
                                        </div>
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
