@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>User List</h3>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Profile </th>
                            {{-- <th> Controls </th> --}}
                            <th> Created At</th>
                            <th> Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <h6 class="mb-0"> {{ $user->name }} @if ($user->id == Auth::user()->id)
                                            <span class=" badge bg-primary ms-2">You</span>
                                        @endif
                                    </h6>
                                    <p class=" small text-black-50 mb-0"> {{ Str::limit($user->email, 30, '...') }}</p>
                                </td>

                                {{-- <td>
                                    <div class=" btn-group ">
                                        <a class=" btn btn-sm btn-outline-dark" href="{{ route('blog.show', $blog->id) }}">
                                            <i class="bi bi-info"></i>
                                        </a>
                                        <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-outline-dark">
                                            <i class="bi bi-pencil"></i></a>
                                        <button form="blogDeleteForm{{ $blog->id }}"
                                            class=" btn btn-sm btn-outline-dark">
                                            <i class=" bi bi-trash3"></i>
                                        </button>
                                    </div>
                                    <form id="blogDeleteForm{{ $blog->id }}" class=" d-inline-block"
                                        action="{{ route('blog.destroy', $blog->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                    </form>
                                </td> --}}
                                <td>
                                    <p class=" small mb-0"> <i class=" bi bi-clock"></i>
                                        {{ $user->created_at->format('h:i a') }} </p>
                                    <p class=" small mb-0"> <i class=" bi bi-calendar"></i>
                                        {{ $user->created_at->format('d M Y') }} </p>
                                </td>
                                <td>
                                    <p class=" small mb-0"> <i class=" bi bi-clock"></i>
                                        {{ $user->updated_at->format('h:i a') }} </p>
                                    <p class=" small mb-0"> <i class=" bi bi-calendar"></i>
                                        {{ $user->updated_at->format('d M Y') }} </p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class=" text-center">
                                    <p>
                                        There is no record
                                    </p>
                                    <a class=" btn btn-sm btn-primary" href="{{ route('user.create') }}">Create Item</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
