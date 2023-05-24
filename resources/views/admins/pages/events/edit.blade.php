<x-app-layout>
    @section('title', "Liste des evenements")

    @section('content')
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Evenement / {{ $event->title }}</h3>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-preview">
                            <div class="card-inner">
                                <form action="{{ route('supper.viewEvents.update', $event->key) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="title">title</label>
                                                <div class="form-control-wrap">
                                                    <input
                                                        type="text"
                                                        class="form-control @error('title') error @enderror"
                                                        id="title"
                                                        value="{{ old('title') ?? $event->title }}"
                                                        name="title"
                                                        placeholder="title"
                                                    >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="subTitle">subTitle</label>
                                                <div class="form-control-wrap">
                                                    <input
                                                        type="text"
                                                        class="form-control @error('subTitle') error @enderror"
                                                        id="subTitle"
                                                        value="{{ old('subTitle') ?? $event->subTitle }}"
                                                        name="subTitle"
                                                        placeholder="subTitle"
                                                    >
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="ticketNumber">ticketNumber</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="number"
                                                                class="form-control @error('ticketNumber') error @enderror"
                                                                id="ticketNumber"
                                                                value="{{ old('ticketNumber') ?? $event->ticketNumber }}"
                                                                name="ticketNumber"
                                                                placeholder="ticketNumber"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="subTitle">prices</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="number"
                                                                class="form-control @error('prices') error @enderror"
                                                                id="prices"
                                                                value="{{ old('prices') ?? $event->prices }}"
                                                                name="prices"
                                                                placeholder="prices"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label class="form-label" for="subTitle">address</label>
                                                <div class="form-control-wrap">
                                                    <input
                                                        type="text"
                                                        class="form-control @error('address') error @enderror"
                                                        id="address"
                                                        value="{{ old('address') ?? $event->address }}"
                                                        name="address"
                                                        placeholder="address"
                                                    >
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label class="form-label" for="country">address</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control" class="countries" id="country" name="country">
                                                        <option value="{{ $event->country }}">{{ $event->country }}</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->countryCode }}">
                                                                {{ old('country') ?? $country->countryName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="category_id">Category</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-control-select">
                                                        <select class="form-control" name="category_id" id="category_id">
                                                            <option value="{{ $event->category->name }}">{{ $event->category->name }}</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name ?? "" }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="date">date</label>
                                                <div class="form-control-wrap">
                                                    <input
                                                        type="date"
                                                        class="form-control @error('date') error @enderror"
                                                        id="date"
                                                        value="{{ old('date') ?? $event->date }}"
                                                        name="date"
                                                        placeholder="date"
                                                    >
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="startTime">startTime</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="time"
                                                                class="form-control @error('startTime') error @enderror"
                                                                id="startTime"
                                                                value="{{ old('startTime') ?? $event->startTime }}"
                                                                name="startTime"
                                                                placeholder="startTime"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="endTime">endTime</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                type="time"
                                                                class="form-control @error('endTime') error @enderror"
                                                                id="endTime"
                                                                value="{{ old('endTime') ?? $event->endTime }}"
                                                                name="endTime"
                                                                placeholder="endTime"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label class="form-label" for="selectBox">feeOption</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-control-select">
                                                        <select class="form-control" id="selectBox" onchange="calculate();" name="feeOption" required>
                                                            <option value="{{ $event->feeOption }}">{{ $event->feeOption }}</option>
                                                            <option value="Inclusive">Inclusive</option>
                                                            <option value="Exclusive">Exclusive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label class="form-label" for="selectBox">City</label>
                                                <div class="viewRender"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3 text-center">
                                            <h6>Ticket Fee<span></span></h6>
                                            <p name="price" id='ticketFee'></p>
                                        </div>
                                        <div class="col-md-3 mt-3 text-center">
                                            <h6>Our Commission<span></span></h6>
                                            <p name="pricePerTicket" id='ticketCommission'></p>
                                        </div>

                                        <div class="col-md-3 mt-3 text-center">
                                            <h6>Buyer Price<span></span></h6>
                                            <p name="pricePerTicket" id='ticketPrice'></p>
                                        </div>

                                        <div class="col-md-3 mt-3 text-center">
                                            <h6>Organiser Amount<span></span></h6>
                                            <p name="price" id='answer'></p>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label class="form-label" for="description">description</label>
                                                <div class="form-control-wrap">
                                                <textarea
                                                    class="form-control form-control-sm"
                                                    id="description"
                                                    name="description"
                                                >{{ old('description') ?? $event->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary btn-action">
                                            Sauvegarder
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script defer>
            $(document).ready(function () {
                $("#country").change(function () {
                    const country = $("#country option:selected").val()
                    $.ajax({
                        type: "post",
                        url: `{{ route('cities.listens') }}`,
                        data: {
                            country: country,
                            _token: '{{csrf_token()}}'
                        },
                        dataType : 'json',
                        success: function(response){
                            if (response){
                                $('.viewRender').html(response.views);
                            }
                        }
                    })
                })
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
</x-app-layout>
