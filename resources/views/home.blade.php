@extends('layouts.master')

@section('contents')
    @if (isset($articles))
        @include('articles.article', compact('articles'))
    @else
        <div class="row featurette">
            <div class="col">
                <h2>�Խñ��� �����ϴ�.</h2>
            </div>
        </div>
    @endif
    <!-- /END THE FEATURETTES -->
@stop
