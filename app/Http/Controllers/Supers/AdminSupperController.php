<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\AdminSupperRepository;
use Illuminate\Contracts\Support\Renderable;

class AdminSupperController extends Controller
{
    public function __construct(public AdminSupperRepository $repository){}

    public function index(): Renderable
    {
        $admins = $this->repository->getContents();
        return view('admins.pages.users.index', compact('admins'));
    }
}
