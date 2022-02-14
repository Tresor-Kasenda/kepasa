@extends('layouts.organiser')

@section('title', "Information sur le paiement")

@section('content')
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Payment confirmation</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div id="add-listing">
                <div class="add-listing-section margin-bottom-20">
                    <div class="add-listing-headline">
                        <h3><i class="sl sl-icon-doc"></i> Confirm your details below</h3>
                    </div>
                    <div class="row with-forms">
                        <form action="" method="POST">
                            <div class="col-md-6">
                                <h5>Category</h5>
                                <input  type="text" value="{{ $event->category->name ?? "" }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <h5>Event Name</h5>
                                <input type="text" readonly required value="{{ $event->title ?? "" }}" name="eventName">
                            </div>
                            <div class="col-md-6">
                                <h5>Subtitle</h5>
                                <input type="text" value="{{ $event->subTitle ?? "" }}" name="subtitle">
                            </div>
                            <div class="col-md-6">
                                <h5>Event Date
                                </h5>
                                <input type="date" readonly required value="{{ $event->date ?? "" }}" name="eventDate">
                            </div>
                            <div class="col-md-6">
                                <h5>Start Time</h5>
                                <input type="time" name="startTime" value="{{ $event->startTime ?? "" }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <h5>End Time </h5>
                                <input type="time" name="endTime" value="{{ $event->endTime ?? "" }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <h5>Ticket Price</h5>
                                <input type="number" name="price" value="{{ $event->prices ?? "" }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <h5>Event Venue</h5>
                                <input type="text" name="venueName" value="{{ $event->address ?? "" }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <h5>Number Of Tickets</h5>
                                <input type="number" name="numberOfTickets" value="{{ $event->ticketNumber ?? "" }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <h5>Your Email</h5>
                                <input type="email" name="email" value="{{ auth()->user()->email ?? "" }}" required readonly >
                            </div>
                            <h6 style="color: #F96; font-size: 25px; font-weight: 400;">Payment Options</h6>
                            <div class="col-md-6">
                                <div id="paypal-button-container"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="payment_icon">
                                    <div class="primary" style=" margin-top: 1.5rem;">
                                        <button style="box-shadow: none; border: none;">
                                            <div class="payment_icon">
                                                <img src="{{ asset('images/dpo.png') }}" class="dpo">
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
    <script>
        let client_id = {{config('paypal.sandbox.client_id')}}
        paypal.Buttons({
            style: {
                layout:  'vertical',
                color:   'blue',
                shape:   'pill',
                label:   'paypal'
            },
            createOrder: function(data, actions) {
                return fetch('', {
                    method: 'POST',
                    body:JSON.stringify({
                        'course_id': "",
                        'user_id' : "{{auth()->id()}}",
                        'amount' : '',
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },

            onApprove: function(data, actions) {
                return fetch('' , {
                    method: 'POST',
                    body :JSON.stringify({
                        orderId : data.orderID,
                        payment_gateway_id: $("#payapalId").val(),
                        user_id: "{{ auth()->user()->id }}",
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    iziToast.success({
                        title: 'Success',
                        message: 'Payment completed',
                        position: 'topRight'
                    });
                });
            }
        }).render('#paypal-button-container');
    </script>

    <script>
        if ( window.history.replaceState) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
@endsection