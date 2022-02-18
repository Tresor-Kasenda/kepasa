<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Repository\Organisers\ImagesOrganiserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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
        return view('organisers.pages.images.create');
    }
}
