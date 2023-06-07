<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Events\Promoted;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\Suppers\StatusEventRepository;

class PromotedEventController extends Controller
{
    public function __construct(
        protected readonly StatusEventRepository $repository
    ) {
    }

    public function __invoke(Event $event)
    {
        $this->repository->promoted($event);

        return back();
    }
}
