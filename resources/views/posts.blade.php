<x-layout>
    @foreach ($posts as $post)
    <article>
        <h1>
            <a href="/posts/{{ $post->slug }}">
                {{ $post->title; }} <!-- //*GTN using Blade shorthand here -->
            </a>
        </h1>

        <p>
            By <a href="/authors/{{ $post->author->user_name }}">{{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
        </p>

        <p>
            <!-- //*GTK: n+1 problem here - inside a loop accessing a relationship that hasn't yet been loaded (additional SQL query for each item in loop). Resolved in route using `with` method -->
            <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
        </p>

        <div>
            <p>{{ $post->excerpt; }}</p>
        </div>
    </article>
    @endforeach
</x-layout>