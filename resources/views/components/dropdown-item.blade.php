@props(['active' => false])
{{-- by default, this prop is now false --}}

@php
    $classes = 'block text-left px-3 text-sm leading-6 hover:bg-blue-500 hover:text-white focus:bg-blue-300 focus:text-white';

    if ($active) $classes .= ' bg-blue-500 text-white';
@endphp

{{-- attributes method merges automagicaly --}}
<a  {{ $attributes(['class' => $classes]) }}
>{{ $slot }}</a>
