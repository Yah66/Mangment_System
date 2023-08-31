@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    Posts
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Post
@endsection
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-6">
        <!-- Create Post Form -->
        <form action="{{ route('posts.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" id="body" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <!-- Display Posts with Comments -->
        @foreach ($posts as $post)
            <div class="card mb-4">
                <div class="card-header">
                    {{ $post->title }}
                    @if ($post->user_id == auth()->id())
                        <span class="badge badge-success ml-2">Your Post</span>
                    @endif
                </div>
                <div class="card-body">
                    {{ $post->body }}
                </div>
                <div class="card-footer">
                    @if ($post->user_id == auth()->id())
                        <span class="badge badge-success">Your Post</span>
                    @endif
                    <h5>Comments</h5>
                    <ul class="list-group">
                        @foreach ($post->comments as $comment)
                            <li class="list-group-item">
                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                            </li>
                        @endforeach
                    </ul>
                    <form action="{{ route('comments.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="form-group mt-2">
                            <label for="comment">Add Comment</label>
                            <textarea name="comment" id="comment" class="form-control" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Add Comment</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
