@extends('layouts.layout')

@section('title', 'Posts')

@section('content')
    <div class="container page-header">
        <p class="page-title">Posts</p>
    </div>
    <div class="container page-content">
        @foreach ($posts as $post)
            <div class="row post-in-list">
                <div class="col-xs-12 post-title">
                    <a href="{{ route('posts.show', $post->id) }}">
                        {{ $post->title }}
                    </a>
                </div>
                <div class="col-xs-12 post-date">Created {{ $post->created_at }} by {{ $post->user->name }}</div>
                @if (!Auth::guest())
                    <div class="btn-group pull-right" role="group">
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('posts.delete', $post->id) }}" class="btn btn-danger">Delete</a>
                    </div>
                @endif
                <div class="col-xs-12">
                    @if(!empty($post->image))
                        <div class="col-md-4">
                            <img src="{{ asset( \App\Http\Services\PostService::IMAGES_PATH . '/' . $post->image) }}" alt="">
                        </div>
                        <div class="col-md-8">{{ $post->description }}</div>
                    @else
                        {{ $post->description }}
                    @endif
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    </div>
@stop
