<?php

namespace App\Http\Controllers\Apps\Bookings;

use App\Http\Controllers\Controller;
use App\Repository\BookingRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookingListsController extends Controller
{
    public function __construct(
        public BookingRepository $repository
    )
    {
    }

    public function __invoke(string $key): View
    {
        $event = $this
            ->repository
            ->getEventByKey(key: $key);

        return view('apps.pages.bookings.book', compact('event'));
    }
}
