<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Repository\Contracts\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaypalController extends Controller
{
    public function __construct(public PaymentRepositoryInterface $repository){}

    public function execute(PaymentRequest $attributes)
    {
        $payment = $this->repository->pay(attributes: $attributes);
        dd($payment, $attributes);
    }
}
