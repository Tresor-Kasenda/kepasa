@extends('layouts.organiser')

@section('title', "Modification des informations de l'organteur d'evenement")

@section('content')
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Listens events</h2>
            </div>
        </div>
    </div>

    <div class="row" id="message">
        @include('organisers.partials._flash')
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 margin-bottom-35">
            <div class="dashboard-list-box margin-top-0">
                <h4>Events Listings</h4>
                <ul>
                    @foreach($events as $event)
                        <li>
                            <div class="list-box-listing">
                                <div class="list-box-listing-img">
                                    <a href="{{ route('organiser.events.show', $event->key) }}">
                                        <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->city ?? "" }}">
                                    </a>
                                </div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <span class="tag">{{ $event->category->name ?? "" }}</span>
                                        <h3>
                                            <a href="{{ route('organiser.events.show', $event->key) }}">{{ strtoupper($event->title) ?? "" }}</a>
                                            @if($event->status === \App\Enums\StatusEnum::ACTIVE)
                                                <i class="verified-icon"></i>
                                            @endif
                                        </h3>
                                        <div class="inner-booking-list">
                                            <h5>Event Date:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{ $event->date ?? "" }} at {{ $event->startTime ?? "" }} - {{ $event->endTime ?? "" }}</li>
                                            </ul>
                                        </div>
                                        <div class="inner-booking-list">
                                            <h5>Event Location:</h5>
                                            <ul class="booking-list">
                                                <li>{{ $event->city ?? "" }}/{{ $event->address ?? "" }}</li>
                                            </ul>
                                        </div>
                                        <div class="star-rating margin-bottom-5">
                                            @if($event->status == 'desactive')
                                                <span class="pending-data">pending</span>
                                            @endif
                                            @if($event->status == 'postpone')
                                                <span class="message-by">postpone</span>
                                            @endif
                                            @if($event->status == 'active')
                                                <span class="active-data">active</span>
                                            @endif
                                            <span class="message-by">{{ $event->billings_count ?? 0 }} ticket(s) </span>
                                        </div>
                                        @if($event->onlineEvent != null)
                                            @if($event->onlineEvent->mode == "group")
                                                <div class="start-rating d-block">
                                                    @if($event->category_id == 1 && $event->onlineEvent->event_id == $event->id)
                                                        @include('organisers.partials.join', with($event))
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                @if($event->payment == 'paid')
                                @else
                                    <a href="{{ route('organiser.events.payment.index', $event) }}" class="button gray approve">
                                        <i class="sl sl-icon-check"></i> Booking
                                    </a>
                                @endif
                                <a href="{{ route('organiser.events.edit', $event->key) }}" class="button gray">
                                    <i class="sl sl-icon-note"></i> Edit
                                </a>
                                <a href="{{ route('organiser.events.destroy',$event->key) }}" class="button gray" onclick="event.preventDefault(); document.getElementById('destroy-event').submit();">
                                    <i class="sl sl-icon-close"></i> Delete
                                </a>
                                <form id="destroy-event" action="{{ route('organiser.events.destroy',$event->key) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{ $events->links('organisers.partials._pagination') }}
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .list-box-listing-content .inner{
            top: 0;
        }
        .tag{
            background-color: #64bc36;
            color: #fff;
            padding: 6px 15px;
            line-height: 20px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 50px
        }
        .message-by{
            background-color: #e9e9e9;
            border-radius: 50px;
            line-height: 20px;
            font-size: 12px;
            color: #666;
            font-style: normal;
            padding: 3px 8px;
            margin-left: 3px;
            max-height: 1.4rem;
            text-align: left;
        }
        .message-by{
            padding-bottom: 20px;
        }
        .pending-data{
            background-color: #EBF6E0 !important;
            color: #5f9025;
            padding: 2px 10px;
            line-height: 22px;
            font-weight: 700;
            font-size: 14px;
            border-radius: 50px;
        }
        .active-data{
            padding: 2px 10px;
            line-height: 22px;
            font-weight: 700;
            font-size: 14px;
            border-radius: 50px;
            background-color: #E9F7FE !important;
            color: #3184ae;
        }
    </style>
@endsection
