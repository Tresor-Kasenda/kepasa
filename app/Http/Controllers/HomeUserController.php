<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Repository\Customers\CustomerRepository;
use App\Repository\Customers\EventCustomerRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class HomeUserController extends Controller
{
    public function __construct(public CustomerRepository $repository, public EventCustomerRepository $customerRepository){}

    public function index(): Factory|View|Application
    {
        return view('users.home', [
            'invoices' => $this->customerRepository->getContent()
        ]);
    }

    public function show(string $key): Renderable
    {
        return view('users.invoices.show', [
            'invoice' => $this->customerRepository->getInvoiceContent($key)
        ]);
    }

    public function edit(): Factory|View|Application
    {
        return view('users.profiles.edit', [
            'countries' => $this->repository->getCountries(),
        ]);
    }

    public function update(CustomerRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updateCustomer($attributes, $key);
        return redirect()->route('user.home.index');
    }
}
