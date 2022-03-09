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
            'number' => \App\Models\Event::query()->where('user_id', '=', auth()->id())->count(),
            'name' => "Evénement",
            'icon' => 'im-icon-Clothing-Store',
            'color' => 'color-1'
        ])

        @include('organisers.components._stat', [
            'number' => 0,
            'name' => "Billing",
            'icon' => 'im-icon-Money-2',
            'color' => 'color-2'
        ])

        @include('organisers.components._stat', [
            'number' => \App\Models\Images::query()->where('company_id', '=', auth()->user()->company->id)->count(),
            'name' => "Images",
            'icon' => 'im-icon-Cloud-Picture',
            'color' => 'color-3'
        ])
    </div>

    <div class="row margin-bottom-30">
        <div class="col-lg-12 col-md-12">
            <div class="dashboard-list-box invoices with-icons margin-top-20">
                <h4>Payout History</h4>
                <canva></canva>
            </div>
        </div>
    </div>
@endsection


