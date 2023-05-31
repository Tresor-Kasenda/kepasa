<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Settings;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function __invoke()
    {
        return view('admins.pages.settings.index');
    }
}
