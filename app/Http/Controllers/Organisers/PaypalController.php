<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Repository\Organisers\PaypalRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class PaypalController extends Controller
{
    public function __construct(public PaypalRepository $repository){}

    /**
     * @throws Throwable
     */
    public function create(PaymentRequest $attributes): JsonResponse
    {
        return $this->repository->pay(attributes: $attributes);
    }

    /**
     * @throws Throwable
     */
    public function capture(Request $attributes): JsonResponse
    {
        return $this->repository->capture(attributes: $attributes);
    }
}
