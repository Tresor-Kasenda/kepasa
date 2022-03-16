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
                        <form action="{{ route('organiser.confirm.payment.event') }}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <h5>Category</h5>
                                <input  type="text" id="name" name="name" value="{{ $event->category->name ?? "" }}" readonly required>
                            </div>
                            <input type="hidden" name="nameOrganiser" value="{{ $event->user->name ?? "" }}">
                            <input type="hidden" id="lastNameOrganiser" name="lastNameOrganiser" value="{{ $event->user->lastName ?? "" }}">
                            <div class="col-md-6">
                                <h5>Event Name</h5>
                                <input type="text" id="title" readonly required value="{{ $event->title ?? "" }}" name="title">
                            </div>
                            <div class="col-md-6">
                                <h5>Subtitle</h5>
                                <input type="text" value="{{ $event->subTitle ?? "" }}" name="subTitle">
                            </div>
                            <div class="col-md-6">
                                <h5>Event Date</h5>
                                <input type="date" readonly required value="{{ $event->date ?? "" }}" name="date">
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
                                <input type="number" name="prices" value="{{ $event->prices ?? "" }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <h5>Event Venue</h5>
                                <input type="text" name="address" value="{{ $event->address ?? "" }}" readonly required>
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
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.sandbox.client_id') }}&currency=USD"></script>
    <script>
        let content = {
            'title': $('#title').val(),
            'lastNameOrganiser': $('#lastNameOrganiser').val(),
            'name': $('#name').val()
        };
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'gold',
                layout: 'horizontal',
                label: 'pay',
            },
            createOrder: function(data, actions) {
                return fetch(`{{ route('organiser.paypal.execute') }}`, {
                    method: 'post',
                    headers: {
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    body: content
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },

            // Call your server to finalize the transaction
            onApprove: function(data, actions) {
                return fetch('/demo/checkout/api/paypal/order/' + data.orderID + '/capture/', {
                    method: 'post'
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    // Three cases to handle:
                    //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                    //   (2) Other non-recoverable errors -> Show a failure message
                    //   (3) Successful transaction -> Show confirmation or thank you

                    // This example reads a v2/checkout/orders capture response, propagated from the server
                    // You could use a different API or structure for your 'orderData'
                    var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                    if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                        return actions.restart(); // Recoverable state, per:
                        // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                    }

                    if (errorDetail) {
                        var msg = 'Sorry, your transaction could not be processed.';
                        if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                        if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                        return alert(msg); // Show a failure message (try to avoid alerts in production environments)
                    }

                    // Successful capture! For demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    // Replace the above to show a success message within this page, e.g.
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
