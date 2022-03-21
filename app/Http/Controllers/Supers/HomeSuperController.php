<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\ChartJsSuperRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeSuperController extends Controller
{
    public function __construct(public ChartJsSuperRepository $repository){}

    public function index(): Factory|View|Application
    {
        return view('admins.supper', [
            'companies' => $this->repository->getCompanyByMonths(),
            'events' => $this->repository->getEventsByMonths(),
            'billings' => $this->repository->getBillingsByMonths()
        ]);
    }
}
