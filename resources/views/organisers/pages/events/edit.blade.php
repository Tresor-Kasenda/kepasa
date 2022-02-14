@extends('layouts.organiser')

@section('title', "Creation d'un evenement")

@section('content')
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Edit events / <span class="text-teal-dim">{{ $event->title ?? "" }}</span></h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('organiser.events.index') }}">Back to events</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div id="add-listing">
                <form action="{{ route('organiser.events.update', $event->key) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="add-listing-section">
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i>Event Information</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-4">
                                <h5>Event Title <span>(required)</span></h5>
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    value="{{ old('title') ?? $event->title }}"
                                    >
                            </div>
                            <div class="col-md-4">
                                <h5>Event Subtitle <span>(required)</span></h5>
                                <input
                                    type="text"
                                    name="subTitle"
                                    id="subTitle"
                                    value="{{ old('subTitle') ?? $event->subTitle }}"
                                    >
                            </div>
                            <div class="col-md-4">
                                <h5>Event Category<span>(required)</span></h5>
                                <select class="chosen-select-no-single" name="category_id" required>
                                    <option value="{{ $event->category->name }}">{{ $event->category->name }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name ?? "" }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-3">
                                <h5>Event Date <span>(required)</span></h5>
                                <input
                                    type="date"
                                    id="date"
                                    name="date"
                                    value="{{ old('date') ?? $event->date }}"
                                    min="{{ now()->format('Y:m:d') }}">
                            </div>
                            <div class="col-md-3">
                                <h5>Start Time <span>(required)</span></h5>
                                <input
                                    type="time"
                                    id="startTime"
                                    name="startTime"
                                    value="{{ old('startTime') ?? $event->startTime }}"
                                    >
                            </div>
                            <div class="col-md-3">
                                <h5> End Time <span>(required)</span></h5>
                                <input
                                    type="time"
                                    name="endTime"
                                    id="endTime"
                                    value="{{ old('endTime') ?? $event->endTime }}"
                                    >
                            </div>
                            <div class="col-md-3">
                                <h5>Avenue<span>(required)</span></h5>
                                <input
                                    type="text"
                                    name="address"
                                    id="address"
                                    value="{{ old('address') ?? $event->address }}"
                                    >
                            </div>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-4">
                                <h5>Number of Tickets:<span>(required)</span></h5>
                                <input
                                    type="number"
                                    name="ticketNumber"
                                    value="{{ old('ticketNumber') ?? $event->ticketNumber }}"
                                    id="ticketNumber"
                                    >
                            </div>
                            <div class="col-md-4">
                                <h5>Price per Ticket<span>(required)</span></h5>
                                <input
                                    type="number"
                                    name="prices"
                                    id="prices"
                                    value="{{ old('prices') ?? $event->prices }}"
                                    >
                            </div>

                            <div class="col-md-4">
                                <h5>Fee Options<span>(required)</span></h5>
                                <select id="selectBox" onchange="calculate();" name="feeOption" required>
                                    <option value="{{ $event->feeOption }}">{{ $event->feeOption }}</option>
                                    <option value="Inclusive">Inclusive</option>
                                    <option value="Exclusive">Exclusive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-3">
                                <h5>Ticket Fee<span></span></h5>
                                <p name="price" id='ticketFee'></p>
                            </div>
                            <div class="col-md-3">
                                <h5>Our Commission<span></span></h5>
                                <p name="pricePerTicket" id='ticketCommission'></p>
                            </div>

                            <div class="col-md-3">
                                <h5>Buyer Price<span></span></h5>
                                <p name="pricePerTicket" id='ticketPrice'></p>
                            </div>

                            <div class="col-md-3">
                                <h5>Organiser Amount<span></span></h5>
                                <p name="price" id='answer'></p>
                            </div>
                        </div>
                    </div>
                    <div class="add-listing-section margin-top-45">
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-location"></i> Location</h3>
                        </div>
                        <div class="submit-section">
                            <div class="row with-forms">
                                <div class="countries col-md-6">
                                    <h5>Country</h5>
                                    <select class="countries" id="country" name="country">
                                        <option value="{{ $event->country }}">{{ $event->country }}</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->countryCode }}">
                                                {{ $country->countryName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h5>City</h5>
                                    <select name="cityName" id="cityName" class="chosen-select">
                                        <span id="response"></span>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="add-listing-section margin-top-45 margin-bottom-20">
                        <div class="submit-section">
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-pencil"></i> Event Description</h3>
                            </div>
                            <div class="row with-forms">
                                <div class="col-sm-12">
                                    <textarea
                                        class="WYSIWYG"
                                        name="description"
                                        rows="3"
                                        id="description"
                                        spellcheck="true"
                                    >{{ old('description') ?? $event->description }}</textarea>
                                </div>
                                <button type="submit" class="button margin-top-15">Update event</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script defer>
        $(document).ready(function () {
            $(".countries").change(function () {
                var selectedCountry = $(".countries option:selected").val();
                $('select#cityName').hide()
                $.ajax({
                    type: "POST",
                    url: "{{ route('cities.listens') }}",
                    data: {
                        countries: selectedCountry,
                        _token: '{{csrf_token()}}'
                    }
                }).done(function (response) {
                    if (response){
                        $('select#cityName').show()
                        $('#cityName').html('<option>Select City</option>')
                        $.each(response.cities,function(key,value){
                            $('#cityName').append('<option value=" ' + value.id + '">' + value.cityName + '</option>');
                        });
                    }
                });
            });
        });
    </script>
    <script>
        function calculate() {
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            let price = document.getElementById("prices").value
            if (price !== 0) {
                if (selectedValue === "Inclusive") {
                    inclusive();
                } else if (selectedValue === "Exclusive") {
                    exclusive();
                }
            } else {
                free();
            }
        }

        function inclusive() {
            let price = document.getElementById("prices").value;
            let deduct = (5 / 100) * price;
            let organiserPrice = parseFloat(price) - deduct;
            document.getElementById("answer").innerHTML = "Organiser amount : R" + organiserPrice;
            document.getElementById("ticketFee").innerHTML = "Ticket Fee: R 1 ";
            document.getElementById("ticketCommission").innerHTML = deduct;
            document.getElementById("ticketPrice").innerHTML = price;
        }

        function exclusive() {
            let price = document.getElementById("prices").value;
            let add = (5 / 100) * price;
            let ticketPrice = parseFloat(price) + add;
            document.getElementById("answer").innerHTML = "Organiser Amount: R " + parseInt(price);
            document.getElementById("ticketFee").innerHTML = "Ticket Fee: R 1 ";
            document.getElementById("ticketCommission").innerHTML = "Ticket Commision: R " + add;
            document.getElementById("ticketPrice").innerHTML = "Buyers' Price: R " + ticketPrice;
        }

        function free() {
            document.getElementById("ticketFee").innerHTML = "Ticket Fee  R1";
            document.getElementById("ticketCommission").innerHTML = " ";
            document.getElementById("ticketPrice").innerHTML = " ";
            document.getElementById("answer").innerHTML = " ";
        }
    </script>
@endsection
