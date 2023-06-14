<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::when(request()->has('keyword'), function($query){
            $keyword = request()->keyword;
            $query->where('title', "Like", "%".$keyword."%");
            $query->orWhere("description", "Like", "%".$keyword."%");
        })->when(Auth::user()->role !== "admin", fn($query) => $query->where('user_id', Auth::id()))->when(request()->has("title"), function($query){
            $sortType = request()->title ?? 'asc';
            $query->orderBy('title', $sortType);
        })->latest("id")->paginate(7)->withQueryString();
        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("blog.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        // return($request);

        $blog = Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
            'user_id' => Auth::id()
        ]);
        return redirect()->route('blog.index')->with(['message' => "Blog title (". $blog->title . ") has been created successfully!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        // $user = User::where('id', $blog->user_id)->first();
        return view("blog.show", ['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //Gate::authorize('blog_update', $blog); //not compatible when developing apis
        $this->authorize('update', $blog);
        return view("blog.edit", compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        // //using allows method
        // if(!Gate::allows('blog_update', $blog)){
        //     return abort(401);
        // }

        // if(Gate::denies('blog_update', $blog)){
        //     return abort(403, "You're not allow to modify this blog!");
        // }

        //Gate::authorize('blog_update', $blog); //not compatible when developing apis

        $this->authorize('update', $blog); // using policies
        $blog->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
        ]);
        return redirect()->route('blog.index')->with(['message' => "Your blog has been updated successfully!"] );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //Gate::authorize('blog_delete', $blog);
        $this->authorize('delete', $blog); // using policies
        $blog->delete();
        return redirect()->back()->with(['message' => "Your blog has been deleted successfully!"]);
    }
}
