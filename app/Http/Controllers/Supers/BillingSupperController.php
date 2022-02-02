<?php
declare(strict_types=1);
namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\BillingSupperRepository;
use Illuminate\Contracts\Support\Renderable;

class BillingSupperController extends Controller
{
    public function __construct(public BillingSupperRepository $repository){}

    public function __invoke(): Renderable
    {
        $billings = $this->repository->getContents();
        return view('admins.pages.billings.index', compact('billings'));
    }
}
