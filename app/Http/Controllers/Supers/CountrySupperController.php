<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\CountrySupperRepository;
use Illuminate\Contracts\Support\Renderable;

class CountrySupperController extends Controller
{
    public function __construct(public CountrySupperRepository $repository){}

    public function __invoke(): Renderable
    {
        $countries = $this->repository->getContents();
        return view('admins.pages.countries.index', compact('countries'));
    }
}
