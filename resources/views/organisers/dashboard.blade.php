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
            'icon' => 'im-icon-Clothing-Store'
        ])

        @include('organisers.components._stat', [
            'number' => 0,
            'name' => "Billing",
            'icon' => 'im-icon-Money-2'
        ])
    </div>

    <div class="row margin-bottom-30">
        <div class="col-lg-6 col-md-12">
            <div class="dashboard-list-box invoices with-icons margin-top-20">
                <h4>Payout History</h4>
                <ul>
                    @foreach($payments as $payment)
                        <li><i class="list-box-icon sl sl-icon-wallet"></i>
                            <strong>$84.50</strong>
                            <ul>
                                <li class="unpaid">Unpaid</li>
                                <li>Period: 02/2019</li>
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection


