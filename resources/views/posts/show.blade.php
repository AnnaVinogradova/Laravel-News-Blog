@extends('layouts.layout')

@section('title', $post->title)

@section('content')
    <div class="container page-header single-post">
        <p class="page-title">{{ $post->title }}</p>
    </div>
    <div class="container page-content">
        <div class="row">
            <div class="post-title">{{ $post->title }}</div>
            <div class="post-date">Created {{ $post->created_at }} by {{ $post->user->name }}</div>
            <div class="col-xs-12">
                <img src="" alt="">
            </div>
        </div>
        @if(!empty($post->image))
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                    <img src="{{ asset( \App\Http\Services\PostService::IMAGES_PATH . '/' . $post->image) }}" alt="">
                </div>
            </div>
        @endif
        <div class="row single-post-description">
            {!! $post->fullDescription !!}
        </div>
    </div>
@stop
