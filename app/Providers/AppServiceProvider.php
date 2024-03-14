<?php

namespace App\Providers;

use App\Models\Configuracion\ConfigMenu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer("layouts.aside", function ($view) {
            $menus = ConfigMenu::getMenu(true);
            $view->with('menusComposer', $menus);
        });
    }
}
