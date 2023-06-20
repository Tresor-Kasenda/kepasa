<?php

declare(strict_types=1);

namespace App\Services\EnableX;

use Http;
use Illuminate\Http\Client\PendingRequest;

trait EnableXHttpService
{
    public function request(): PendingRequest
    {
        return Http::withHeaders(
            [
            'Content-Type: application/json',
            ]
        )
            ->withBasicAuth(
                config('enablex.app_id'),
                config('enablex.app_key')
            );
    }
}
