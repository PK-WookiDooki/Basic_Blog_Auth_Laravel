@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row d-flex align-items-stretch justify-content-center flex-wrap gap-3">
                    @foreach ($blogs as $blog)
                        <div class="col-12 col-lg-5 shadow">
                            <div class=" card border-0 d-flex h-100">
                                <a href="{{ route('detail', $blog->id) }}"
                                    class="text-decoration-none text-black h-100 d-block">
                                    <div class="card-body d-flex flex-column h-100">

                                        <h4 class="card-title mb-0"> {{ $blog->title }} </h4>
                                        <div class="">
                                            <span class="badge bg-primary">
                                                {{ $blog->category->title ?? 'Unknown' }}</span>
                                            <span class="badge bg-primary">
                                                {{ $blog->created_at->format('d M Y') }}
                                            </span>
                                        </div>

                                        <p class="text-black-50 mt-3"> {{ Str::words($blog->description, 30, '...') }}
                                        </p>
                                        <p class="mt-auto mb-0"> By {{ $blog->user->name }} </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
