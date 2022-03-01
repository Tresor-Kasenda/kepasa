<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShareRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class PromotionRequestController extends Controller
{
    public function __invoke(): Renderable
    {
        return view('apps.pages.cities.index');
    }

    public function store(ShareRequest $request)
    {
        dd($request->all());
    }
}
