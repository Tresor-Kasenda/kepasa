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
                <h3 class="margin-top-0 margin-bottom-30">Personal Details</h3>
                <form action="{{ route('user.booking.confirmation') }}" method="post">
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
                        <div class="row">
                            <div class="col-md-6">
                                <label>Event City</label>
                                <input type="text" required readonly name="city" id="city" value="{{ $event->city ?? "" }}">
                            </div>
                            <div class="col-md-6">
                                <label>Event Country</label>
                                <input type="text" required readonly name="country" id="country"  value="{{ $event->country ?? "" }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Event Date</label>
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
                                <label for="password1">
                                    <span style="font-weight: 700;">Price Per Ticket</span>
                                    <h2>${{ $event->prices ?? "" }}</h2>
                                </label>
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="password1"><span style="font-weight: 700;">Total Amount</span>
                            <h2 class="form-control" name="amount" id="answer"></h2>
                            </p>
                        </div>
                    </div>
                    <h3 class="margin-top-55 margin-bottom-30">Payment Method</h3>
                    <div class="payment">
                        <div class="payment-tab payment-tab-active">
                            <div class="payment-tab-trigger">
                                <input checked id="paypal" name="cardType" type="radio" value="paypal">
                                <label for="paypal">PayPal</label>
                                <img class="payment-logo paypal" src="{{ asset('images/paypal.png') }}" alt="">
                            </div>

                            <div class="payment-tab-content">
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>

                        <div class="payment-tab">
                            <div class="payment-tab-trigger">
                                <input type="radio" name="cardType" id="creditCart" value="creditCard">
                                <label for="creditCart">DPO</label>
                                <img class="payment-logo" src="{{ asset('images/dpo.png') }}" alt="">
                            </div>

                            <div class="payment-tab-content">
                                <div class="row">
                                    <button style="box-shadow: none; border: none;">
                                        <div class="payment_icon">
                                            <img src="{{ asset('images/dpo.png') }}" class="dpo">
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-md-4 margin-top-0 margin-bottom-60">
                <div class="listing-item-container compact order-summary-widget">
                    <div class="listing-item">
                        <img src="{{ asset('storage/'.$event->image) }}" alt="">

                        <div class="listing-item-content">
                            <div class="numerical-rating" data-rating="5.0"></div>
                            <h3>{{ strtoupper($event->title) ?? "" }}</h3>
                            <span>{{ $event->address ?? "" }}, {{ $event->city ?? "" }}</span>
                        </div>
                    </div>
                </div>
                <div class="boxed-widget opening-hours summary margin-top-0">
                    <h3><i class="fa fa-calendar-check-o"></i> Booking Summary</h3>
                    <ul>
                        <li>Date <span>{{ $event->date ?? "" }}</span></li>
                        <li>Hour <span>{{ $event->startTime ?? "" }}-{{ $event->endTime ?? "" }}</span></li>
                        <li>Prices <span>${{ $event->prices ?? "" }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id=test&locale=en_US" data-namespace="paypal_sdk"></script>
    <script>
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'gold',
                layout: 'horizontal',
                label: 'pay',
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: { value: '{{ $event->ticketNumber }}' },
                        'event': "{{ $event }}",
                        'user_id' : "{{ auth()->user()->id ?? 0 }}",
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    if(details.status === 'COMPLETED'){
                        window.location = "{{ route('organiser.checkout.confirmed', ['companyRed' => $event->key ]) }}&verify="+ details.status;
                    }
                });
            }
        }).render('#paypal-button-container');
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
