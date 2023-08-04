<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\Customers\EventCustomerRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeUserController extends Controller
{
    public function __construct(
        protected readonly EventCustomerRepository $customerRepository
    )
    {
    }

    public function __invoke(): Factory|View|Application
    {
        return view(
            'users.home',
            [
                'invoices' => $this->customerRepository->getContent(),
            ]
        );
    }
}
