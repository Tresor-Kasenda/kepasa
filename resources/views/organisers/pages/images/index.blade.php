@extends('layouts.organiser')

@section('title', "Images des evenements")

@section('content')
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Listens images events</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li>
                            <a href="{{ route('organiser.images.create') }}">
                                <i class="fa fa-database"></i>
                                Add Images
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row" id="message">
        @include('organisers.partials._flash')
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <h4>Images Listings</h4>
                <ul>
                    @foreach($images as $image)
                        <li>
                            <div class="list-box-listing">
                                <div class="list-box-listing-img">
                                    <a href="#">
                                        <img src="{{ asset('storage/'.$image->image) }}" alt="{{ $image->event->title }}">
                                    </a>
                                </div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3>{{ $image->event->title ?? "" }}</h3>
                                        <span>{{ $image->event->address ?? "" }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a href="{{ route('organiser.images.edit', $image->key) }}" class="button gray">
                                    <i class="sl sl-icon-note"></i> Edit
                                </a>
                                <a href="{{ route('organiser.images.destroy',$image->key) }}" class="button gray" onclick="event.preventDefault(); document.getElementById('destroy-event').submit();">
                                    <i class="sl sl-icon-close"></i> Delete
                                </a>
                                <form id="destroy-event" action="{{ route('organiser.images.destroy',$image->key) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{ $images->links() }}
        </div>
    </div>
@endsection
