<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Repository\Organisers\ImagesOrganiserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ImageOrganiserController extends Controller
{
    public function __construct(public ImagesOrganiserRepository $repository){}

    public function index(): Renderable
    {
        return view('organisers.pages.images.index', [
            'images' => $this->repository->getContents()
        ]);
    }

    public function create(): Factory|View|Application
    {
        return view('organisers.pages.images.create', [
            'events' => $this->repository->getContents()
        ]);
    }

    public function store(ImageRequest $attributes): RedirectResponse
    {
        $this->repository->create(attributes: $attributes);
        return redirect()->route('organiser.images.index');
    }

    public function edit(string $key): Factory|View|Application
    {
        $image = $this->repository->getImageByKey(key: $key);
        return view('organisers.pages.images.create', [
            'events' => $this->repository->getContents()
        ]);
    }

    public function update(string $key, $attributes): RedirectResponse
    {
        $this->repository->update(key: $key, attributes: $attributes);
        return redirect()->route('organiser.images.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->delete(key: $key);
        return redirect()->route('organiser.images.index');
    }
}
