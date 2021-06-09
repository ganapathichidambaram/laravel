<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use DB; // Illuminate\Support\Facades\DB;
use File;

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
        //
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        // DB::listen(function($query) {
        //     File::append(
        //         storage_path('/logs/query.log'),
        //         ' [' .date('Y-m-d H:i:s') . ']'. ' local.debug: ' . $query->time .'--' . $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL
        //     );
        // });
    }
}
