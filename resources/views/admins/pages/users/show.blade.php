@php
    use App\Enums\RoleEnum;
    use App\Enums\UserStatus;
@endphp
<x-app-layout>
    @section('title', "Liste des administrateurs")

    <x-vex-container>

        <x-brandcrumb title="Users details">
            <li class="nk-block-tools-opt d-none d-sm-block">
                <x-vex-link href="{{ route('supper.users-list') }}" class="btn btn-dim btn-outline-primary">
                    <x-vex-icon class="ni-arrow-long-left"/>
                    <span>All users</span>
                </x-vex-link>
                @if(auth()->event()->role_id === RoleEnum::SUPER)
                    @if($event->role_id !== RoleEnum::ORGANISER)
                        <x-vex-link href="{{ route('supper.users.edit', $event->id) }}"
                                    class="btn btn-dim btn-outline-secondary">
                            <x-vex-icon class="ni-edit-fill"/>
                            <span>Edit users</span>
                        </x-vex-link>
                        <li class="preview-item">
                            <form
                                    action="{{ route('supper.users.delete', $event->id) }}"
                                    method="POST"
                                    class="d-inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this item?');"
                            >
                                @method('DELETE')
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-dim btn-outline-danger">
                                    <x-vex-icon class="ni-trash-empty-fill"/>
                                    <span>Delete users</span>
                                </button>
                            </form>
                        </li>
                     @endif
                @endif
            </li>
        </x-brandcrumb>

        @if($event->status === UserStatus::DEACTIVATE)
            <div class="alert alert-icon alert-danger" role="alert">
                <em class="icon ni ni-alert-circle"></em>
                <strong>Warning</strong>. Your status is blocked please contact administrator.
            </div>
        @endif

        <x-vex-containt>
            <div class="card-inner-group">
                <div class="card-inner">
                    <div class="event-card event-card-s2">
                        <div class="event-avatar lg bg-primary">
                            <img src="{{ asset('storage/'. $event->images) }}" alt="{{ $event->name ?? "" }}">
                        </div>
                        <div class="event-info">
                            <div class="badge bg-light rounded-pill ucap">{{ $event->role->name ?? "" }}</div>
                            <h5>{{ $event->name . " " . $event->lastName }}</h5>
                            <span class="sub-text">{{ $event->email ?? "" }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-inner card-inner-sm">
                    <ul class="btn-toolbar justify-center gx-1">
                        <li>
                            <div class="custom-control custom-switch mt-1">
                                <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        data-id="{{ $event->id }}"
                                        onclick="changeHouseStatus(event.target,{{ $event->id }} );"
                                        id="activated"
                                        name="users">
                                <label class="custom-control-label" for="activated"></label>
                            </div>
                        </li>
                        <li>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalForm"
                                    class="btn btn-trigger btn-icon">
                                <em class="icon ni ni-mail"></em>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-inner">
                    <h6 class="overline-title mb-2">Short Details</h6>
                    <div class="row g-3">
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">User Name:</span>
                            <span>{{ $event->name ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Last Name:</span>
                            <span>{{ $event->lastName ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Billing Email:</span>
                            <span>{{ $event->email ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Phones Numbers:</span>
                            <span>{{ $event->phones ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Role Users:</span>
                            <span>{{ $event->role->name ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Country</span>
                            <span>{{ $event->country->countryName ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Status:</span>
                            <span class="lead-text text-success">{{ $event->status ? "Activated" : "Deactivated" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Register At:</span>
                            <span>{{ $event->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </x-vex-containt>

    </x-vex-container>

    <div class="modal fade" id="modalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Message to event</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="#" class="form-validate is-alter">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="subject">Subject</label>
                            <div class="form-control-wrap">
                                <input
                                        type="text"
                                        class="form-control @error('subject') error @enderror"
                                        id="subject"
                                        name="subject"
                                        placeholder="write the subject"
                                        required>
                                @error('subject')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="message">Message</label>
                            <div class="form-control-wrap">
                                <textarea
                                        class="form-control form-control-sm @error('message') error @enderror"
                                        id="message"
                                        name="message"
                                        placeholder="Write your message"
                                ></textarea>
                                @error('message')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dim btn-primary">
                                <x-vex-icon class="ni-send-alt"/>
                                <span>Send messages</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            let changeHouseStatus = async (_this, id) => {
                const status = $(_this).prop('checked') === true ? 1 : 0;
                let _token = $('meta[name="csrf-token"]').attr('content');
                let data = {
                    status: status,
                    users: id
                }
                let headers = {
                    'Content-type': 'application/json; charset=UTF-8',
                    'x-csrf-token': _token,
                }
                await fetch('/supper/users/status', {
                    method: "POST",
                    body: JSON.stringify(data),
                    headers: headers
                })
                    .then(response => response.json())
                    .then((data) => {
                        var result = Object.values(data)
                        Swal.fire(`Status Active`, `${result[0]}`, 'success')
                    })
                    .catch((error) => {
                        Swal.fire("Desoler", "Desoler une erreur est survenue lors de l'execution de cette tache","error")
                    })
            }
        </script>
    @endsection
</x-app-layout>
