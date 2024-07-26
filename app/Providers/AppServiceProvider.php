<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();


        Response::macro('customJson', function ($status, $message, $data = null, $code = 200) {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $code);
        });

    }
}
