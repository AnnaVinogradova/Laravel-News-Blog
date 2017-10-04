@extends('layouts.layout')

@section('title', 'Page Title')

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
                <div class="col-xs-12 post-date">Created {{ $post->created_at }} by</div>
                <div class="col-xs-12">
                    <div class="col-md-4">
                        <img src="" alt="">
                    </div>
                    <div class="col-md-8">{{ $post->description }}</div>
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    </div>
@stop
