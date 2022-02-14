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

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <h4>Events Listings</h4>
                <ul>
                    @foreach($events as $event)
                        <li>
                            <div class="list-box-listing">
                                <div class="list-box-listing-img">
                                    <a href="{{ route('organiser.events.show', $event->key) }}">
                                        @if($event->media)
                                            @foreach($event->media as $images)
                                                <img src="" alt="">
                                            @endforeach
                                        @else

                                        @endif
                                    </a>
                                </div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <span class="tag">{{ $event->category->name ?? "" }}</span>
                                        <h3>
                                            <a href="{{ route('organiser.events.show', $event->key) }}">{{ strtoupper($event->title) ?? "" }}</a>
                                        </h3>
                                        <span>{{ $event->address ?? "" }}</span>
                                        <div class="star-rating">
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
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a href="{{ route('organiser.events.payment.index', $event) }}" class="button gray approve">
                                    <i class="sl sl-icon-check"></i> Booking
                                </a>
                                <a href="{{ route('organiser.events.edit', $event->key) }}" class="button gray">
                                    <i class="sl sl-icon-note"></i> Edit
                                </a>
                                <a href="#" class="button gray">
                                    <i class="sl sl-icon-close"></i> Delete
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                {{ $events->links() }}
                <div class="col-md-12">
                    <div class="pagination-container margin-top-20 margin-bottom-40">
                        <nav class="pagination">
                            <ul>
                                <li><a href="#" class="current-page">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
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
