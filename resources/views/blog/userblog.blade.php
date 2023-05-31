@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Your Blog List</h3>
                <hr>
                <div class="mb-3">
                    <a href="{{ route('blog.create') }}" class="btn btn-outline-dark">Create New blog</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Title </th>
                            <th> Controls </th>
                            <th> Created At</th>
                            <th> Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogs as $blog)
                            <tr>
                                <td class=" align-middle">{{ $blog->id }}</td>
                                <td class=" align-middle">{{ $blog->title }} <br>
                                    <p class=" small text-black-50 mb-0"> {{ Str::limit($blog->description, 30, '...') }}
                                    </p>
                                </td>

                                <td class=" align-middle">
                                    <div class="d-flex flex-column flex-md-row align-items-center gap-1">
                                        <a class=" btn btn-sm btn-outline-dark rounded-0"
                                            href="{{ route('blog.show', $blog->id) }}">
                                            <i class="bi bi-info"></i>
                                        </a>

                                        <a href="{{ route('blog.edit', $blog->id) }}"
                                            class="btn btn-sm btn-outline-dark rounded-0">
                                            <i class="bi bi-pencil"></i></a>
                                        <button form="blogDeleteForm{{ $blog->id }}"
                                            class=" btn btn-sm btn-outline-dark rounded-0">
                                            <i class=" bi bi-trash3"></i>
                                        </button>
                                    </div>
                                    <form id="blogDeleteForm{{ $blog->id }}" class=" d-inline-block"
                                        action="{{ route('blog.destroy', $blog->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                    </form>

                                </td>

                                <td class=" align-middle">
                                    <p class=" small mb-0"> <i class=" bi bi-clock"></i>
                                        {{ $blog->created_at->format('h:i a') }} </p>
                                    <p class=" small mb-0"> <i class=" bi bi-calendar"></i>
                                        {{ $blog->created_at->format('d M Y') }} </p>
                                </td>
                                <td class=" align-middle">
                                    <p class=" small mb-0"> <i class=" bi bi-clock"></i>
                                        {{ $blog->updated_at->format('h:i a') }} </p>
                                    <p class=" small mb-0"> <i class=" bi bi-calendar"></i>
                                        {{ $blog->updated_at->format('d M Y') }} </p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class=" text-center">
                                    <p>
                                        There is no record
                                    </p>
                                    <a class=" btn btn-sm btn-primary" href="{{ route('blog.create') }}">Create Item</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
