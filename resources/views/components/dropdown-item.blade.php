@props(['active' => false])

@php
    $classes = 'block text-left px-3 text-sm leading-6 hover:bg-purple-500 focus:bg-purple-500 hover:text-white focus:text-white';

    if ($active) $classes .= ' bg-purple-300';
@endphp

<a {{ $attributes(['class' => $classes]) }}
>{{ $slot }}</a>
