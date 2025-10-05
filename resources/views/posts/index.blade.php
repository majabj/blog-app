@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Posts
                        <a href="{{url('posts/create')}}" class="btn btn-primary float-end">Add Post</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if($posts && $posts->count())
                        @foreach($posts as $post)
                            <div class="post">
                            <h2>
                                <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                            </h2>
                            <p>{{ $post->content }}</p>
                            <small>Author: {{ $post->user->name ?? 'Unknown' }}</small>
                                @if(auth()->check() && auth()->id() === $post->user_id)
                                    <div class="d-flex gap-2 mt-3">
                                        <a href="{{ url('posts/'.$post->id.'/edit') }}" class="btn btn-success">Edit</a>

                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                @endif
                        @endforeach
                    @else
                        <p>No posts found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



