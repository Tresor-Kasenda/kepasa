@props([
    $name,
    $route
])

<li>
    <a
            class="{{ Request::url() === route($route) ? 'current' : '' }}"
            href="{{ $route }}"
    >{{ $name }}</a>
</li>
