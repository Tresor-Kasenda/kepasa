@extends('layouts.app')

@section('title', "Detail sur l'evenement")

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between g-3">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Event / <strong class="text-primary small">{{ $event->title }}</strong></h3>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li class="preview-item">
                                        <a href="{{ route('supper.viewEvents.index') }}" class="btn btn-outline-light btn-sm d-none d-sm-inline-flex">
                                            <em class="icon ni ni-arrow-left"></em>
                                            <span>Back</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="nk-block nk-block-lg">
                    <div class="justify-content text-center p-2">
                        <img
                            src="{{ asset('storage/'.$event->image) }}"
                            alt="{{ $event->title }}"
                            class="img-fluid img-thumbnail rounded-circle"
                            height="10%"
                            width="10%"
                        >
                    </div>
                    <div class="card">
                        <div class="card-inner">
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
                                                    <span class="profile-ud-value">{{ $event->country ?? "" }}</span>
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
                                                    <span class="profile-ud-value">{{ strtoupper($event->payment) ?? "" }}</span>
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
                                                        <span class="profile-ud-value">Not Promoted</span>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
