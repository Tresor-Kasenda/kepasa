@extends('layouts.organiser')

@section('title', "Détail sur l'evenement")

@section('content')
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Listens events / <span class="text-teal-dim">{{ $event->title ?? "" }}</span></h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('organiser.events.index') }}">Back to events</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <div class="listing-slider mfp-gallery-container margin-bottom-0">
                    @if($event->media)
                        @foreach($event->media as $images)
                            <a
                                href="{{ asset('storage/'.$images->images) }}"
                                data-background-image="{{ asset('storage/'.$images->images) }}"
                                class="item mfp-gallery" title="{{ $images->key ?? "" }}"
                            ></a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
