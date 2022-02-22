<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class EventOrganiserAdminController extends Controller
{
    public function index(): Renderable
    {
        return view('supervisor.pages.organisers.index');
    }
}
