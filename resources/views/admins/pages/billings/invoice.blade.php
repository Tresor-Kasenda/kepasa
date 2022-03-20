<!DOCTYPE html>
<html lang="zxx" class="js">
<head> <meta charset="utf-8">
    <meta name="author" content="{{ $billing->user->name }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $billing->event->description }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
    <title>KEPASA | {{ $billing->event->title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/admins/css/dashlite2.9.css') }}">
</head>
<body class="bg-white" onload="printPromot()">
<div class="nk-block">
    <div class="invoice invoice-print">
        <div class="invoice-wrap">
            <div class="invoice-brand text-center">
                <img
                    @if($billing->user->company->images != null)
                        src="{{ asset('storage/'.$billing->user->company->image) }}"
                        srcset="{{ asset('storage/'.$billing->user->company->image) }} 2x"
                        alt="{{ $billing->user->company->companyName }}"
                    @else
                    src="{{ asset('assets/images/logo.png') }}"
                    srcset="{{ asset('assets/images/logo.png') }} 2x"
                    alt="{{ $billing->user->name }}"
                    @endif
                >
            </div>
            <div class="invoice-head">
                <div class="invoice-contact">
                    <span class="overline-title">Invoice To</span>
                    <div class="invoice-contact-info">
                        <h4 class="title">{{ $billing->user->company->companyName }}</h4>
                        <ul class="list-plain">
                            <li>
                                <em class="icon ni ni-map-pin-fill"></em>
                                <span>{{ $billing->user->company->address ?? "" }}<br>{{ $billing->user->company->city ?? "" }}, {{ $billing->company->country ?? "" }}</span>
                            </li>
                            <li><em class="icon ni ni-call-fill"></em>
                                <span>{{ $billing->user->company->phones ?? $billing->user->phones }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="invoice-desc">
                    <h3 class="title">Invoice</h3>
                    <ul class="list-plain">
                        <li class="invoice-id">
                            <span>Invoice ID</span>:
                            <span>{{ $billing->billingCode }}</span>
                        </li>
                        <li class="invoice-date">
                            <span>Date</span>:
                            <span>{{ $billing->created_at->isoFormat('MMM Do YY') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="invoice-bills">
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Unit Prices</th>
                            <th>Ticket Number</th>
                            <th>Commission</th>
                            <th>Payout Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $billing->event->title ?? "" }}</td>
                            <td>$ {{ $billing->event->prices ?? 0 }}</td>
                            <td>{{ $billing->event->ticketNumber ?? 0 }}</td>
                            <td>% {{ $billing->commission ?? 0 }}</td>
                            <td>$ {{ $billing->payout ?? 0 }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="nk-notes ff-italic fs-12px text-soft">
                        Invoice was created on a computer and is valid without the signature and seal.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function printPromot() {
        window.print();
    }
</script>
</body>
</html>
