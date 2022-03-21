<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Repository\Organisers\ChartJsOrganiserRepository;
use App\Repository\Organisers\HomeOrganiserRepository;
use Illuminate\Contracts\Support\Renderable;

class HomeOrganiserController extends Controller
{
    public function __construct(public HomeOrganiserRepository $repository, public ChartJsOrganiserRepository $organiserRepository){}

    public function index(): Renderable
    {
        $bookings = $this->organiserRepository->getPaymentForEventOrganiserByDay();
        $data = [];

        foreach($bookings as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int) $row->count;
        }
        $data['chart_data'] = json_encode($data);
        return view('organisers.dashboard', [
            'payments' => $this->repository->getContents(),
            'data' => $data
        ]);
    }
}
