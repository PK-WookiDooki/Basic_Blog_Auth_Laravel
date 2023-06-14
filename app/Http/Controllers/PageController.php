<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $blogs = Blog::when(request()->has('keyword'), function($query){
            $keyword = request()->keyword;
            $query->where('title', "Like", "%".$keyword."%");
            $query->orWhere("description", "Like", "%".$keyword."%");
        })->when(request()->has("title"), function($query){
            $sortType = request()->title ?? 'asc';
            $query->orderBy('title', $sortType);
        })->latest("id")->paginate(10)->withQueryString();
        return view('welcome', compact('blogs'));
    }

    public function show($id){
        $blog = Blog::findOrFail($id);
        return view('blog_detail', compact('blog'));
    }
}
