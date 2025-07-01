<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Layouts\App;
use App\View\Components\Layouts\Guest;

use App\View\Components\Core\Button;
use App\View\Components\Core\Navbar;
use App\View\Components\Core\Footer;
use App\View\Components\Core\Sidebar;
use App\View\Components\Core\Table;
use App\View\Components\Core\Breadcrumb;

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
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        Blade::component('layouts.app', App::class);
        Blade::component('layouts.guest', Guest::class);

        Blade::component('core.navbar', Navbar::class);
        Blade::component('core.footer', Footer::class);
        Blade::component('core.sidebar', Sidebar::class);
        Blade::component('core.button', Button::class);
        Blade::component('core.table', Table::class);
        Blade::component('core.breadcrumb', Breadcrumb::class);
    }
}
