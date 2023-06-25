<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('viewAny', Category::class);
        $categories = Category::latest('id')->paginate(7);
        return view('category.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Category::class);
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // $this->authorize('create', Category::class);
        Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('category.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Gate::authorize('update', $category);
        $this->authorize('update', Category::class);
        // $this->authorize('cat_update', $category);
        return view('category.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Gate::authorize('update', $category);

        //new syntax for using policies ability
        // if($request->user()->cannot('update', $category)){
        //     return abort(403, "Sorry you're not allowed!");
        // }

        //another way
        $this->authorize('update',$category);
        // $this->authorize('cat_update', $category);
        $category->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ]);

        return redirect()->route('category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        // $this->authorize('cat_delete', $category);
        $category->delete();
        return redirect()->back();

    }
}
