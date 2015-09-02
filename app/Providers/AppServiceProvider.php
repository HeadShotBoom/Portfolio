<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.nav', function($view)
        {
            $view->with('portfolio', DB::table('gallery_name')->orderBy('position')->get());
            $view->with('projects', DB::table('project_name')->orderBy('position')->get());
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
