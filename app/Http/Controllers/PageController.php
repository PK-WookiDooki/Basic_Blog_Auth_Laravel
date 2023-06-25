<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $blogs = Blog::when(request()->has('keyword'), function($query){
            $query->where(function(Builder $builder) {
                $keyword = request()->keyword;
                $builder->where('title', "Like", "%".$keyword."%");
                $builder->orWhere("description", "Like", "%".$keyword."%");
            });
        })->when(request()->has('category'), function($query){
            $query->where("category_id", request()->category);
        })->when(request()->has("title"), function($query){
            $sortType = request()->title ?? 'asc';
            $query->orderBy('title', $sortType);
        })->latest("id")->paginate(10)->withQueryString();
        return view('welcome', compact('blogs'));
    }

    public function show($slug){
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('blog_detail', compact('blog'));
    }

    public function categorize($slug){
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('categorize', [
            'category' => $category,
            'blogs' => $category->blogs()->when(request()->has('keyword'), function($query){
                $query->where(function(Builder $builder) {
                    $keyword = request()->keyword;
                    $builder->where('title', "Like", "%".$keyword."%");
                    $builder->orWhere("description", "Like", "%".$keyword."%");
                });
            })->paginate(10)->withQueryString(),
        ]);
    }
}
