<x-app-layout>
    @section('title', "Detail sur la facturation de l'evenement")

    @section('content')
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Invoice
                                    <strong class="text-primary small">#{{ $billing->billingCode }}</strong>
                                </h3>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>Created At:
                                            <span class="text-base">{{ $billing->created_at->format('Y-m-d H:m') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('supper.billing.index') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex">
                                    <em class="icon ni ni-arrow-left"></em>
                                    <span>Back</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="invoice">
                            <div class="invoice-action">
                                <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary"
                                   href="{{ route('supper.billing.invoice', $billing->key) }}" target="_blank">
                                    <em class="icon ni ni-printer-fill"></em>
                                </a>
                            </div>
                            <div class="invoice-wrap">
                                <div class="invoice-brand text-center">
                                    <img
                                        @if($billing->user->company->images)
                                            src="{{ asset('storage/'.$billing->user->company->images) }}"
                                        srcset="{{ asset('storage/'.$billing->user->company->images) }} 2x"
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
                                            <h4 class="title">{{ $billing->user->company->companyName ?? $billing->user->name }}</h4>
                                            <ul class="list-plain">
                                                <li>
                                                    <em class="icon ni ni-map-pin-fill"></em>
                                                    <span>{{ $billing->user->company->address ?? "" }}<br>{{ $billing->user->company->city ?? "" }}, {{ $billing->user->company->country ?? "" }}</span>
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
                </div>
            </div>
        </div>
    @endsection

</x-app-layout>
