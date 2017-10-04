<!DOCTYPE html>
<html>
    <head>
        <title>News Blog - @yield('title')</title>
        @section('styles')
            <link href="/css/app.css" rel="stylesheet">
            <link href="/css/blog.css" rel="stylesheet">
        @show
    </head>
    <body>
        <div class="container">
            @if (Auth::guest())
                <a href="{{ route('login') }}" class="menu-link pull-right">Login</a>
            @else
                <a href="{{ route('home') }}" class="menu-link pull-right">Home</a>
            @endif
            <a href="{{ route('posts.index') }}" class="menu-link pull-right">Main</a>
        </div>
        @yield('content')
    </body>
</html>
