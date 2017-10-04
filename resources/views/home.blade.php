@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    <div class="container admin-page-header">
        <p class="page-title">Home</p>
    </div>
    <div class="container page-content">
        <div class="row">
            @if(Session::has('message'))
                <div class="alert alert-info">
                    {{Session::get('message')}}
                </div>
            @endif
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>
                            <a href="{{ route('posts.create') }}" class="btn btn-warning">Create post</a>
                            <a href="{{ route('posts.index') }}" class="btn btn-success">Open posts to edit/delete them</a>
                            <a class="btn btn-primary" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
