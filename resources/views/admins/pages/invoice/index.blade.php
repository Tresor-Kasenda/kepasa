@php use App\Enums\StatusEnum; @endphp
<x-app-layout>
    @section('title', "Facture par evenement")

    <x-vex-container>
        <x-brandcrumb title="Customers"></x-brandcrumb>

        <x-vex-containt>
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Event title</span></th>
                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Event Price ticket</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Organiser Event</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Event Ticket Numbers</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Event Total amount</span></th>
                    <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $billing)
                    <tr class="nk-tb-item {{ $billing->status === 'unpaid' ? "alert alert-danger" : "" }}">
                        <td class="nk-tb-col tb-col-mb">
                            <span>{{ strtoupper($billing->event->title) ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>$ {{ number_format($billing->event->prices, 2, ". ") ?? 0 }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $billing->event->user->name . "-". $billing->event->user->lastName ?? 0 }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $billing->ticketNumber ?? 0 }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>$ {{ number_format($billing->totalAmount, 2, ". ") ?? 0 }}</span>
                        </td>
                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                            <em class="icon ni ni-more-h"></em>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li>
                                                    <a href="{{ route('supper.invoices.show', $billing->id) }}">
                                                        <em class="icon ni ni-focus"></em>
                                                        <span>Quick View</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-vex-containt>
    </x-vex-container>
</x-app-layout>

