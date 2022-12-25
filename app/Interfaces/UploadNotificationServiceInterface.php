<?php

namespace App\Interfaces;

interface UploadNotificationServiceInterface
{
    public function notify(string $url): void;
}
