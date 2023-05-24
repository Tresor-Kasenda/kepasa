<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\OrganiserSupperRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrganiserSupperController extends Controller
{
    public function __construct(public OrganiserSupperRepository $repository)
    {
    }

    public function index(): Renderable
    {
        $organisers = $this->repository->getContents();

        return view('admins.pages.organisers.index', compact('organisers'));
    }

    public function show(string $key): Factory|View|Application
    {
        $company = $this->repository->getCompanyByKey(key: $key);

        return view('admins.pages.organisers.show', compact('company'));
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->delete(key: $key);

        return redirect()->route('supper.organisers.index');
    }
}
