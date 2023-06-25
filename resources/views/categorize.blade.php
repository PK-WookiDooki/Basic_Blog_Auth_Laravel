@extends('layouts.master')

@section('content')
    @if (request()->has('keyword') && $category)
        <div class=" alert alert-info d-flex align-items-center justify-content-between ">
            Showing result by search keyword '{{ request()->keyword }}' and category type {{ $category->title }}
            <a href="{{ route('index') }}"> <i class=" bi bi-x h2"></i> </a>
        </div>
    @elseif ($category)
        <div class=" alert alert-info d-flex align-items-center justify-content-between ">
            Showing result by category type '{{ $category->title }}'
            <a href="{{ route('index') }}"> <i class=" bi bi-x h2"></i> </a>
        </div>
    @endif


    @forelse ($blogs as $blog)
        <div class="col-12 shadow-sm mb-3">
            <div class=" card">
                <div class="card-body">

                    <a href="{{ route('detail', $blog->slug) }}" class="text-decoration-none text-black">
                        <h4 class="card-title mb-0"> {{ $blog->title }} </h4>
                    </a>
                    <div class="">
                        <span class="badge bg-dark">
                            {{ $blog->category->title ?? 'Unknown' }}</span>
                        <span class="badge bg-dark">
                            {{ $blog->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <p class="text-black-50 mt-3"> {{ Str::words($blog->description, 30, '...') }}
                    </p>
                    <p class="mt-auto mb-2"> By {{ $blog->user->name }} </p>
                    <a href="{{ route('detail', $blog->slug) }}" class="text-decoration-none btn btn-sm btn-dark">
                        See More
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="card col-12">
            <div class="card-body text-center">
                <h3>There's no blogs for now! Create One?</h3>
                <a href="{{ route('register') }}" class="btn btn-dark"> Try it now </a>
            </div>
        </div>
    @endforelse
    <div class="mt-3">
        {{ $blogs->onEachSide(1)->links() }}
    </div>
@endsection
