@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Add Posts
                        <a href="{{url('posts')}}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('posts')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control"/>
                                @error('title') <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Content</label>
                                <textarea name="content" class="form-control" rows="3"></textarea>
                                @error('content') <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
