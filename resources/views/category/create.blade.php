@extends('layouts.app')


@section('content')
    <div class=" container">
        <h3>Create New Category</h3>
        <hr>
        <form action="{{ route('category.store') }}" method="POST" class="p-3 shadow ">
            @csrf

            <div class="mb-3">
                <label for="title" class=" form-label h5">Category Title</label>
                <input type="text" value="{{ old('title') }}" class=" form-control @error('title') is-invalid @enderror"
                    id="title" name="title">
                @error('title')
                    <div class=" invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>


            <button class="btn btn-primary h5 mb-0">Create Category</button>
        </form>
    </div>
@endsection
