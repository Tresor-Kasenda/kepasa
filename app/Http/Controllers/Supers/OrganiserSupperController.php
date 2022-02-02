<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\OrganiserSupperRepository;
use Illuminate\Contracts\Support\Renderable;

class OrganiserSupperController extends Controller
{
    public function __construct(public OrganiserSupperRepository $repository){}

    public function index(): Renderable
    {
        $organisers = $this->repository->getContents();
        return view('admins.pages.organisers.index', compact('organisers'));
    }
}
