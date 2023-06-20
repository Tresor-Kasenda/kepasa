<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Models\Images;
use App\Repository\Organisers\ImagesOrganiserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ImageOrganiserController extends Controller
{
    public function __construct(
        protected readonly ImagesOrganiserRepository $repository,
    ) {
    }

    public function index(): Renderable
    {
        return view(
            'organisers.pages.images.index', [
            'images' => $this->repository->getContents(),
            ]
        );
    }

    public function create(): Factory|View|Application
    {
        return view(
            'organisers.pages.images.create', [
            'events' => $this->repository->getEvents(),
            ]
        );
    }

    public function store(ImageRequest $attributes): RedirectResponse
    {
        $this->repository->create(request: $attributes);

        return redirect()->route('organiser.images.index');
    }

    public function edit(Images $image): Factory|View|Application
    {
        return view(
            'organisers.pages.images.edit', [
            'events' => $this->repository->getEvents(),
            'image' => $image,
            ]
        );
    }

    public function update(Images $image, ImageRequest $request): RedirectResponse
    {
        $this->repository->update($image, $request);

        return redirect()->route('organiser.images.index');
    }

    public function destroy(Images $image): RedirectResponse
    {
        $this->repository->delete($image);

        return redirect()->route('organiser.images.index');
    }
}
