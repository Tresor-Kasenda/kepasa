@extends('layouts.organiser')

@section('title', "Détail sur l'evenement")

@section('content')
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Listens events / <span class="text-teal-dim">{{ $event->title ?? "" }}</span></h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('organiser.events.index') }}">Back to events</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="container">
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <div class="listing-slider mfp-gallery-container margin-bottom-0">
                        <a
                            href="{{ asset('storage/'.$event->image) }}"
                            data-background-image="{{ asset('storage/'.$event->image) }}"
                            class="item mfp-gallery"
                        ></a>
                        @if($event->media)
                            @foreach($event->media as $images)
                                <a
                                    href="{{ asset('storage/'.$images->image) }}"
                                    data-background-image="{{ asset('storage/'.$images->image) }}"
                                    class="item" title="{{ $images->key ?? "" }}"
                                ></a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="margin-top-45">
                    <div id="titlebar" class="listing-titlebar">
                        <div class="listing-titlebar-title">
                            <h2>
                                {{ strtoupper( $event->title) ?? ""  }}
                                <span class="listing-tag">Category: {{ $event->category->name ?? "" }}</span>
                                <span class="listing-tag border-primary">Status: {{ $event->status ?? "" }}</span>
                                <span class="listing-tag border-primary">Payment: {{ $event->payment ?? "" }}</span>
                            </h2>
                            <span>
                            <a href="#" class="listing-address">
                                <i class="fa fa-map-marker"></i>
                                {{ $event->address ?? "" }}, {{ $event->city ?? "" }}, {{ $event->country ?? "" }}
                            </a>
                        </span>
                            <div class="listing-links-container">
                                <ul class="listing-links contact-links">
                                    <li>
                                        <a href="#" class="listing-links">
                                            <i class="fa fa-hourglass"></i> Date: {{ $event->date ?? now()->format('Y:m:d') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="listing-links">
                                            <i class="fa fa-envelope-o"></i> start Time: {{ $event->startTime ?? "" }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank"  class="listing-links">
                                            <i class="fa fa-link"></i> end Time : {{ $event->endTime ?? "" }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div id="listing-overview" class="listing-section">
                        <p>
                            {{ $event->description ?? "" }}
                        </p>
                    </div>
                    <div id="listing-reviews" class="listing-section">
                        <div class="rating-overview">
                            <div class="rating-overview-box"></div>

                            <div class="rating-bars">
                                <div class="rating-bars-item">
                                <span class="rating-bars-name">
                                    Ticket Number
                                    <strong>{{ $event->ticketNumber ?? "" }}</strong>
                                </span>
                                </div>
                                <div class="rating-bars-item">
                                <span class="rating-bars-name">
                                    Prices
                                    <strong>{{ $event->prices ?? 0 }} $</strong>
                                </span>
                                </div>
                                <div class="rating-bars-item">
                                <span class="rating-bars-name">
                                    Commission
                                    <strong>{{ $event->commission ?? 0 }} %</strong>
                                </span>
                                </div>
                                <div class="rating-bars-item">
                                <span class="rating-bars-name">
                                    Buyer Prices
                                    <strong>{{ $event->buyerPrice ?? 0 }} %</strong>
                                </span>
                                </div>

                                <div class="rating-bars-item">
                                <span class="rating-bars-name">
                                    Status
                                    <strong>{{ $event->status ?? "" }}</strong>
                                </span>
                                </div>
                                <div class="rating-bars-item">
                                <span class="rating-bars-name">
                                    Type
                                    <strong>{{ $event->types ?? "" }}</strong>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
