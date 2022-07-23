<x-layout>
        @foreach ($posts as $post)
            <article>
                <h1>
                    <a href="/posts/{{ $post->slug }}">
                        {{ $post->title; }} <!-- //*GTN using Blade shorthand here -->
                    </a>
                </h1>

                <p>
                    <a href="#">{{ $post->category->name }}</a>
                </p>

                <div>
                    {{ $post->excerpt; }}
                </div>
            </article>
        @endforeach
</x-layout>