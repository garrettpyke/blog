<!doctype html>

<head>
    <title>My Blog</title>
    <link rel="stylesheet" href="/app.css">
</head>

<body>
    @foreach ($posts as $post)
        
    <article>
        <h1>
            <a href="/posts/{{ $post->slug }}">
                {{ $post->title; }} <!-- //*GTN using Blade shorthand now -->
            </a>
        </h1>
        <div>
            {{ $post->excerpt; }}
        </div>
    </article>

    @endforeach
</body>         