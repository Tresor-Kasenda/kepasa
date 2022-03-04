<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Repository\BookingRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct(public BookingRepository $repository){}

    public function bookings(string $key): Renderable
    {
        $event = $this->repository->getEventByKey(key:  $key);
        return view('apps.pages.bookings.book', compact('event'));
    }
}
