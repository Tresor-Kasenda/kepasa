<?php

namespace App\Services\EnableX;

use Illuminate\Foundation\Application;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class EnableConnector
{
    public function __construct(
        private PendingRequest $request
    ) {}

    public static function register(Application $application): void
    {
        $application->bind(
            EnableConnector::class,
            fn() => new EnableConnector(
                Http::baseUrl(
                    ''
                )->timeout(
                    seconds: 15
                )->withHeaders([
                    'Content-Type: application/json',
                ])
                ->withBasicAuth(
                    username: '',
                    password: ''
                )
                ->asJson()->acceptJson()
            )
        );
    }
}
