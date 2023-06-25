@extends('layouts.master')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-body shadow-sm">
                <h3 class="mb-0 mb-1"> {{ $blog->title }} </h3>
                <div class="mb-3">
                    <span class="badge bg-dark">
                        {{ $blog->category->title ?? 'Unknown' }}</span>
                    <span class="badge bg-dark">
                        {{ $blog->created_at->format('d M Y') }}
                    </span>
                </div>
                <p class="mb-0 text-black-50 mb-3"> {{ $blog->description }} </p>
                <p class="mb-0 mb-3"><i> By {{ $blog->user->name }} </i></p>
                <a href="{{ route('index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>

        @include('layouts.comment')
    </div>
@endsection
