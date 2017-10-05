@extends('layouts.layout')

@section('title', 'Edit post')

@section('content')
    <div class="container admin-page-header">
        <p class="page-title">Delete post</p>
    </div>
    <div class="container page-content delete-form">

        <p>Are you sure you want to delete this post?</p>

        {!! Form::open([
            'method' => 'DELETE',
            'route' => ['posts.destroy', $post->id]
        ]) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}

        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default">Cancel</a>
    </div>
@stop
