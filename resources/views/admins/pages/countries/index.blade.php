<x-app-layout>
    @section('title', "Liste des pays")

    <x-vex-container>
        <x-brandcrumb title="Countries"></x-brandcrumb>

        <x-vex-containt>
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col"><span class="sub-text">Country name</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Country Code</span></th>
                    <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($countries as $country)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-mb">
                            <span class="tb-amount">{{ $country->countryName ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span class="tb-amount">{{ $country->countryCode ?? "" }}</span>
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
                                                    <a href="{{ route('supper.country.city', $country->id) }}">
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
