<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class SettingSupperController extends Controller
{
    public function __construct(){}

    public function __invoke():Renderable
    {
        return view('admins.pages.settings.index');
    }
}
