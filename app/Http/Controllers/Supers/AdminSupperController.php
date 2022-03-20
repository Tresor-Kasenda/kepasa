<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Repository\Suppers\AdminSupperRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminSupperController extends Controller
{
    public function __construct(public AdminSupperRepository $repository){}

    public function index(): Renderable
    {
        $admins = $this->repository->getContents();
        return view('admins.pages.users.index', compact('admins'));
    }

    public function create(): Factory|View|Application
    {
        return view('admins.pages.users.create');
    }

    public function store(AdminRequest $attributes): RedirectResponse
    {
        $this->repository->created(attributes: $attributes);
        return redirect()->route('supper.admins.index');
    }

    public function edit(string $key): Factory|View|Application
    {
        $admin = $this->repository->getElementByKey(key: $key);
        return view('admins.pages.users.edit', compact('admin'));
    }

    public function update(AdminRequest $attributes, $key): RedirectResponse
    {
        $this->repository->updated(attributes: $attributes, key: $key);
        return redirect()->route('supper.admins.index');
    }

    public function destroy($key): RedirectResponse
    {
        $this->repository->delete(key: $key);
        return redirect()->route('supper.admins.index');
    }
}
