<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\Repository\HomeRepository;
use Illuminate\View\View;

class CountryComposer
{
    public function __construct(public HomeRepository $repository)
    {
    }

    public function compose(View $view): void
    {
        $view->with('countries', $this->repository->getCountries());
    }
}
