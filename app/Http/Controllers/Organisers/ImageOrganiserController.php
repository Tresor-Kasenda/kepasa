<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class ImageOrganiserController extends Controller
{
    public function index(): Renderable
    {
        return view('organisers.pages.images.index');
    }
}
