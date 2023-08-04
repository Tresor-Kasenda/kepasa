<x-organiser-layout>
    @section('title', "Information sur le paiement")

    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Payment confirmation</h2>
            </div>
        </div>
    </div>

    @if ($exception instanceof \App\Exceptions\CustomerException)
        <div class="alert alert-danger">
            <p>{{ $exception->getMessage() }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div id="add-listing">
                <div class="add-listing-section margin-bottom-20">
                    <div class="add-listing-headline">
                        <h3><i class="sl sl-icon-doc"></i> Confirm your details below</h3>
                    </div>
                    <div class="row with-forms">
                        <form action="{{ route('organiser.event.confirm', $event->id) }}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <h5>Category</h5>
                                <input  type="text" id="name" name="name" value="{{ $event->category->name ?? "" }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <h5>Event Name</h5>
                                <input type="text" id="title" readonly required value="{{ $event->title ?? "" }}" name="title">
                            </div>
                            <div class="col-md-6">
                                <h5>Event Date</h5>
                                <input type="date" readonly required value="{{ $event->event_date ?? "" }}" name="date">
                            </div>
                            <div class="col-md-6">
                                <h5>Start Time</h5>
                                <input type="time" name="startTime" value="{{ $event->start_date ?? "" }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <h5>End Time </h5>
                                <input type="time" name="endTime" value="{{ $event->end_date ?? "" }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <h5>Ticket Price</h5>
                                <input type="number" name="prices" id="prices" value="{{ $event->prices ?? "" }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <h5>Event Venue</h5>
                                <input type="text" name="address" value="{{ $event->address ?? "" }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <h5>Number Of Tickets</h5>
                                <input type="number" name="numberOfTickets" id="numberOfTickets" value="{{ $event->ticket_number ?? "" }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <h5>Your Email</h5>
                                <input type="email" name="email" value="{{ auth()->user()->email ?? "" }}" required readonly >
                            </div>
                            <div class="col-md-12">
                                <h6 style="color: #F96; font-size: 25px; font-weight: 400;">Payment Options</h6>
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

    @section('scripts')
        {{--        <script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.sandbox.client_id') }}&currency=USD"></script>--}}

        {{--        <script>--}}
        {{--            paypal.Buttons({--}}
        {{--                style: {--}}
        {{--                    layout: 'horizontal'--}}
        {{--                },--}}
        {{--                createOrder: function(data, actions) {--}}
        {{--                    return fetch(``, {--}}
        {{--                        method: "POST",--}}
        {{--                        body: JSON.stringify({--}}
        {{--                            title: $('#title').val(),--}}
        {{--                            prices: $('#prices').val(),--}}
        {{--                        }),--}}
        {{--                        headers: {--}}
        {{--                            "Content-type": "application/json",--}}
        {{--                            "X-CSRF-Token": $('input[name="_token"]').val()--}}
        {{--                        }--}}
        {{--                    }).then(function(res) {--}}
        {{--                        return res.json();--}}
        {{--                    }).then(function(orderData) {--}}
        {{--                        return orderData.id;--}}
        {{--                    });--}}
        {{--                },--}}

        {{--                // Call your server to finalize the transaction--}}
        {{--                onApprove: function(data, actions) {--}}
        {{--                    return fetch('{{ route('organiser.paypal.capture') }}', {--}}
        {{--                        method: 'post',--}}
        {{--                        body: JSON.stringify({--}}
        {{--                            orderId : data['orderID'],--}}
        {{--                            title: $('#title').val(),--}}
        {{--                            prices: $('#prices').val(),--}}
        {{--                        }),--}}
        {{--                        headers: {--}}
        {{--                            "Content-type": "application/json",--}}
        {{--                            "X-CSRF-Token": $('input[name="_token"]').val()--}}
        {{--                        }--}}
        {{--                    }).then(function(res) {--}}
        {{--                        return res.json();--}}
        {{--                    }).then(function(orderData) {--}}
        {{--                        var errorDetail = Array.isArray(orderData.details) && orderData.details[0];--}}
        {{--                        if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {--}}
        {{--                            return actions.restart(); // Recoverable state, per:--}}
        {{--                        }--}}
        {{--                        if (errorDetail) {--}}
        {{--                            var msg = 'Sorry, your transaction could not be processed.';--}}
        {{--                            if (errorDetail.description) msg += '\n\n' + errorDetail.description;--}}
        {{--                            if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';--}}
        {{--                            return alert(msg);--}}
        {{--                        }--}}
        {{--                        window.history.back();--}}
        {{--                    });--}}
        {{--                }--}}

        {{--            }).render('#paypal-button');--}}
        {{--        </script>--}}
    @endsection
</x-organiser-layout>
