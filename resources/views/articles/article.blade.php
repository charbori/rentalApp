@foreach ($articles as $article)
    <div class="row featurette">
        <div class="col-4 col-md-5">
            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="100" height="100" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
        </div>
        <div class="col-8 col-md-7">
            <h3 class="home-title">{{ $article->title }}</h3>
            <span class="home-content">{{ $article->content }}</span>
            <span class="home-name">{{ $article->user->name }}</span><span class="home-date">{{ $article->created_at }}</span>
        </div>
    </div>
    <hr>
@endforeach
