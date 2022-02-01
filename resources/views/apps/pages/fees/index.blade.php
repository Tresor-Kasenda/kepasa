@extends('layouts.front')

@section('title', "Frais de création d'un événement")

@section('content')
    <div class="clearfix"></div>

    <div id="titlebar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Event Creation Fee</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('home.index') }}">Home</a></li>
                            <li>Event Creation Fee</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 margin-top-0 margin-bottom-60"></div>
            <div class="col-lg-8 col-md-8 padding-right-30">
                <div class="row">
                    <div class="col-md-12">
                        <label>Ticket Price</label>
                        <input type="number" name="eventName" oninput="pricing()" id="calcPerTicket" placeholder="00">
                    </div>
                    <div class="col-md-12">
                        <label>Number of Tickets</label>
                        <input  type="number" name="price" oninput="pricing()" id="calcTicketNum" placeholder="00">
                    </div>
                    <div class="col-md-12">
                        <label>Total ticket price: $<span id="calcTotalTicket"></span></label>
                        <label>Our fee (10%): $<span id="calcBookingFee"></span></label>
                        <div id="display" style="display: none;">
                            <hr>
                            <h3 class="title usmall "> Payout to Event Organiser</h3>
                            <h4 class="title usmall "style="color: #f91942 !important; font-weight: 600">Option 1: Ticket price includes our Event Fee.</h4>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label> Customer pays: </label>
                                    <h5>$<span id="calcTotalPaid"></span></h5>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Total due to you: </label>
                                    <h5>$<span id="calcTotalDue"></span></h5>
                                </div>
                                <h4 class="title usmall "style="color: #f91942 !important; margin-top: 12rem !important;">
                                    Option 2: Ticket price excludes our Event Fee.
                                </h4>
                                <div class="col-md-6 form-group">
                                    <label> Customer pays:</label>
                                    <h5>$<span id="calcAbsTotalPaid"></span></h5>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label> Total due to you:</label>
                                    <h5>$<span id="calcAbsTotalDue"></span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 margin-top-0 margin-bottom-60"></div>
        </div>
    </div>
@endsection
