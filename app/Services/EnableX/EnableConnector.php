<?php

declare(strict_types=1);

namespace App\Services\EnableX;

use Illuminate\Foundation\Application;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class EnableConnector
{
    public function __construct(
        private PendingRequest $request
    ) {
    }

    public static function register(Application $application): void
    {
        $application->bind(
            EnableConnector::class,
            fn () => new EnableConnector(
                Http::baseUrl(
                    'https://api.enablex.io/video/v2/'
                )->timeout(
                    seconds: 15
                )->withHeaders(
                    [
                    'Content-Type: application/json',
                    ]
                )
                    ->withBasicAuth(
                        username: config('enablex.app_id'),
                        password: config('enablex.app_key')
                    )
                    ->asJson()->acceptJson()
            )
        );
    }
}
