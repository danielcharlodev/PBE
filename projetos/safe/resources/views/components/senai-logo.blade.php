@props([
    'size' => 'md',
])

@php
    $heights = [
        'xs' => 18,
        'sm' => 24,
        'md' => 34,
        'lg' => 42,
        'xl' => 56,
    ];
    $height = $heights[$size] ?? $heights['md'];
@endphp

<img
    src="{{ \App\Support\SenaiBrand::logoUrl() }}"
    alt="SENAI"
    height="{{ $height }}"
    {{ $attributes->class(['senai-logo-img']) }}
>
