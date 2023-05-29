<x-app-layout>
    @section('title', "Liste des organisateurs des evenements")

    <x-vex-container>
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Event organizer details</h3>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="preview-item">
                                    <a href="{{ route('supper.organisers.index') }}" class="btn btn-outline-light btn-sm d-none d-sm-inline-flex">
                                        <em class="icon ni ni-arrow-left"></em>
                                        <span>Back</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <div class="nk-block nk-block-lg">
                <div class="justify-content text-center p-2">
                    <img
                            src="{{ asset('storage/'.$company->images) }}"
                            alt="{{ $company->user->name }}"
                            class="img-fluid img-thumbnail rounded-circle"
                            height="10%"
                            width="10%"
                    >
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="nk-block">
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Company Name</span>
                                                <span class="profile-ud-value">{{ $company->companyName ?? "" }}</span>
                                            </div>
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Company Address</span>
                                                <span class="profile-ud-value">{{ $company->address ?? "" }}</span>
                                            </div>
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Company phones</span>
                                                <span class="profile-ud-value">{{ $company->phones ?? "" }}</span>
                                            </div>
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Company admin</span>
                                                <span class="profile-ud-value">{{ $company->user->name ?? "" }}</span>
                                            </div>
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Company (Admin last name)</span>
                                                <span class="profile-ud-value">{{ $company->user->lastName ?? "" }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Company email</span>
                                                <span class="profile-ud-value">{{ $company->email ?? "" }}</span>
                                            </div>
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Company website</span>
                                                <span class="profile-ud-value">{{ $company->website ?? "" }}</span>
                                            </div>
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Company country</span>
                                                <span class="profile-ud-value">{{ $company->country ?? "" }}</span>
                                            </div>
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Company city</span>
                                                <span class="profile-ud-value">{{ $company->city ?? "" }}</span>
                                            </div>
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Company alternativeNumber</span>
                                                <span class="profile-ud-value">{{ $company->alternativeNumber ?? "" }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-preview">
                    <div class="card-inner">
                        <table class="datatable-init nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col tb-col-mb">
                                    <span class="sub-text">Images</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb">
                                    <span class="sub-text">Category</span>
                                </th>
                                <th class="nk-tb-col tb-col-md">
                                    <span class="sub-text">Date</span>
                                </th>
                                <th class="nk-tb-col tb-col-md">
                                    <span class="sub-text">Start Time</span>
                                </th>
                                <th class="nk-tb-col tb-col-md">
                                    <span class="sub-text">End Time</span>
                                </th>
                                <th class="nk-tb-col tb-col-md">
                                    <span class="sub-text">Ticket Number</span>
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
                            @foreach($company->events as $event)
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col tb-col-md">
                                                <span class="tb-product text-center">
                                                 <img src="{{
                                                    $event->image == 'avatar3.png' ?
                                                    asset('admins/images/avatar3.png')  :
                                                    asset('storage/'.$event->image)
                                                 }}" alt="{{ $event->title }}" class="thumb">
                                             </span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ strtoupper($event->category->name) ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $event->date ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $event->startTime ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $event->endTime ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $event->ticketNumber ?? 0 }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $event->status ?? "Default" }}</span>
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
                                                                <a href="{{ route('supper.viewEvents.show', $event->key) }}">
                                                                    <em class="icon ni ni-eye"></em>
                                                                    <span>Voir</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('supper.viewEvents.edit', $event->key) }}">
                                                                    <em class="icon ni ni-edit"></em>
                                                                    <span>Editer</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('supper.viewEvents.destroy',$event->key) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
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
