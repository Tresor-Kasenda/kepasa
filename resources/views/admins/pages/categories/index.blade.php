<x-app-layout>
    @section('title', "Nos differents categories")

    <x-vex-container>
        <x-brandcrumb title="Categories">
            <li class="nk-block-tools-opt d-none d-sm-block">
                <x-vex-link href="{{ route('supper.category.create') }}" class="btn btn-dim btn-outline-primary">
                    <x-vex-icon class="ni-plus" />
                    <span>Add category</span>
                </x-vex-link>
            </li>
        </x-brandcrumb>

        <x-vex-containt>
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Created at</span></th>
                    <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-mb">
                            <span class="tb-amount">{{ $category->name ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $category->created_at->diffForHumans() ?? "" }}</span>
                        </td>
                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li></li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-vex-containt>

    </x-vex-container>
</x-app-layout>
