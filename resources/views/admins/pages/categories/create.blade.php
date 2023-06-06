<x-app-layout>
    @section('title', "Creation de categorie")

    <x-vex-container>
        <x-brandcrumb title="Create users">
            <li class="nk-block-tools-opt d-none d-sm-block">
                <x-vex-link href="{{ route('supper.category-list') }}" class="btn btn-dim btn-outline-primary">
                    <x-vex-icon class="ni-arrow-long-left" />
                    <span>All categories</span>
                </x-vex-link>
            </li>
        </x-brandcrumb>
        <div class="nk-block">
            <div class="card card-bordered">
                <div class="card-inner">
                    <form action="{{ route('supper.category.store') }}" method="post" class="form-validate">
                        @csrf
                        <div class="row  gy-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Name category</label>
                                <div class="form-control-wrap">
                                    <input
                                            type="text"
                                            class="form-control @error('name') error @enderror"
                                            id="name"
                                            value="{{ old('name') }}"
                                            name="name"
                                            placeholder="name"
                                    >
                                    @error('name')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-dim btn-outline-primary">
                                <x-vex-icon class="ni-save"/>
                                <span>Save Category</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-vex-container>
</x-app-layout>