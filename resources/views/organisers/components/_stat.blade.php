<div class="col-lg-4 col-md-6">
    <div class="dashboard-stat {{ $color ?? 'color-1' }}">
        <div class="dashboard-stat-content wallet-totals">
            <h4>{{ $number ?? 0 }}</h4>
            <span>{{ $name ?? "" }}<strong class="wallet-currency">{{ $devise ?? "" }}</strong></span>
        </div>
        <div class="dashboard-stat-icon">
            <i class="im {{ $icon ?? "" }}"></i>
        </div>
    </div>
</div>
