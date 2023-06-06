<?php

namespace App\Http\Controllers\Supers\Events\Promoted;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\Suppers\StatusEventRepository;
use Illuminate\Http\Request;

class UnPromotedEventController extends Controller
{
    public function __construct(
        protected readonly StatusEventRepository $repository
    ) {
    }

    public function __invoke(Event $event)
    {
        $this->repository->unPromoted($event);

        return back();
    }
}
