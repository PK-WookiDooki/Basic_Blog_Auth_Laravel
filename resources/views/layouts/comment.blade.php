<div class="mt-3">
    <h4 class="mb-3">Comment & Reply</h4>
    <div class="mb-3">

        {{-- getting pure comment, which are not reply --}}
        @forelse ($blog->comments()->whereNull('parent_id')->latest('id')->get() as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <div class=" d-flex gap-2 align-items-center mb-2">
                        <i class=" bi bi-chat-square-text-fill"></i>
                        <p class="mb-0"> {{ $comment->content }} </p>
                    </div>
                    <div class="">
                        <span class="mb-0 badge bg-dark"> <i class=" bi bi-person-fill me-1"></i>
                            {{ $comment->user->name }}
                        </span>
                        <span class="mb-0 badge bg-dark"> <i class=" bi bi-clock-full me-1"></i>
                            {{ $comment->created_at->diffforHumans() }}
                        </span>

                        @can('delete', $comment)
                            <form action="{{ route('comment.destroy', $comment->id) }}" method="post"
                                class=" d-inline-block">
                                @csrf
                                @method('delete')
                                <button class=" badge bg-danger border-0">
                                    <i class=" bi bi-trash3-fill me-1"></i> Delete
                                </button>
                            </form>
                        @endcan

                        {{-- reply form --}}
                        @auth
                            <button class=" reply_btn badge bg-success border-0 ">
                                <i class=" bi bi-reply me-1"></i> Reply
                            </button>
                            <div class=" ms-4  mt-2 d-none">
                                <div class="">
                                    <form action="{{ route('comment.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                        <textarea name="content" rows="2" placeholder="Reply to {{ $blog->user->name }}'s comment..."
                                            class="form-control mb-3"></textarea>
                                        <div
                                            class="d-flex
                        align-items-center justify-content-between">
                                            <p class="mb-0"> Replying as {{ Auth::user()->name }} </p>
                                            <button class="btn btn-dark btn-sm">Reply</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endauth


                        {{-- looping replies --}}

                        @foreach ($comment->replies()->latest('id')->get() as $reply)
                            <div class="card ms-4 mt-2">
                                <div class="card-body">
                                    <div class=" d-flex gap-2 align-items-center mb-2">
                                        <i class=" bi bi-chat-square-text-fill"></i>
                                        <p class="mb-0"> {{ $reply->content }} </p>
                                    </div>
                                    <div class="">
                                        <span class="mb-0 badge bg-dark"> <i class=" bi bi-person-fill me-1"></i>
                                            {{ $reply->user->name }}
                                        </span>
                                        <span class="mb-0 badge bg-dark"> <i class=" bi bi-clock-full me-1"></i>
                                            {{ $reply->created_at->diffforHumans() }}
                                        </span>

                                        @can('delete', $reply)
                                            <form action="{{ route('comment.destroy', $reply->id) }}" method="post"
                                                class=" d-inline-block">
                                                @csrf
                                                @method('delete')
                                                <button class=" badge bg-danger border-0">
                                                    <i class=" bi bi-trash3-fill me-1"></i> Delete
                                                </button>
                                            </form>
                                        @endcan

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body">
                    <p class="mb-0"> There is no comments for now!</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- comment form --}}
    @auth
        <div class=" ">
            <div class="card-body">
                <form action="{{ route('comment.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                    <textarea name="content" rows="3" placeholder="Say something about this blog . . ." class="form-control mb-3"></textarea>
                    <div class="d-flex
                        align-items-center justify-content-between">
                        <p class="mb-0"> Commenting as {{ Auth::user()->name }} </p>
                        <button class="btn btn-dark btn-sm">Comment</button>
                    </div>
                </form>
            </div>
        </div>
    @endauth
</div>

@vite('resources/js/reply.js')
