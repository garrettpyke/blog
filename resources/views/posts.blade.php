<x-layout>
        @foreach ($posts as $post)
            <article>
                <h1>
                    <a href="/posts/{{ $post->slug }}">
                        {{ $post->title; }} <!-- //*GTN using Blade shorthand here -->
                    </a>
                </h1>

                <p>
                    <!-- // TODO n+1 problem here - inside a loop accessing a relationship that hasn't yet been loaded (additional SQL query for each item in loop) -->
                    <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
                </p>

                <div>
                   <p>{{ $post->excerpt; }}</p>
                </div>
            </article>
        @endforeach
</x-layout>