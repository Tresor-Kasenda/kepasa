@extends('layouts.front')

@section('title', "Processus de paiement")

@section('content')
    <div class="clearfix"></div>

    <div id="titlebar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Booking</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('home.index') }}">Home</a></li>
                            <li>Booking</li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 padding-right-30 padding-bottom-20">
                <h3 class="margin-top-0 margin-bottom-30">Event book Details</h3>
                <form action="{{ route('user.booking.confirmation', $event->key) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label>Title</label>
                            <input type="text" required name="title" id="title" readonly value="{{ $event->title ?? "" }}">
                        </div>
                        <div class="col-md-12">
                            <label>Ticket Price</label>
                            <input type="text" required name="prices" id="prices" readonly value="{{ $event->prices ?? "" }}">
                        </div>
                        <div class="col-md-12">
                            <label>Event Start Time</label>
                            <input type="time" required readonly name="startTime" id="startTime" value="{{ $event->startTime ?? "" }}">
                        </div>
                        <div class="col-md-12">
                            <label>Event Date</label>
                            <input type="date" required readonly name="date" id="date" value="{{ $event->date ?? "" }}">
                        </div>
                        <div class="col-md-12">
                            <label>Event City</label>
                            <input type="text" required readonly name="city" id="city" value="{{ $event->city ?? "" }}">
                        </div>
                        <div class="col-md-12">
                            <label>Event Country</label>
                            <input type="text" required readonly name="country" id="country"  value="{{ $event->country ?? "" }}">
                        </div>
                        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->key ?? "" }}">
                        <div class="col-md-12">
                            <label>Ticket numbers</label>
                            <select class="input-text" type="password" name="tickets" id="tickets" onchange="getValues(this)" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <p class="form-row form-row-wide">
                                <span style="font-weight: 700;">Price Per Ticket</span>
                                <h2>${{ $event->prices ?? "" }}</h2>
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="password1"><span style="font-weight: 700;">Total Amount</span>
                                <h2 class="form-control" name="amount" id="answer"></h2>
                            </p>
                        </div>
                    </div>
                    <h3 class="margin-top-55 margin-bottom-30">Payment Method</h3>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div id="paypal-button"></div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <button style="box-shadow: none; border: none;">
                                <div class="payment_icon">
                                    <img src="{{ asset('images/dpo.png') }}" class="dpo">
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-md-4 margin-top-0 margin-bottom-60">
                <a href="{{ route('event.show', $event->key) }}">
                    <div class="listing-item-container compact order-summary-widget">
                        <div class="listing-item">
                            <img src="{{ asset('storage/'.$event->image) }}" alt="">

                            <div class="listing-item-content">
                                <span class="tag">{{ strtoupper($event->category->name) ?? "" }}</span>
                                <h3>{{ $event->title ?? "" }}</h3>
                                <span>{{ $event->address ?? "" }}, {{ $event->city ?? "" }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="boxed-widget opening-hours summary margin-top-0">
                        <h3><i class="fa fa-calendar-check-o"></i> Booking Summary</h3>
                        <ul>
                            <li>Date <span>{{ $event->date ?? "" }}</span></li>
                            <li>Hour <span>{{ $event->startTime ?? "" }} at {{ $event->endTime ?? "" }}</span></li>
                            <li>Prices <span>${{ $event->prices ?? "" }}</span></li>
                        </ul>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.sandbox.client_id') }}&currency=USD"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
            style: {
                layout: 'horizontal'
            },
            // Call your server to set up the transaction
            createOrder: function(data, actions) {
                return fetch('{{ route('user.paypal.create.transaction') }}', {
                    method: 'post',
                    body: JSON.stringify({
                        "value": $('#prices').val(),
                        "tickets": $('#tickets').val(),
                        "title": $('#title').val()
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },

            // Call your server to finalize the transaction
            onApprove: function(data, actions) {
                console.log(data.orderId)
                return fetch('{{ route('user.paypal.capture.transaction') }}', {
                    method: 'post',
                    body: JSON.stringify({
                        "orderId": data.orderId
                    })
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

        }).render('#paypal-button');
    </script>
    <script>
        function getValues(number){
            let numOfTickets = number.value;
            let pricePerTicket = document.getElementById("prices").value;
            let total = numOfTickets * pricePerTicket;
            document.getElementById("answer").innerHTML="$" + total;
        }
    </script>
@endsection
