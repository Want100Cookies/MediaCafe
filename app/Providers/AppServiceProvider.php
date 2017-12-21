<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Response::macro('success', function ($data) {
            return \Response::json([
                'errors' => false,
                'data' => $data,
            ]);
        });

        \Response::macro('error', function ($message, $status = 422, $additional_info = []) {
            return \Response::json([
                'message' => $status.' error',
                'errors' => [
                    'message' => $message,
                    'info' => $additional_info,
                ],
                'status_code' => $status,
            ], $status);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
