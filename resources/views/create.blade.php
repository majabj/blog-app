@extends('layout')

@section('content')
    <h1>Create a New Post</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="content" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
