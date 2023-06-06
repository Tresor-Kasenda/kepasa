<x-app-layout>
    @section('title', "Detail sur l'evenement")

    <x-vex-container>
        <x-brandcrumb title="Event Details">
            <li class="preview-item">
                <a href="{{ route('supper.events.index') }}"
                   class="btn btn-outline-light btn-sm d-none d-sm-inline-flex">
                    <em class="icon ni ni-arrow-left"></em>
                    <span>Back</span>
                </a>
            </li>
            <li>
                <div class="drodown">
                    <div class="form-control-wrap">
                        <select name="status" id="status" class="form-select form-control form-control-lg">
                            <option value="default_option">Select Status</option>
                            <option value="active">Activated</option>
                            <option value="deactivate">Deactivated</option>
                            <option value="postpone">Post Pone</option>
                        </select>
                    </div>
                </div>
            </li>
            <li class="preview-item">
                @if ($event->promoted == false)
                    @include('admins.partials._update', [
                        'route' => route('supper.events.promoted', $event->id),
                        'button' => 'btn-outline-success btn-sm',
                        'icon' => 'ni-check-circle',
                        'title' => 'Promoted'
                    ])
                @else
                    @include('admins.partials._update', [
                        'route' => route('supper.events.unpromoted', $event->id),
                        'button' => 'btn-outline-danger btn-sm',
                        'icon' => 'ni-check-circle',
                        'title' => 'unPromoted'
                    ])
                @endif
            </li>
        </x-brandcrumb>

        @if($event->promoted == false)
            <div class="alert alert-danger alert-icon " role="alert">
                <em class="icon ni ni-alert-circle"></em>
                La promotion ne peut etre faite que si le paiemment a ete deja effectuer
            </div>
        @endif
        @if($event->status == \App\Enums\StatusEnum::POSTPONE)
            <div class="alert alert-info alert-icon " role="alert">
                <em class="icon ni ni-bell"></em>
                Desoler l'evenement a ete reporter pour des raisons de sécurié
            </div>
        @endif

        <x-vex-containt>
            <div class="justify-content text-center p-2">
                <img
                        src="{{ asset('storage/'.$event->image) }}"
                        alt="{{ $event->title }}"
                        class="thumbnail sq w-25 h-25 img-rounded"
                >
            </div>
            <hr class="is-hr-sm">
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="nk-block">
                        <div class="profile-ud-list">
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Title</span>
                                    <span class="profile-ud-value">{{ $event->title ?? "" }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Sub title</span>
                                    <span class="profile-ud-value">{{ $event->subTitle }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Categories</span>
                                    <span class="profile-ud-value">{{ $event->category->name ?? "" }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Country</span>
                                    <span class="profile-ud-value">{{ $event->country->countryName ?? "" }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Address</span>
                                    <span class="profile-ud-value">{{ $event->address ?? "" }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">status</span>
                                    <span class="profile-ud-value">{{ strtoupper($event->status) ?? "" }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">buyerPrice</span>
                                    <span class="profile-ud-value">${{ $event->buyerPrice ?? "" }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">payment</span>
                                    <span class="profile-ud-value {{ $event->payment === 'unpaid' ? 'text-danger': 'text-primary' }}">{{ strtoupper($event->payment) ?? "" }}</span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Prices</span>
                                    <span class="profile-ud-value">${{ $event->prices ?? 0 }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Number Ticket</span>
                                    <span class="profile-ud-value">{{ $event->ticketNumber ?? 0 }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">feeOption</span>
                                    <span class="profile-ud-value">{{ strtoupper($event->feeOption) ?? "" }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Date</span>
                                    <span class="profile-ud-value">{{ $event->date ?? "" }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Start Time</span>
                                    <span class="profile-ud-value">{{ $event->startTime ?? "" }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">End Time</span>
                                    <span class="profile-ud-value">{{ $event->endTime ?? "" }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Commission</span>
                                    <span class="profile-ud-value">%{{ $event->commission ?? "" }}</span>
                                </div>
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">promoted</span>
                                    @if($event->promoted === false)
                                        <span class="profile-ud-value">Promus</span>
                                    @else
                                        <span class="profile-ud-value text-danger">Not Promoted</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-divider divider md"></div>
                    <div class="nk-block">
                        <div class="nk-block-head nk-block-head-sm nk-block-between">
                            <h5 class="title">Description</h5>
                        </div>
                        <div class="bq-note">
                            <div class="bq-note-item">
                                <div class="bq-note-text">
                                    <p>{{ $event->description ?? "" }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            if (response) {
                                Swal.fire(`${response.message}`, "update", "success");
                            }
                        }
                    })
                })
            })
        </script>
    @endsection
</x-app-layout>
