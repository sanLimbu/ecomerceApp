<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use App\Models\Category;
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


        Collection::macro('recursive', function(){

            return $this->map(function ($value) {

                if(is_array($value) || is_object($value)) {
                    return collect($value)->recursive();
                }
                return $value;
            });

        });
    }
}
