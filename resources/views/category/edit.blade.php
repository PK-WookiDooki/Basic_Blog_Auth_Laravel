@extends('layouts.app')


@section('content')
    <div class=" container">
        <h3>Edit Category</h3>
        <hr>
        <form action="{{ route('category.update', $category->id) }}" method="POST" class="p-3 shadow ">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class=" form-label h5">Category Title</label>
                <input type="text" value="{{ old('title', $category->title) }}"
                    class=" form-control @error('title') is-invalid @enderror" id="title" name="title">
                @error('title')
                    <div class=" invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>

            <a href="{{ route('category.index') }}" class="btn btn-dark">Back</a>
            <button class="btn btn-primary h5 mb-0">Save Changes</button>
        </form>
    </div>
@endsection
