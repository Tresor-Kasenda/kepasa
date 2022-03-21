<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Repository\Organisers\PaypalRepository;

class PaypalController extends Controller
{
    public function __construct(public PaypalRepository $repository){}

    public function create(PaymentRequest $attributes)
    {
        $payment = $this->repository->pay(attributes: $attributes);
    }
}
