<?php

namespace App\Http\Controllers\Supers\Events\Promoted;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStatusEvent;
use App\Repository\Suppers\StatusEventRepository;
use Illuminate\Http\Request;

class StatusEventController extends Controller
{
    public function __construct(
        protected readonly StatusEventRepository $repository
    ) {
    }

    public function __invoke(UpdateStatusEvent $request)
    {
        $event = $this->repository->changeStatus(attributes: $request);
        if (false !== $event) {
            return response()->json([
                'message' => 'The status has been successfully updated',
            ]);
        }

        return response()->json([
            'message' => 'Le paiement ne pas encore effectuer pour activer cette evenement',
        ]);
    }
}
