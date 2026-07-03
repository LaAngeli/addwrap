@props([
    'icon' => 'aw',
    'beam' => true,
    'spin' => false,
])

@php
    /*
    | Emblem circular comun tuturor paginilor de eroare: ramă de radar (grilă +
    | inele), fascicul portocaliu rotativ opțional, puls central și o pictogramă
    | tematică. Pictograma poate fi marca AW (404) sau una dintre pictogramele
    | stroke de mai jos; opțional se rotește (ex: roata dințată — 503).
    | Pictograma se dimensionează procentual, deci scalează identic atât în
    | varianta inline (404/403/500/503) cât și în cea stivuită (419/429).
    */
    $strokeIcons = [
        'lock' => 'M8 10V7a4 4 0 118 0v3M6.5 10h11a.5.5 0 01.5.5v8a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-8a.5.5 0 01.5-.5z',
        'clock' => 'M12 8v4l3 2M12 3a9 9 0 100 18 9 9 0 000-18z',
        'gauge' => 'M4.6 16.5a8 8 0 1114.8 0M12 14l4-3.2',
        'warning' => 'M12 10v3.5M12 17h.01M10.4 4.2 3 16.6A1.6 1.6 0 004.4 19h15.2a1.6 1.6 0 001.4-2.4L13.6 4.2a1.6 1.6 0 00-3.2 0z',
        'gear' => 'M19.4 13a1.6 1.6 0 00.3 1.8l.1.1a2 2 0 11-2.8 2.8l-.1-.1a1.6 1.6 0 00-1.8-.3 1.6 1.6 0 00-1 1.5V21a2 2 0 11-4 0v-.1a1.6 1.6 0 00-1-1.5 1.6 1.6 0 00-1.8.3l-.1.1a2 2 0 11-2.8-2.8l.1-.1a1.6 1.6 0 00.3-1.8 1.6 1.6 0 00-1.5-1H3a2 2 0 110-4h.1a1.6 1.6 0 001.5-1 1.6 1.6 0 00-.3-1.8l-.1-.1a2 2 0 112.8-2.8l.1.1a1.6 1.6 0 001.8.3 1.6 1.6 0 001-1.5V3a2 2 0 114 0v.1a1.6 1.6 0 001 1.5 1.6 1.6 0 001.8-.3l.1-.1a2 2 0 112.8 2.8l-.1.1a1.6 1.6 0 00-.3 1.8V9a1.6 1.6 0 001.5 1H21a2 2 0 110 4h-.1a1.6 1.6 0 00-1.5 1z',
    ];

    $strokeInner = [
        'gear' => 'M9.5 12a2.5 2.5 0 105 0 2.5 2.5 0 00-5 0z',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'aw-radar h-full w-full']) }} aria-hidden="true">
    <span class="aw-radar-grid"></span>

    @if ($beam)
        <span class="aw-radar-sweep"></span>
    @endif

    <span class="aw-pulse pointer-events-none absolute left-1/2 top-1/2 h-1/2 w-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full bg-orange/25"></span>

    <span class="absolute left-1/2 top-1/2 flex h-[46%] w-[46%] -translate-x-1/2 -translate-y-1/2 items-center justify-center {{ $spin ? 'aw-radar-spin' : '' }}">
        @if ($icon === 'aw')
            <x-brand-mark class="h-auto w-full text-orange" />
        @else
            <svg fill="none" stroke="#f26c00" stroke-width="1.7" viewBox="0 0 24 24" class="h-full w-full" focusable="false">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $strokeIcons[$icon] ?? $strokeIcons['warning'] }}" />
                @isset($strokeInner[$icon])
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $strokeInner[$icon] }}" />
                @endisset
            </svg>
        @endif
    </span>
</span>
