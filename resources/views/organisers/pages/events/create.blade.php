<x-organiser-layout>
    @section('title', "Add Event")

    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Create events</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('organiser.index') }}">Home</a></li>
                        <li><a href="{{ route('organiser.events-list') }}">Events</a></li>
                        <li>Create</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row" id="message">
        @include('organisers.partials._flash')
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div id="add-listing">
                <form action="{{ route('organiser.event.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="add-listing-section">
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i>Event Information</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-6">
                                <h5>Event Title <span>(required)</span></h5>
                                <input
                                    type="text"
                                    name="title"
                                    class="input-text"
                                    id="title"
                                    value="{{ old('title') }}"
                                >
                                @error('title')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6">
                                <h5>Event Category<span>(required)</span></h5>
                                <select class="chosen-select-no-single" name="category" id="category" required>
                                    <option label="blank">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name ?? "" }}</option>
                                    @endforeach
                                </select>
                                @error('category')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-6">
                                <h5>Event Date <span>(required)</span></h5>
                                <input
                                    type="date"
                                    id="event_date"
                                    name="event_date"
                                    value="{{ old('event_date') }}"
                                    >
                                @error('event_date')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6">
                                <h5>Start Date <span>(required)</span></h5>
                                <input
                                    type="datetime-local"
                                    id="start_date"
                                    name="start_date"
                                    value="{{ old('start_date') }}"
                                >
                                @error('start_date')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6">
                                <h5> End Date <span>(required)</span></h5>
                                <input
                                    type="datetime-local"
                                    name="end_date"
                                    id="end_date"
                                    value="{{ old('end_date') }}"
                                >
                                @error('end_date')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6">
                                <h5>Avenue<span>(required)</span></h5>
                                <input
                                    type="text"
                                    name="address"
                                    id="address"
                                    value="{{ old('address') }}"
                                >
                                @error('address')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-4">
                                <h5>Number of Tickets:<span>(required)</span></h5>
                                <input
                                    type="number"
                                    name="ticket_number"
                                    value="{{ old('ticket_number') }}"
                                    id="ticket_number"
                                >
                                @error('ticket_number')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-4">
                                <h5>Price per Ticket<span>(required)</span></h5>
                                <input
                                    type="number"
                                    name="prices"
                                    id="prices"
                                    value="{{ old('prices') }}"
                                >
                                @error('prices')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-4">
                                <h5>Fee Options<span>(required)</span></h5>
                                <select id="selectBox" onchange="calculate();" name="fee_option" required>
                                    <option value=" ">-------</option>
                                    <option value="Inclusive">Inclusive</option>
                                    <option value="Exclusive">Exclusive</option>
                                </select>
                                @error('feedOption')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
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
                                <div class="countries col-md-12">
                                    <h5>City Event</h5>
                                    <select data-placeholder="All Cities" id="city" name="city"  class="chosen-select">
                                        <option>All cities</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id ?? "" }}">
                                                {{ $city->city_name ?? "" }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('city')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
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
                                    >{{ old('description') }}</textarea>
                                    @error('description')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </div>
                                <button type="submit" class="button margin-top-15">create event</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            function calculate() {
                let selectedValue = selectBox.options[selectBox.selectedIndex].value;
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

</x-organiser-layout>
