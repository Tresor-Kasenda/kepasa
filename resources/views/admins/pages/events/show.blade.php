@php use App\Enums\StatusEnum; @endphp
<x-app-layout>
    @section('title', "Detail sur l'evenement")

    <x-vex-container>
        <x-brandcrumb title="Event Details">
            <li>
                <div class="form-group dropdown">
                    <div class="form-control-wrap">
                        <select name="status" id="status" class="form-select js-select2 form-control-lg">
                            <option value="default_option">Select Status</option>
                            <option value="active">Activated</option>
                            <option value="deactivate">Deactivated</option>
                            <option value="postpone">Post Pone</option>
                        </select>
                    </div>
                </div>
            </li>
            <x-vex-link href="{{ route('supper.events.index') }}" class="btn btn-dim btn-outline-secondary">
                <x-vex-icon class="ni-arrow-long-left"/>
                <span>All events</span>
            </x-vex-link>

        </x-brandcrumb>

        @if($event->promoted == false)
            <div class="alert alert-danger alert-icon " role="alert">
                <em class="icon ni ni-alert-circle"></em>
                La promotion ne peut etre faite que si le paiemment a ete deja effectuer
            </div>
        @endif

        <x-vex-containt>
            <div class="text-center p-2">
                <div class="product-gallery me-xl-1 me-xxl-5">
                    <div class="slider-init" id="sliderFor">
                        <div class="slider-item rounded">
                            <img src="{{ asset('storage/'.$event->image) }}" class="rounded w-100 h-50" alt="{{ $event->id }}">
                        </div>
                    </div>
                </div>
            </div>
            <hr class="is-hr-sm">
            <div class="row g-3">
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event title:</span>
                    <span>{{ $event->title ?? "" }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event sub-title:</span>
                    <span>{{ $event->subTitle }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event Categories:</span>
                    <span>{{ $event->category->name ?? "" }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event country:</span>
                    <span>{{ $event->country->countryName ?? "" }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event address:</span>
                    <span>{{ $event->address ?? "" }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event Status:</span>
                    <span class="lead-text {{ $event->status === StatusEnum::ACTIVE ? "text-primary": "text-danger" }}">{{ strtoupper($event->status) ?? "" }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event Ticket buyers:</span>
                    <span>$ {{ $event->buyerPrice ?? "" }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event Payment:</span>
                    <span class="lead-text {{ $event->payment === 'unpaid' ? 'text-danger': 'text-primary' }}">{{ strtoupper($event->payment) ?? "" }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event Ticket Prices:</span>
                    <span>${{ number_format($event->prices, 2, ". ") ?? 0 }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Ticket numbers of Events:</span>
                    <span>{{ $event->ticketNumber ?? 0 }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event Date:</span>
                    <span>{{ $event->date ?? "" }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event Start time:</span>
                    <span>{{ $event->startTime ?? "" }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event End time:</span>
                    <span>{{ $event->endTime ?? "" }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event Commission:</span>
                    <span class="lead-text">% {{ $event->commission ?? "" }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <span class="sub-text">Event Promotion:</span>
                    <span class="lead-text {{ $event->promoted ? 'text-primary': 'text-secondary' }}">
                        @if($event->promoted === false)
                            <span class="profile-ud-value">Promus</span>
                        @else
                            <span class="profile-ud-value text-danger">Not Promoted</span>
                        @endif
                    </span>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-12">
                    <span class="sub-text">Event Description:</span>
                    <span>{{ $event->description ?? "" }}</span>
                </div>
            </div>

        </x-vex-containt>

    </x-vex-container>

    @section('scripts')
        <script>
            $(document).ready(function () {
                $('#status').on('change', function () {
                    const status = $("#status option:selected").val()
                    $.ajax({
                        type: "put",
                        url: `{{ route('supper.events.status',$event->id) }}`,
                        data: {
                            status: status,
                            key: `{{ $event->id }}`,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.type = 'success') {
                                Swal.fire("Congratulation", `${response.message}`, "success");
                            }
                            Swal.fire("Sorry", `${response.message}`, "error");
                        }
                    })
                })
            })
        </script>
    @endsection
</x-app-layout>
