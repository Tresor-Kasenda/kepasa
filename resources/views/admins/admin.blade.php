@extends('layouts.app')

@section('title', "Administration Kepasa")

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title page-title">Administration</h4>
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="row g-gs">
                    @include('admins.partials.stats', [
                        'username' => "Users",
                        'amount' => \App\Models\User::count()
                    ])
                    @include('admins.partials.stats', [
                        'username' => "Events",
                        'amount' => \App\Models\Event::count()
                    ])
                    @include('admins.partials.stats', [
                        'username' => "Organisers",
                        'amount' => \App\Models\Company::count()
                    ])
                    @include('admins.partials.stats', [
                        'username' => "Billings",
                        'amount' => \App\Models\Billing::count()
                    ])
                </div>
                <div class="row  g-gs">
                    <div class="col-xxl-6">
                        <div class="card">
                            <div class="card-inner">
                                <div>
                                    <canvas
                                        class="sales-overview-chart chartjs-render-monitor"
                                        id="salesOverview"
                                    ></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
