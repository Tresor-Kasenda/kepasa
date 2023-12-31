<x-app-layout>
    @section('title', "Liste des administrateurs")

    <x-vex-container>
        <x-brandcrumb title="Users">
            <li class="nk-block-tools-opt d-none d-sm-block">
                <x-vex-link href="{{ route('supper.users.create') }}" class="btn btn-dim btn-outline-primary">
                    <x-vex-icon class="ni-plus" />
                    <span>Add users</span>
                </x-vex-link>
            </li>
        </x-brandcrumb>

        <x-vex-containt>
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col"><span class="sub-text">User</span></th>
                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Phones number</span></th>
                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Country</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Role</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Created at</span></th>
                    <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                        <span>{{ substr($user->name,0,2) }}</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="tb-lead">
                                            {{ $user->name. " ". $user->lastName }}
                                            <span class="dot dot-success d-md-none ms-1"></span>
                                        </span>
                                        <span>{{ $user->email ?? "" }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-mb">
                                <span class="tb-amount">{{ $user->phones ?? "" }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $user->country->countryName ?? "" }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                <ul class="list-status">
                                    <li>
                                        <em class="icon text-success ni ni-check-circle"></em>
                                        <span>{{ $user->role->name ?? "" }}</span>
                                    </li>
                                </ul>
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                <span>{{ $user->created_at->diffForHumans() ?? "" }}</span>
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
                                                        <a href="{{ route('supper.users.show', $user->id) }}">
                                                            <em class="icon ni ni-focus"></em>
                                                            <span>Quick View</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('supper.users.edit', $user->id) }}">
                                                            <em class="icon ni ni-edit"></em>
                                                            <span>Quick Edit</span>
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
