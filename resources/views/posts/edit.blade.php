@extends('layouts.layout')

@section('title', 'Edit post')

@section('content')
    <div class="container admin-page-header">
        <p class="page-title">Edit post</p>
    </div>
    <div class="container page-content">
        @if(! $errors->isEmpty())
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <ul class="error-list">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {!! Form::model($post, array('route' => ['posts.update', $post->id], 'class' => 'form', 'enctype' => 'multipart/form-data')) !!}

        <div class="form-group">
            {!! Form::label('Post title') !!}
            {!! Form::text('title', null, [
                    'required',
                    'class'=>'form-control',
                    'placeholder'=>'Post title'
                ]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Brief description (text)') !!}
            {!! Form::textarea('description', null, [
                    'class'=>'form-control'
                ]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Full description (basic HTML)') !!}
            {!! Form::textarea('fullDescription', null, [
                    'required',
                    'class'=>'form-control'
                ]) !!}
        </div>

        <div class="form-group download-file">
            {{Form::file('image')}}
            @if(!empty($post->image))
                <div class="img-preview">
                    <img src="{{ asset( \App\Http\Services\PostService::IMAGES_PATH . '/' . $post->image) }}" alt="">
                </div>
            @endif
        </div>

        <div class="form-group">
            {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop
