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

        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">
        <!-- Bootstrap core CSS -->
        <link href="/build/assets/bootstrap.css" rel="stylesheet">
        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }

        .top-guide {
            padding-top: 24px;
        }
        </style>
        <!-- Custom styles for this template -->
        @yield('style')
    </head>
    <body>
        @include('navigations.masternav')
        @include('flash::message')
        @if (trim(Request::path()) === 'home')
            @include('layouts.main')
        @else
            @yield('contents')
        @endif
        <script src="/build/assets/bootstrap.min.js"></script>
        @yield('javascript')
    </body>
</html>
