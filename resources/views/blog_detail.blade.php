@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-12 col-md-8">
                <div class=" p-4 shadow d-flex flex-column gap-2 align-items-start ">
                    <div class="d-flex flex-row align-items-center gap-2">
                        <h3 class="mb-0"> {{ $blog->title }} </h3>
                        <span class=" badge bg-primary"> {{ $blog->category_id }} </span>
                    </div>
                    <p class="mb-0 text-black-50 "> {{ $blog->description }} </p>
                    <p><i> By {{ $blog->user->name }} </i></p>
                    <a href="{{ route('index') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
