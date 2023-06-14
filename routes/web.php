<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(PageController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/blog_detail/{id}', 'show')->name('detail');
});

Auth::routes([
    // 'category.show' => false
]);

Route::middleware('auth')->prefix('dashboard')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Route::get('/users_list', [HomeController::class, 'users'])->name('users')->middleware('can:show_users'); //protect route with can-middleware
    Route::get('/users_list', [HomeController::class, 'users'])->name('users')->can('admin_only'); //can method
    Route::get("/user_blog", [HomeController::class, 'userBlog'])->name('userBlog');
    Route::resource('blog', BlogController::class);
    Route::resource('category', CategoryController::class)->middleware('can:viewAny,'.Category::class);
});
