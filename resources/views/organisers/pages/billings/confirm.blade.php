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
                                <input  type="text" name="name" value="{{ $event->category->name ?? "" }}" readonly required>
                            </div>
                            <input type="hidden" name="nameOrganiser" value="{{ $event->user->name ?? "" }}">
                            <input type="hidden" name="lastNameOrganiser" value="{{ $event->user->lastName ?? "" }}">
                            <div class="col-md-6">
                                <h5>Event Name</h5>
                                <input type="text" readonly required value="{{ $event->title ?? "" }}" name="title">
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
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}&locale=en_US"></script>
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
                        'user_id' : "{{ auth()->user()->id }}",
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
@endsection
