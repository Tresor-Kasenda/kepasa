@php use App\Enums\StatusEnum; @endphp
@extends('layouts.front')

@section('content')
    <div class="clearfix"></div>

    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="event-profile-titlebar">
                        <div class="event-profile-avatar">
                            <img src="{{ asset('assets/images/profile.jpg') }}" class="img-circle"
                                 style="width: 10%; height: 10%; object-fit: cover">
                        </div>
                        <div class="event-profile-name">
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
                <a href="" class="btn btn-primary verified-badge">
                    <i class="sl sl-icon-event-following"></i> Modifier le compte
                </a>
                <div class="boxed-widget margin-top-30 margin-bottom-50">
                    <h3>Contact</h3>
                    <ul class="listing-details-sidebar">
                        <li>
                            <i class="sl sl-icon-phone"></i> Tel 1: {{ auth()->user()->phones ?? "" }}
                        </li>
                        <li>
                            <i class="sl sl-icon-phone"></i> Tel
                            2: {{ auth()->user()->profile->alternativePhones ?? "" }}
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
                </div>
                <div class="text-center justify-content-center">
                    <a href="{{ route('logout') }}" class="send-message-to-owner button"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                    @foreach($invoices as $invoice)
                        <div class="col-lg-12 col-md-12">
                            <div class="listing-item-container list-layout">
                                <a href="" class="listing-item">
                                    <div class="listing-item-image">
                                        <img src="{{ asset('storage/'.$invoice->event->image) }}"
                                             alt="{{ $invoice->event->title }}">
                                        <span class="tag">{{ $invoice->event->category->name }}</span>
                                    </div>
                                    <div class="listing-item-content">
                                        @if($invoice->event->status == StatusEnum::STATUS_ACTIVE)
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
