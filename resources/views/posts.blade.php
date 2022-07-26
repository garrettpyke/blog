<x-layout>
    @include ('_posts-header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($posts->count()) {{-- if $posts collection is empty, error would be thrown w/o this --}}
            <x-post-featured-card :post="$posts[0]" />
            {{-- *GTK: the :colon will pass thru the value of the variable instead of the string '$post' --}}

            @if ($posts->count() > 1)
                <div class="lg:grid lg:grid-cols-6">
                    {{-- 'skip' is a collection method. Here skipping the first --}}
                    @foreach ($posts->skip(1) as $post)
                        {{-- !GTN: $loop, available in all loops. Handy debugging tool. --}}
                        {{-- dd($loop) --}}
                        <x-post-card 
                            :post="$post"
                            class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}" 
                        />
                    @endforeach
                </div>
            @endif
        @else
            <p class="text-center">No posts yet. Please check back later.</p>
        @endif
    </main>

</x-layout>
