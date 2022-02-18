@extends('layouts.organiser')

@section('title', "Information sur le paiement")

@section('content')
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Payment Customers</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <div class="booking-requests-filter">
                    <div class="sort-by">
                        <div class="sort-by-select">
                            <select data-placeholder="Default order" class="chosen-select-no-single">
                                <option>All Listings</option>
                                <option>Burger House</option>
                                <option>Tom's Restaurant</option>
                                <option>Hotel Govendor</option>
                            </select>
                        </div>
                    </div>
                </div>

                <h4>Booking Requests</h4>
                <ul>
                    @foreach($bookings as $booking)
                        <li class="pending-booking">
                            <div class="list-box-listing bookings">
                                <div class="list-box-listing-img">
                                    <img src="" alt="">
                                </div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3>
                                            {{ strtoupper($booking->event->title) ?? "" }}
                                            @if($booking->status == "unpaid")
                                                <span class="booking-status unpaid">{{ $booking->status ?? "" }}</span>
                                            @endif
                                            @if($booking->status == "paid")
                                                <span class="booking-status paid">{{ $booking->status ?? ""}}</span>
                                            @endif
                                        </h3>

                                        <div class="inner-booking-list">
                                            <h5>Event Date:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{ $booking->event->date ?? "" }} - {{ $booking->event->startTime ?? "" }} to {{ $booking->event->endTime ?? "" }}</li>
                                            </ul>
                                        </div>

                                        <div class="inner-booking-list">
                                            <h5>Reference booking:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{ $booking->reference ?? "" }}</li>
                                            </ul>
                                        </div>

                                        <div class="inner-booking-list">
                                            <h5>Ticket Number:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{ $booking->ticketNumber ?? 0 }}</li>
                                            </ul>
                                        </div>

                                        <div class="inner-booking-list">
                                            <h5>Price:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{ $booking->totalAmount ?? 0 }}</li>
                                            </ul>
                                        </div>

                                        <div class="inner-booking-list">
                                            <h5>Client:</h5>
                                            <ul class="booking-list">
                                                <li>{{ $booking->username ?? "" }} {{ $booking->surName ?? "" }}</li>
                                                <li>{{ $booking->email ?? "" }}</li>
                                                <li>{{ $booking->phones ?? "" }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a href="{{ route('organiser.bookings.show', $booking->key) }}" class="button gray approve"><i class="sl sl-icon-eye"></i> View</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
