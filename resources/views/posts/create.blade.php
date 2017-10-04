@extends('layouts.layout')

@section('title', 'Create post')

@section('content')
    <div class="container admin-page-header">
        <p class="page-title">Create post</p>
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

        {!! Form::open(array('route' => 'posts.store', 'class' => 'form')) !!}

        <div class="form-group">
            {!! Form::label('Post title') !!}
            {!! Form::text('title', null, [
                    'required',
                    'class'=>'form-control',
                    'placeholder'=>'Post title'
                ]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Brief description') !!}
            {!! Form::textarea('description', null, [
                    'class'=>'form-control'
                ]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Full description') !!}
            {!! Form::textarea('fullDescription', null, [
                    'required',
                    'class'=>'form-control'
                ]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop
