@extends('layout')

@section('content')
    <h2>Edit Post</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Title:</label><br>
            <input type="text" name="title" value="{{ old('title', $post->title) }}">
        </div>

        <div>
            <label>Content:</label><br>
            <textarea name="content" rows="5">{{ old('content', $post->content) }}</textarea>
        </div>

        <button type="submit">Update</button>
    </form>
@endsection

