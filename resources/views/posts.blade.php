<x-layout>
    @include ('_posts-header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <x-post-featured-card :post="$posts[0]" />
        {{-- *GTK: the :colon will pass thru the value of the variable instead of the string '$post' --}}

        <div class="lg:grid lg:grid-cols-2">
            @foreach ($posts->skip(1) as $post)
            {{-- 'skip' is a collection method. Here skipping the first --}}
                <x-post-card :post="$post" />
            @endforeach
        </div>
    </main>

</x-layout>
