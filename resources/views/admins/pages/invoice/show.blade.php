<x-app-layout>
    @section('title', "Detail sur la facturation de l'evenement")

    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Invoice
                                <strong class="text-primary small">#{{ $invoice->billingCode }}</strong>
                            </h3>
                            <div class="nk-block-des text-soft">
                                <ul class="list-inline">
                                    <li>Created At:
                                        <span class="text-base">{{ $invoice->created_at->format('Y-m-d H:m') }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('supper.invoices-list') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex">
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
                               href="{{ route('supper.invoices.download', $invoice->key) }}" target="_blank">
                                <em class="icon ni ni-printer-fill"></em>
                            </a>
                        </div>
                        <div class="invoice-wrap">
                            <div class="invoice-brand text-center">
                                <img
                                        @if($invoice->event->company->images)
                                            src="{{ asset('storage/'.$invoice->event->company->images) }}"
                                        srcset="{{ asset('storage/'.$invoice->event->company->images) }} 2x"
                                        alt="{{ $invoice->event->company->companyName }}"
                                        @else
                                            src="{{ asset('assets/images/logo.png') }}"
                                        srcset="{{ asset('assets/images/logo.png') }} 2x"
                                        alt="{{ $invoice->event->name }}"
                                        @endif
                                >
                            </div>
                            <div class="invoice-head">
                                <div class="invoice-contact">
                                    <span class="overline-title">Invoice To</span>
                                    <div class="invoice-contact-info">
                                        <h4 class="title">{{ $invoice->event->company->companyName ?? $invoice->event->name }}</h4>
                                        <ul class="list-plain">
                                            <li>
                                                <em class="icon ni ni-map-pin-fill"></em>
                                                <span>{{ $invoice->event->company->address ?? "" }}<br>{{ $invoice->event->company->city ?? "" }}, {{ $billing->event->company->country ?? "" }}</span>
                                            </li>
                                            <li><em class="icon ni ni-call-fill"></em>
                                                <span>{{ $invoice->event->company->phones ?? $invoice->event->phones }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="invoice-desc">
                                    <h3 class="title">Invoice</h3>
                                    <ul class="list-plain">
                                        <li class="invoice-id">
                                            <span>Invoice ID</span>:
                                            <span>{{ $invoice->billingCode }}</span>
                                        </li>
                                        <li class="invoice-date">
                                            <span>Date</span>:
                                            <span>{{ $invoice->created_at->isoFormat('MMM Do YY') }}</span>
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
                                            <td>{{ $invoice->event->title ?? "" }}</td>
                                            <td>$ {{ $invoice->event->prices ?? 0 }}</td>
                                            <td>{{ $invoice->event->ticketNumber ?? 0 }}</td>
                                            <td>% {{ $invoice->commission ?? 0 }}</td>
                                            <td>$ {{ $invoice->payout ?? 0 }}</td>
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

</x-app-layout>
