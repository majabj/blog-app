<x-blog-layout>
    @extends('layout')

    @section('content')
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Post
                                <a href="{{ url('posts') }}" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control"
                                           value="{{ old('title', $post->title) }}">
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Content</label>
                                    <textarea name="content" class="form-control" rows="5">{{ old('content', $post->content) }}</textarea>
                                    @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-blog-layout>
