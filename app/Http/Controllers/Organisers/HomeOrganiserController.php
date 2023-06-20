<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Repository\Organisers\ChartJsOrganiserRepository;
use App\Repository\Organisers\HomeOrganiserRepository;
use Illuminate\Contracts\Support\Renderable;

class HomeOrganiserController extends Controller
{
    public function __construct(
        protected readonly HomeOrganiserRepository $repository,
        protected readonly ChartJsOrganiserRepository $organiserRepository
    ) {
    }

    public function __invoke(): Renderable
    {
        $bookings = [];
        $data = [];

        foreach ($bookings as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int) $row->count;
        }
        $data['chart_data'] = json_encode($data);

        return view(
            'organisers.dashboard', [
            'payments' => $this->repository->getContents(),
            'data' => $data,
            ]
        );
    }
}
