@extends('layouts.master')
@section('style')
    <link href="/build/assets/css/cheatsheet.css" rel="stylesheet">
@stop
@section('contents')
    <aside class="bd-aside sticky-xl-top text-muted align-self-start mb-3 mb-xl-5 px-2">
        <h2 class="h6 pt-4 pb-3 mb-4 border-bottom">On this page</h2>
        <nav class="small" id="toc">
            <ul class="list-unstyled">
                <li class="my-2">
                    <button class="btn d-inline-flex align-items-center collapsed" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#contents-collapse" aria-controls="contents-collapse">Contents</button>
                    <ul class="list-unstyled ps-3 collapse" id="contents-collapse">
                        <li><a class="d-inline-flex align-items-center rounded" href="#typography">Typography</a></li>
                        <li><a class="d-inline-flex align-items-center rounded" href="#images">Images</a></li>
                        <li><a class="d-inline-flex align-items-center rounded" href="#tables">Tables</a></li>
                        <li><a class="d-inline-flex align-items-center rounded" href="#figures">Figures</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
    <div>
        @if (false == empty($path_datas))
            @foreach ($path_datas as $item)
                <img src='{{ $item }}'>
            @endforeach
        @endif
    </div>
    <div class="bd-cheatsheet container-fluid bg-body">
        <section id="content">
            <h2 class="sticky-xl-top fw-bold pt-3 pt-xl-5 pb-2 pb-xl-3">{{ $article->title }}</h2>

            <article class="my-3" id="typography">
                <!--
                <div class="bd-heading sticky-xl-top align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                    <h3>Typography</h3>
                    <a class="d-flex align-items-center" href="../content/typography/">Documentation</a>
                </div>
                -->
                <div>
                    <div class="bd-example">
                        <ul class="list-inline">
                            <li class="list-inline-item">{{ $article->content }}</li>
                        </ul>
                    </div>
                </div>
            </article>
        </section>
    </div>
@stop
@section('javascript')
    <script src="/build/assets/js/cheatsheet.js"></script>
@stop
