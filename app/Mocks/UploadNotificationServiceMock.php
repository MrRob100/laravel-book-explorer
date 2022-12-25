<?php

namespace App\Mocks;

use App\Interfaces\UploadNotificationServiceInterface;

class UploadNotificationServiceMock implements UploadNotificationServiceInterface
{
    public function notify(string $url): void
    {
    }
}
