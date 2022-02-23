<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Repository\Organisers\HomeOrganiserRepository;
use Illuminate\Contracts\Support\Renderable;

class HomeOrganiserController extends Controller
{
    public function __construct(public HomeOrganiserRepository $repository){}

    public function index(): Renderable
    {
        return view('organisers.dashboard', [
            'payments' => $this->repository->getContents()
        ]);
    }
}
