<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class PromotionRequestController extends Controller
{
    public function __invoke(): Renderable
    {
        return view('apps.pages.cities.index');
    }
}
