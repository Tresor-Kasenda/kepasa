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
                        <input
                            type="number"
                            name="eventName"
                            oninput="pricing()"
                            id="calcPerTicket"
                            placeholder="00">
                    </div>
                    <div class="col-md-12">
                        <label>Number of Tickets</label>
                        <input
                            type="number"
                            name="price"
                            oninput="pricing()"
                            id="calcTicketNum"
                            placeholder="00">
                    </div>
                    <div class="col-md-12">
                        <label>Total ticket price: $<span id="calcTotalTicket"></span></label>
                        <label>Our fee (10%): $<span id="calcBookingFee"></span></label>
                        <div id="display" style="display: none; margin-bottom: 10rem !important;">
                            <hr>
                            <h3 class="title text-center margin-top-8"> Payout to Event Organiser</h3>
                            <h4 class="title margin-top-3 text-center "style="color: #f91942 !important; font-weight: 600">Option 1: Ticket price includes our Event Fee.</h4>
                            <div class="row text-center">
                                <div class="col-md-6 form-group">
                                    <label class="text-uppercase font-weight-bold"> Customer pays: </label>
                                    <h5 style="font-weight: 600">$<span id="calcTotalPaid"></span></h5>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="text-uppercase font-weight-bold">Total due to you: </label>
                                    <h5 style="font-weight: 600">$<span id="calcTotalDue"></span></h5>
                                </div>
                                <h4 class="title text-center"style="color: #f91942 !important; margin-top: 7rem !important; font-weight: 600">
                                    Option 2: Ticket price excludes our Event Fee.
                                </h4>
                                <div class="col-md-6 form-group">
                                    <label class="text-uppercase font-weight-bold"> Customer pays:</label>
                                    <h5 style="font-weight: 600">$<span id="calcAbsTotalPaid"></span></h5>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="text-uppercase font-weight-bold font-weight-bolder"> Total due to you:</label>
                                    <h5 style="font-weight: 600">$<span id="calcAbsTotalDue"></span></h5>
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

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#calcPerTicket").keyup(function () {
                var x = document.getElementById('display');
                if ($(this).val() === "") {
                    x.style.display = 'none';
                } else {
                    x.style.display = 'block';
                }
            });
        });

        function pricing() {
            let ticketPrice = document.getElementById("calcPerTicket").value;
            let numberTickets = document.getElementById("calcTicketNum").value;
            let bookingFee = numberTickets;
            let total = ticketPrice * numberTickets;
            if (numberTickets != null) {
                document.getElementById("calcTotalTicket").innerHTML = total;
                document.getElementById("calcBookingFee").innerHTML = bookingFee;
                feePaid(ticketPrice, numberTickets);
            } else {
                document.getElementById("calcTotalTicket").innerHTML = ticketPrice;
                document.getElementById("calcBookingFee").innerHTML = bookingFee * numberTickets;
                feePaid(ticketPrice, numberTickets);
            }
        }

        function feePaid(ticketPrice, numberTickets) {
            let commision = ticketPrice * 5 / 100;
            document.getElementById("calcTotalPaid").innerHTML = ticketPrice;
            document.getElementById("calcTotalDue").innerHTML = (ticketPrice - commision) * numberTickets;
            document.getElementById("calcAbsTotalPaid").innerHTML = parseInt(ticketPrice) + parseInt(commision);
            document.getElementById("calcAbsTotalDue").innerHTML = ticketPrice * numberTickets;
        }
    </script>
@endsection
