<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.84.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Rental your product</title>

        <!-- Bootstrap core CSS -->
        <link href="/build/assets/bootstrap.css" rel="stylesheet">
        <link href="/build/assets/app.scss" rel="stylesheet">
        <link href="/build/assets/master.css" rel="stylesheet">
        <link href="/build/assets/fontawesome-6.2.0/css/all.css" rel="stylesheet">
        <link href="/build/assets/fontawesome-6.2.0/css/fontawesome.css" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@1.2.0/dist/tailwind.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        @yield('style')
        <script src="/build/assets/js/jquery-3.6.1.min.js"></script>
        <script src="/build/assets/js/jquery-ui.js"></script>
        <script src="/build/assets/js/popper.js"></script>
    </head>
    <body>
        @if (getMobile())
            @include('navigations.masternav_mo')
        @else
            @include('navigations.masternav')
        @endif
        @include('flash::message')
        @if (trim(Request::path()) === 'home')
            @include('layouts.main')
        @else
            @yield('contents')
        @endif
        <script src="/build/assets/bootstrap.js"></script>
        @yield('javascript')
    </body>
</html>
