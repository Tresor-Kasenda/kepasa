@props([
    'active',
    'href',
    'icons'
])

@php
    $classes = ($active ?? false)
                ? 'nk-menu-item'
                : 'nk-menu-item active current-page';
@endphp

<li {{ $attributes->merge(['class' => $classes]) }}>
    <a href="{{ $href }}" class="nk-menu-link">
        <span class="nk-menu-icon"><em class="icon ni {{ $icons }}"></em></span>
        <span class="nk-menu-text">{{ $slot }}</span>
    </a>
</li>
