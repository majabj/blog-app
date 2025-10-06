@extends('layout')

@section('content')
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>
                    <a href="{{ url('posts') }}" class="btn btn-primary float-end">Back</a>
                </h4>
            </div>

            @if($post)
                <div class="card mb-4">
                    <div class="card-body">
                        <h2>{{ $post->title }}</h2>
                        <p>{{ $post->content }}</p>
                        <p class="text-muted"><strong>Author:</strong> {{ $post->user->name ?? 'Unknown' }}</p>
                    </div>
                </div>

                <h4>Comments:</h4>
                @forelse($post->comments as $comment)
                    <div class="card mb-2">
                        <div class="card-body">
                            <p>{{ $comment->comment }}</p>
                            <small class="text-muted">
                                By: {{ $comment->user->name ?? 'Anonymous' }}
                                at {{ $comment->created_at->format('d M Y H:i') }}
                            </small>

                            @can('delete', $comment)
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
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
                    <textarea name="comment" class="form-control mb-2" rows="3" required>{{ old('comment') }}</textarea>
                    @error('comment')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>

                <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">
                    ← Back to all posts
                </a>

            @else
                <p>Post not found.</p>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">
                    ← Back to all posts
                </a>
            @endif
        </div>
    </div>
@endsection
