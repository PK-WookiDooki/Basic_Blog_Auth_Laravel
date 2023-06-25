<div class=" position-sticky" style="top: 75px;">
    <div class="search-form mb-4">
        <h5>Search Blog</h5>
        <form action="">
            <div class="input-group">
                <input type="text" class=" form-control" name="keyword" value="{{ request()->keyword }}">
                <button class=" input-group-text btn btn-dark">
                    <i class=" bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>
    <div class=" categories mb-4">
        <h5>Blog Categories</h5>
        <div class=" list-group">
            <a href="{{ route('index') }}" class=" list-group-item list-group-item-action"> See All </a>
            @foreach (App\Models\Category::all() as $category)
                <a href="{{ route('categorize', $category->slug) }}" class=" list-group-item list-group-item-action">
                    {{ $category->title }} </a>
            @endforeach
        </div>
    </div>

    <div class=" recent-blogs mb-4">
        <h5>Recent Blogs</h5>
        <div class=" list-group">
            @foreach (App\Models\Blog::latest('id')->limit(5)->get() as $blog)
                <a href="{{ route('detail', $blog->slug) }}" class=" list-group-item list-group-item-action">
                    {{ $blog->title }} </a>
            @endforeach
        </div>
    </div>

</div>
