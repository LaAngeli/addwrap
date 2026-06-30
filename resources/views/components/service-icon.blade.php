@props([
    'name' => 'simple',
])

@php
    $icons = [
        'palette' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h14a2 2 0 012 2v6a2 2 0 01-2 2h-7l-4 4v-4H7z',
        'document-text' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
        'magnifying-glass' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z',
        'megaphone' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z',
        'chart-bar' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
        'code-bracket' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
    ];
    $path = $icons[$name] ?? 'M13 10V3L4 14h7v7l9-11h-7z';
@endphp

<svg {{ $attributes->merge(['class' => 'h-6 w-6']) }} fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="{{ $path }}" />
</svg>
