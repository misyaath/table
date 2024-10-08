<?php

namespace App\src\Domain\Tables\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->group(base_path('app/src/Domain/Tables/routes/api/v1/api.php'));
        });
    }
}
