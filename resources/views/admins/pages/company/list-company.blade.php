<x-admin-layout>
    @section('title', "Companies lists")

    <x-vex-container>
        <x-brandcrumb title="Companies"></x-brandcrumb>

        <x-vex-containt>
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Company Name</span></th>
                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Company Phones</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Company Email</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Creator</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Company address</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Created at</span></th>
                    <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-mb">
                            <span>{{ strtoupper($company->companyName) ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $company->phones ?? 0 }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $company->email ?? 0 }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $company->user->name ?? 0 }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $company->address ?? 0 }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-lg">
                            <span>{{ $company->created_at->diffForHumans() ?? "" }}</span>
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
                                                    <a href="{{ route('supper.company.show', $company->id) }}">
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
</x-admin-layout>
