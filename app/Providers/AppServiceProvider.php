<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\PropertyType;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $view
                ->with('propertyTypes', PropertyType::all())
                ->with('regions', 
                    DB::table('regions')->orderBy('name', 'asc')->get())
                ->with('minPrice',
                    DB::table('properties')->min('rent'))
                ->with('maxPrice',
                    DB::table('properties')->max('rent'));
        });
    }
}
