@php use App\Enums\PaymentEnum; @endphp
<x-app-layout>
    @section('title', "Liste des evenements")

    <x-vex-container>
        <x-brandcrumb title="Events Lists"></x-brandcrumb>

        <x-vex-containt>
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col"><span class="sub-text">Images</span></th>
                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Title</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Date</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Prices</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Organiser</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Created at</span></th>
                    <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr class="nk-tb-item @if($event->payment === PaymentEnum::UNPAID) alert alert-danger @endif">
                        <td class="nk-tb-col tb-col-md">
                            <div class="tb-product text-center justify-center">
                                <img
                                        src="{{ asset('storage/'. $event->image) }}"
                                        class="thumb"
                                        alt="{{ $event->tite }}">
                            </div>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $event->title ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $event->date ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>$ {{ $event->prices ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $event->user->name ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $event->created_at->diffForHumans() ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                           data-bs-toggle="dropdown">
                                            <em class="icon ni ni-more-h"></em>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li>
                                                    <a href="{{ route('supper.events.show', $event->id) }}">
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
