<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaypalPaymentController extends Controller
{
    public function create(Request $request)
    {
        dd($request->all());
    }

    public function capture(Request $request)
    {
        dd($request->all());
    }
}
