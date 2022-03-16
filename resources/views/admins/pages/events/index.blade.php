@extends('layouts.app')

@section('title', "Liste des evenements")

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Evenements</h3>
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="nk-block nk-block-lg">
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="datatable-init nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                <thead>
                                <tr class="nk-tb-item nk-tb-head text-center">
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
                                    @foreach($events as $event)
                                        <tr class="nk-tb-item text-center">
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
                                            <td class="nk-tb-col tb-col-md text-center">
                                                @if($event->status === \App\Enums\StatusEnum::DEACTIVATE)
                                                    <span class="dot bg-danger d-mb-none"></span>
                                                    <span class="badge badge-sm badge-dot has-bg badge-danger d-none d-mb-inline-flex">{{ $event->status }}</span>
                                                @elseif($event->status === \App\Enums\StatusEnum::ACTIVE)
                                                    <span class="dot bg-success d-mb-none"></span>
                                                    <span class="badge badge-sm badge-dot has-bg badge-success d-none d-mb-inline-flex">{{ $event->status }}</span>
                                                @else
                                                    <span class="dot bg-warning d-mb-none"></span>
                                                    <span class="badge badge-sm badge-dot has-bg badge-warning d-none d-mb-inline-flex">{{ $event->status }}</span>
                                                @endif
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
        </div>
    </div>
@endsection
