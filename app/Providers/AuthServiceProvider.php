<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use App\Policies\BlogPolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Blog::class => BlogPolicy::class,
        Category::class => CategoryPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        // Gate::define('show_users', function(User $user){
        //     return $user->role === 'admin';
        // });

        Gate::define('admin_only', fn(User $user) => $user->role === "admin");

        // Gate::define('cat_update', function(User $user, Category $category){
        //     return( $user->id == $category->user_id );

        // });

        // Gate::define('cat_delete', function(User $user, Category $category){
        //     return( $user->id == $category->user_id );
        // });

        // //before method work first whether it's declared at the top or bottom
        // Gate::before(function(User $user){
        //     $admins = [1, 5, 7];
        //     if(in_array($user->id, $admins)){
        //         return true;
        //     }
        // });
    }
}
