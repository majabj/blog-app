@extends('layout')

@section('content')
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Posts</h4>
                @auth
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
                @endauth
            </div>

            <div class="card-body">
                @if($posts->count())
                    @foreach($posts as $post)
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h2 class="card-title">
                                    <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                <p class="card-text mt-2">{{ Str::limit($post->content, 200) }}</p>
                                <small class="text-muted d-block mb-3">
                                    Author: {{ $post->user->name ?? 'Unknown' }} |
                                    Created at: {{ $post->created_at->format('d M Y H:i') }}
                                </small>

                                @can('update', $post)
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success btn-sm">Edit</a>
                                @endcan

                                @can('delete', $post)
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No posts found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

