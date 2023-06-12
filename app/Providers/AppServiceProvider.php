<?php

namespace App\Providers;

use App\Models\Blog;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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

        Paginator::useBootstrapFive();

        Blade::if('author', function(){
            $blog = Blog::where("user_id", Auth::id())->get();
            return $blog ? true : false;
        });
    }

}
