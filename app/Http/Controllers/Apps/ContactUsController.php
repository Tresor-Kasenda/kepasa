<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Repository\ContactRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;

class ContactUsController extends Controller
{
    public function __construct(public ContactRepository $repository)
    {
    }

    public function __invoke(): Renderable
    {
        return view('apps.pages.contacts.index');
    }

    public function store(ContactRequest $contactRequest): JsonResponse
    {
        $this->repository->store($contactRequest);

        return response()->json(
            [
            'message' => 'Votre message a ete envoyer avec success',
            ], 200
        );
    }
}
