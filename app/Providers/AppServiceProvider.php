<?php

namespace App\Providers;

use App\Models\Settings\MainMenu;
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
        // Fungsi untuk menampilkan Menu
        view()->composer('layouts.navbar', function ($view) {
            $view->with(
                'main_menus', MainMenu::select('id', 'title', 'icon', 'url', 'parent')->where('disabled', 0)->get()
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
