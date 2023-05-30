<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apps\Bookings;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Repository\BookingRepository;

class ConfirmBookingController extends Controller
{
    public function __construct(
        public BookingRepository $repository
    ) {
    }

    public function __invoke(BookingRequest $attributes)
    {
        $token = $this->repository->confirmedPayment(attributes: $attributes);

        return redirect()->away("https://secure.3gdirectpay.com/dpopayment.php?ID={$token}");
    }
}
