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
            <a href="" class="menu-link pull-right">Login</a>
            <a href="{{ route('posts.index') }}" class="menu-link pull-right">Home</a>
        </div>
        @yield('content')
    </body>
</html>
