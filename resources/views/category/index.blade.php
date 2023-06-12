@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
            <div class=" alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <h3>Category List</h3>
                <hr>
                <div class="mb-3">
                    <a href="{{ route('category.create') }}" class="btn btn-outline-dark">Create New Category</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Title </th>
                            <th> Owner ID</th>
                            <th> Controls </th>
                            <th> Created At</th>
                            <th> Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td class=" align-middle">{{ $category->id }}</td>
                                <td class=" align-middle">{{ $category->title }} <br>
                                    <p class=" small text-black-50 mb-0">
                                        {{ Str::limit($category->description, 30, '...') }}
                                    </p>
                                </td>


                                <td class=" align-middle"> {{ $category->user_id }} </td>
                                <td class=" align-middle">
                                    <div class="d-flex flex-column flex-md-row align-items-center gap-1">
                                        {{-- <a class=" btn btn-sm btn-outline-dark rounded-0"
                                            href="{{ route('category.show', $category->id) }}">
                                            <i class="bi bi-info"></i>
                                        </a> --}}
                                        @if ($category->user_id == Auth::id())
                                            <a href="{{ route('category.edit', $category->id) }}"
                                                class="btn btn-sm btn-outline-dark rounded-0">
                                                <i class="bi bi-pencil"></i></a>
                                            <button form="CategoryDeleteForm{{ $category->id }}"
                                                class=" btn btn-sm btn-outline-dark rounded-0">
                                                <i class=" bi bi-trash3"></i>
                                            </button>
                                    </div>
                                    <form id="CategoryDeleteForm{{ $category->id }}" class=" d-inline-block"
                                        action="{{ route('category.destroy', $category->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                    </form>
                        @endif
                        </td>

                        <td class=" align-middle">
                            <p class=" small mb-0"> <i class=" bi bi-clock"></i>
                                {{ $category->created_at->format('h:i a') }} </p>
                            <p class=" small mb-0"> <i class=" bi bi-calendar"></i>
                                {{ $category->created_at->format('d M Y') }} </p>
                        </td>
                        <td class=" align-middle">
                            <p class=" small mb-0"> <i class=" bi bi-clock"></i>
                                {{ $category->updated_at->format('h:i a') }} </p>
                            <p class=" small mb-0"> <i class=" bi bi-calendar"></i>
                                {{ $category->updated_at->format('d M Y') }} </p>
                        </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class=" text-center">
                                <p>
                                    There is no record
                                </p>
                                <a class=" btn btn-sm btn-primary" href="{{ route('category.create') }}">Create One</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $categories->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
