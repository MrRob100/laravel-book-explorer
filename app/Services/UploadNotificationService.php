<?php

namespace App\Services;

use App\Interfaces\UploadNotificationServiceInterface;
use Illuminate\Support\Facades\Http;

class UploadNotificationService implements UploadNotificationServiceInterface
{
    public function notify(string $url): void
    {
        Http::post('https://postman-echo.com/post', [
            's3_url' => $url,
        ]);
    }
}
