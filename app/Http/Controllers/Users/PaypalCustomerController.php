<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Repository\Customers\PaymentCustomerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class PaypalCustomerController extends Controller
{
    public function __construct(public PaymentCustomerRepository $repository)
    {
    }

    /**
     * @throws Throwable
     */
    public function create(Request $attributes): JsonResponse
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
