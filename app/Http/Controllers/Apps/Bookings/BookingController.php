<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apps\Bookings;

use App\Http\Controllers\Controller;
use App\Repository\BookingRepository;

class BookingController extends Controller
{
    public function __construct(
        public BookingRepository $repository
    ) {
    }

    public function __invoke(string $key): void
    {
    }
}
