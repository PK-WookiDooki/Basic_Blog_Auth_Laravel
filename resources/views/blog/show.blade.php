@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-12 col-md-8">
                <div class=" p-4 shadow d-flex flex-column gap-2 align-items-start ">
                    <h3> {{ $blog->title }} </h3>
                    <p class="mb-0 text-black-50 "> {{ $blog->description }} </p>
                    <p><i> By {{ $user->name }} </i></p>
                    <a href="{{ route('blog.index') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
