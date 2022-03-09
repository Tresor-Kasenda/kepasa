<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStatusEvent;
use App\Repository\Suppers\StatusEventRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PromotedEventSuperController extends Controller
{
    public function __construct(public StatusEventRepository $repository){}

    public function promoted(string $key): RedirectResponse
    {
        $this->repository->promoted(key: $key);
        return back();
    }

    public function notPromoted(string $key): RedirectResponse
    {
        $this->repository->unPromoted(key: $key);
        return back();
    }

    public function changeStatus(UpdateStatusEvent $event): JsonResponse
    {
        $this->repository->changeStatus(attributes: $event);
        return response()->json([
            'message' => "The status has been successfully updated"
        ]);
    }
}
