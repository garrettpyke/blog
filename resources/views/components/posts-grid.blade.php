@props(['posts'])

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