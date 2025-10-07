<x-blog-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>
                            View Post
                            <a href="{{ url('posts') }}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        @if($post)
                            <div class="mb-4">
                                <h2>{{ $post->title }}</h2>
                                <p>{{ $post->content }}</p>
                                <p class="text-muted">
                                    <strong>Author:</strong> {{ $post->user->name ?? 'Unknown' }}
                                </p>
                            </div>

                            <h4>Comments:</h4>
                            @forelse($post->comments as $comment)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <p>{{ $comment->comment }}</p>
                                        <small class="text-muted">
                                            By: {{ $comment->user->name ?? 'Anonymous' }}
                                            at {{ $comment->created_at->format('d M Y H:i') }}
                                        </small>

                                        @can('delete', $comment)
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            @empty
                                <p>No comments yet.</p>
                            @endforelse

                            <h5 class="mt-4">Add Comment:</h5>
                            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="comment" class="form-control" rows="3" required>{{ old('comment') }}</textarea>
                                    @error('comment')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Post Comment</button>
                            </form>
                        @else
                            <p>Post not found.</p>
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">
                                ← Back to all posts
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-blog-layout>
