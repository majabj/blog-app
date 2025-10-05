@extends('layout')

@section('content')
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-danger">
                {{ session('success') }}
            </div>
        @endif


        @if($post)
            <!-- Post -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->content }}</p>
                    <p class="text-muted"><strong>Author:</strong> {{ $post->user->name ?? 'Unknown' }}</p>
                </div>
            </div>

            <!-- Comments -->
            <h4>Comments:</h4>

            @forelse($post->comments as $comment)
                <div class="card mb-2">
                    <div class="card-body">
                        <p>{{ $comment->comment }}</p>
                        <small class="text-muted">
                            By: {{ $comment->user->name ?? 'Anonymous' }}
                            at {{ $comment->created_at->format('d M Y H:i') }}
                        </small>
                    </div>
                </div>
            @empty
                <p>No comments yet.</p>
            @endforelse

            <!-- Back link -->
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
@endsection

