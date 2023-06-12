<x-admin-layout>
    @section('title', "Companies details")

    <x-vex-container>
        <x-brandcrumb title="Detail company">
            <x-vex-link href="{{ route('supper.company-lists') }}" class="btn btn-dim btn-outline-primary">
                <x-vex-icon class="ni-arrow-long-left"/>
                <span>All companies</span>
            </x-vex-link>
        </x-brandcrumb>

        <x-vex-containt>
            <div class="card-inner-group">
                <div class="card-inner">
                    <div class="user-card user-card-s2">
                        <div class="user-avatar lg bg-primary">
                            <img
                                src="{{ asset('storage/'. $company->images) }}"
                                alt="{{ $company->id ?? "" }}"
                            >
                        </div>
                    </div>
                </div>

                <div class="card-inner card-inner-sm">
                    <ul class="btn-toolbar justify-center gx-1">
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
                            <span class="sub-text">Company Name:</span>
                            <span class="lead-text">{{ $company->companyName ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Company address:</span>
                            <span class="lead-text">{{ $company->address ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Company Phones:</span>
                            <span class="lead-text">{{ $company->phones ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Company Email:</span>
                            <span class="lead-text">{{ $company->email ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Company website:</span>
                            <span class="lead-text">{{ $company->website ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Company Social Media</span>
                            <span class="lead-text">{{ $company->socialMedia ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Company Country:</span>
                            <span class="lead-text">{{ $company->country ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Company city:</span>
                            <span class="lead-text">{{ $company->city ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Company creator:</span>
                            <span class="lead-text">{{ $company->user->name ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Company creator last name:</span>
                            <span class="lead-text">{{ $company->user->lastName ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Company creator Email:</span>
                            <span class="lead-text">{{ $company->user->email ?? "" }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Register At:</span>
                            <span class="lead-text">{{ $company->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </x-vex-containt>

        <x-vex-containt>
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col"><span class="sub-text">Images</span></th>
                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Title</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Date</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Prices</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Organiser</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Promoted</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Created at</span></th>
                    <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($company->events() as $event)
                    <tr class="nk-tb-item @if($event->payment === PaymentEnum::UNPAID) alert alert-danger @endif">
                        <td class="nk-tb-col tb-col-md">
                            <div class="tb-product text-center justify-center">
                                <img
                                        src="{{ asset('storage/'. $event->image) }}"
                                        class="thumb"
                                        alt="{{ $event->tite }}">
                            </div>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $event->title ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $event->date ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>$ {{ $event->prices ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $event->user->name ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <ul class="list-status">
                                <li>
                                    @if($event->promoted)
                                        <em class="icon text-success ni ni-check-circle"></em>
                                    @endif
                                    <span>{{ $event->promoted ? "Promoted" : "Not Promoted" }}</span>
                                </li>
                            </ul>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $event->created_at->diffForHumans() ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                           data-bs-toggle="dropdown">
                                            <em class="icon ni ni-more-h"></em>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li>
                                                    <a href="{{ route('supper.events.show', $event->id) }}">
                                                        <em class="icon ni ni-focus"></em>
                                                        <span>Quick View</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-vex-containt>
    </x-vex-container>

    <div class="modal fade" id="modalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Message to company user</h5>
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
</x-admin-layout>
