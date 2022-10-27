@extends('layouts.master')

@section('style')
    <link href="/build/assets/home.css" rel="stylesheet">
@stop
@section('contents')
    @if (isset($articles))
        @include('articles.article', compact('articles'))
    @else
        <div class="row featurette">
            <div class="col">
                <h2>게시글이 없습니다.</h2>
            </div>
        </div>
    @endif
    <!-- /END THE FEATURETTES -->
@stop
