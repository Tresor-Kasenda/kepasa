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
                <h4>Earnings <div class="comission-taken">Fee: <strong>15%</strong></div></h4>
                <ul>
                    <li>
                        <i class="list-box-icon sl sl-icon-basket"></i>
                        <strong>Sunway Apartment</strong>
                        <ul>
                            <li class="paid">$99.00</li>
                            <li class="unpaid">Fee: $14.50</li>
                            <li class="paid">Net Earning: <span>$84.50</span></li>
                            <li>Order: #00124</li>
                            <li>Date: 01/02/2019</li>
                        </ul>
                    </li>

                    <li><i class="list-box-icon sl sl-icon-basket"></i>
                        <strong>Sunway Apartment</strong>
                        <ul>
                            <li class="paid">$67.00</li>
                            <li class="unpaid">Fee: $10.05</li>
                            <li class="paid">Net Earning: <span>$56.95</span></li>
                            <li>Order: #00123</li>
                            <li>Date: 22/01/2019</li>
                        </ul>
                    </li>

                    <li><i class="list-box-icon sl sl-icon-basket"></i>
                        <strong>Sunway Apartment</strong>
                        <ul>
                            <li class="paid">$122.00</li>
                            <li class="unpaid">Fee: $18.30</li>
                            <li class="paid">Net Earning: <span>$103.70</span></li>
                            <li>Order: #00122</li>
                            <li>Date: 18/01/2019</li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="dashboard-list-box invoices with-icons margin-top-20">
                <h4>Payout History</h4>
                <ul>
                    <li><i class="list-box-icon sl sl-icon-wallet"></i>
                        <strong>$84.50</strong>
                        <ul>
                            <li class="unpaid">Unpaid</li>
                            <li>Period: 02/2019</li>
                        </ul>
                    </li>

                    <li><i class="list-box-icon sl sl-icon-wallet"></i>
                        <strong>$189.20</strong>
                        <ul>
                            <li class="paid">Paid</li>
                            <li>Period: 01/2019</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection


