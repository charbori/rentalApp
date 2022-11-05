@extends('layouts.master')

@section('style')
    <link href="/build/assets/home.css" rel="stylesheet">
@stop
@section('contents')
    @if (isset($articles))
        @include('articles.article', compact('articles'))
    @else
        <div class="row featurette" style="margin-top:24px;">
            <div class="col">
                <h2>게시물이 없습니다.</h2>
            </div>
        </div>
    @endif

    {{ $articles->links() }}
    <!-- /END THE FEATURETTES -->
@stop
@section('javascript')
    <script src="/build/assets/js/home.js"></script>
@stop
