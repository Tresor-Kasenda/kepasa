@extends('layouts.organiser')

@section('title', "Espance administration organisateur")

@section('content')
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ auth()->user()->name ?? "" }}  {{ auth()->user()->lastName ?? "" }}</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('organiser.organiser.index') }}">Home</a></li>
                        <li>Dashboard</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        @include('organisers.components._stat', [
            'number' => 0,
            'name' => "Evénement",
            'icon' => 'im-icon-Clothing-Store'
        ])
    </div>
@endsection


