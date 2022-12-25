<?php

namespace App\Providers;

use App\Interfaces\UploadNotificationServiceInterface;
use App\Mocks\UploadNotificationServiceMock;
use App\Services\UploadNotificationService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UploadNotificationServiceInterface::class, function () {
            if ($this->app->environment('testing')) {
                return new UploadNotificationServiceMock();
            } else {
                return new UploadNotificationService();
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
