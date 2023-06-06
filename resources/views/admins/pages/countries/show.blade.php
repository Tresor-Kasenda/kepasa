<x-app-layout>
    @section('title', "Ville du pays")

    <x-vex-container>
        <x-brandcrumb title="Cities">
            <x-vex-link href="{{ route('supper.country-list') }}" class="btn btn-dim btn-outline-primary">
                <x-vex-icon class="ni-arrow-long-left"/>
                <span>All countries</span>
            </x-vex-link>
        </x-brandcrumb>

        <x-vex-containt>
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">City Name</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Latitude</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Longitude</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Population</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Promoted</span></th>
                    <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cities as $city)
                    <tr class="nk-tb-item">
                            <td class="nk-tb-col tb-col-mb">
                                <span>
                                    {{ $city->cityName ?? "" }}
                                </span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $city->latitude ?? "" }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                <span>{{ $city->longitude ?? "" }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                <span>{{ $city->population ?? "" }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                <span>
                                    {{ $city->promoted ?? "" }}
                                </span>
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
                                                    <a href="{{ route('supper.cities.edit', $city->id) }}">
                                                        <em class="icon ni ni-edit"></em>
                                                        <span>Quick Edit</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('supper.country-city.show', $city->id) }}">
                                                        <em class="icon ni ni-eye-alt"></em>
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