<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Events;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\EventSupperRepository;
use Illuminate\Http\RedirectResponse;

class DestroyEventAdminController extends Controller
{
    public function __construct(
        public EventSupperRepository $repository,
    ) {
    }

    public function __invoke(string $key): RedirectResponse
    {
        $this->repository->delete(key: $key);

        return back();
    }
}
