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
