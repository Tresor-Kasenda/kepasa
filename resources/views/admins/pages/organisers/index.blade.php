<x-app-layout>
    @section('title', "Liste des organisateurs des evenements")

    <x-vex-container>
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Organisateurs</h3>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <div class="nk-block nk-block-lg">
                <div class="card card-preview">
                    <div class="card-inner">
                        <table class="datatable-init nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col tb-col-mb">
                                    <span class="sub-text">Company Name</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb">
                                    <span class="sub-text">Contact Number</span>
                                </th>
                                <th class="nk-tb-col tb-col-md">
                                    <span class="sub-text">Contact Email</span>
                                </th>
                                <th class="nk-tb-col tb-col-md">
                                    <span class="sub-text">Country</span>
                                </th>
                                <th class="nk-tb-col tb-col-md">
                                    <span class="sub-text">City</span>
                                </th>
                                <th class="nk-tb-col tb-col-md">
                                    <span class="sub-text">Status</span>
                                </th>
                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                    <span class="sub-text">Actions</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($organisers as $organiser)
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $organiser->companyName ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $organiser->phones ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $organiser->email ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $organiser->country ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $organiser->city ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $organiser->companyName ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">
                                                        <em class="icon ni ni-more-h"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <a href="{{ route('supper.organisers.show', $organiser->key) }}">
                                                                    <em class="icon ni ni-eye"></em>
                                                                    <span>Voir</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('supper.organisers.destroy', $organiser->key) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <button type="submit" class="btn btn-dim">
                                                                        <em class="icon ni ni-lock-alt"></em>
                                                                        <span>Supprimer</span>
                                                                    </button>
                                                                </form>
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
                    </div>
                </div>
            </div>
        </div>
    </x-vex-container>
</x-app-layout>
