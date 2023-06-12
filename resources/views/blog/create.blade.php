@extends('layouts.app')


@section('content')
    <div class=" container">
        <h3>Create New Blog</h3>
        <hr>
        <form action="{{ route('blog.store') }}" method="POST" class="p-3 shadow ">
            @csrf

            <div class="mb-3">
                <label for="title" class=" form-label h5">Blog Title</label>
                <input type="text" value="{{ old('title') }}" class=" form-control @error('title') is-invalid @enderror"
                    id="title" name="title">
                @error('title')
                    <div class=" invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class=" form-label h5">Category</label>
                <select name="category" id="category"
                    class="form-control form-select @error('category') is-invalid @enderror">
                    <option value="" selected disabled>Select Category</option>
                    @foreach (App\Models\Category::all() as $category)
                        <option {{ old('category') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                            {{ $category->title }} </option>
                    @endforeach
                </select>
                @error('category')
                    <div class=" invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="Description" class=" form-label h5 ">Description</label>
                <textarea class=" form-control @error('description') is-invalid @enderror" id="Description" rows="7"
                    name="description"> {{ old('description') }} </textarea>
                @error('description')
                    <div class=" invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>

            <button class="btn btn-primary h5 mb-0">Create Blog</button>
        </form>
    </div>
@endsection
