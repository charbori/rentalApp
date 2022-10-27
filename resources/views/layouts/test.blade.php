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
    <div class="bd-cheatsheet container-fluid bg-body">
    <section id="content">
        <h2 class="sticky-xl-top fw-bold pt-3 pt-xl-5 pb-2 pb-xl-3">Contents</h2>

        <article class="my-3" id="typography">
        <div class="bd-heading sticky-xl-top align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
            <h3>Typography</h3>
            <a class="d-flex align-items-center" href="../content/typography/">Documentation</a>
        </div>

        <div>
            <div class="bd-example">
            <p class="display-1">Display 1</p>
            <p class="display-2">Display 2</p>
            <p class="display-3">Display 3</p>
            <p class="display-4">Display 4</p>
            <p class="display-5">Display 5</p>
            <p class="display-6">Display 6</p>
            </div>

            <div class="bd-example">
            <p class="h1">Heading 1</p>
            <p class="h2">Heading 2</p>
            <p class="h3">Heading 3</p>
            <p class="h4">Heading 4</p>
            <p class="h5">Heading 5</p>
            <p class="h6">Heading 6</p>
            </div>

            <div class="bd-example">
            <p class="lead">
            This is a lead paragraph. It stands out from regular paragraphs.
            </p>
            </div>

            <div class="bd-example">
            <p>You can use the mark tag to <mark>highlight</mark> text.</p>
            <p><del>This line of text is meant to be treated as deleted text.</del></p>
            <p><s>This line of text is meant to be treated as no longer accurate.</s></p>
            <p><ins>This line of text is meant to be treated as an addition to the document.</ins></p>
            <p><u>This line of text will render as underlined.</u></p>
            <p><small>This line of text is meant to be treated as fine print.</small></p>
            <p><strong>This line rendered as bold text.</strong></p>
            <p><em>This line rendered as italicized text.</em></p>
            </div>

            <div class="bd-example">
            <blockquote class="blockquote">
            <p>A well-known quote, contained in a blockquote element.</p>
            <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
            </blockquote>
            </div>

            <div class="bd-example">
            <ul class="list-unstyled">
            <li>This is a list.</li>
            <li>It appears completely unstyled.</li>
            <li>Structurally, it's still a list.</li>
            <li>However, this style only applies to immediate child elements.</li>
            <li>Nested lists:
                <ul>
                <li>are unaffected by this style</li>
                <li>will still show a bullet</li>
                <li>and have appropriate left margin</li>
                </ul>
            </li>
            <li>This may still come in handy in some situations.</li>
            </ul>
            </div>

            <div class="bd-example">
            <ul class="list-inline">
            <li class="list-inline-item">This is a list item.</li>
            <li class="list-inline-item">And another one.</li>
            <li class="list-inline-item">But they're displayed inline.</li>
            </ul>
            </div>
        </div>
        </article>
        <article class="my-3" id="images">
        <div class="bd-heading sticky-xl-top align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
            <h3>Images</h3>
            <a class="d-flex align-items-center" href="../content/images/">Documentation</a>
        </div>

        <div>
            <div class="bd-example">
            <svg class="bd-placeholder-img bd-placeholder-img-lg img-fluid" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Responsive image" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Responsive image</text></svg>

            </div>

            <div class="bd-example">
            <svg class="bd-placeholder-img img-thumbnail" width="200" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera: 200x200" preserveAspectRatio="xMidYMid slice" focusable="false"><title>A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">200x200</text></svg>

            </div>
        </div>
        </article>
    </section>
    </div>
@stop
@section('javascript')
    <script src="/build/assets/js/cheatsheet.js"></script>
@stop
