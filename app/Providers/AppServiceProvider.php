<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\Blade;

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
        \Blade::directive('datetime', function (string $expression) {
            return "<?= ($expression)->format('d/m/Y H:i:s'); ?>";
        });
    }
}
