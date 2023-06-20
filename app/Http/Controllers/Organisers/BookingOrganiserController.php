<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Repository\Organisers\BookingOrganiserRepository;
use Illuminate\Contracts\Support\Renderable;

class BookingOrganiserController extends Controller
{
    public function __construct(public BookingOrganiserRepository $repository)
    {
    }

    public function __invoke(): Renderable
    {
        return view(
            'organisers.pages.billings.index', [
            'bookings' => $this->repository->getContent(),
            ]
        );
    }
}
