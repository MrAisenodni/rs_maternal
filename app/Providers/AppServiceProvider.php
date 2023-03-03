<?php

namespace App\Providers;

use App\Models\Settings\{
    MainMenu,
    Provider,
};
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
        // Fungsi untuk menampilkan Provider pada Main Halaman
        view()->composer('layouts.main', function ($view) {
            $view->with(
                'provider', Provider::select('id', 'provider_name', 'provider_logo')->where('disabled', 0)->first()
            );
        });

        // Fungsi untuk menampilkan Menu
        view()->composer('layouts.navbar', function ($view) {
            if (session()->get('suser_id')) {
                $view->with(
                    'main_menus', MainMenu::select('id', 'title', 'icon', 'url', 'parent')->where('disabled', 0)->get()
                );
            } else {
                $view->with(
                    'main_menus', MainMenu::select('id', 'title', 'icon', 'url', 'parent')->where('disabled', 0)->where('is_login', 0)->get()
                );
            }
        });

        // Fungsi untuk menampilkan Provider pada Header
        view()->composer('layouts.header', function ($view) {
            $view->with(
                'provider', Provider::select('id', 'provider_name', 'provider_logo')->where('disabled', 0)->first()
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
