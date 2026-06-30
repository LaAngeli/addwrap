@props([
    'title' => null,
])

@php
    /*
    | Logo-uri partener procesate la o singură înălțime (sursă 240px),
    | monocrom negru pe transparent. Ordinea alternează lățimi pentru un
    | flux vizual echilibrat în bandă.
    */
    $partners = [
        ['slug' => 'domio',                     'name' => 'DOMIO',                       'w' => 584],
        ['slug' => 'cleaning-pasca',            'name' => 'Cleaning Pasca',              'w' => 227],
        ['slug' => 'caad-engineering',          'name' => 'CAAD Engineering',            'w' => 660],
        ['slug' => 'synaptica',                 'name' => 'Synaptica Cluj',              'w' => 230],
        ['slug' => 'pfg-finance',               'name' => 'PFG Finance',                 'w' => 825],
        ['slug' => 'piticii-din-gradina',       'name' => 'Piticii din grădină',         'w' => 345],
        ['slug' => 'optiplaza',                 'name' => 'Optiplaza',                   'w' => 888],
        ['slug' => 'wolf-electric',             'name' => 'Wolf Electric',               'w' => 313],
        ['slug' => 'evikom',                    'name' => 'Evikom',                      'w' => 1045],
        ['slug' => 'napoca7',                   'name' => 'Napoca7',                     'w' => 549],
        ['slug' => 'rgq-consulting',            'name' => 'RGQ Consulting',              'w' => 794],
        ['slug' => 'solis',                     'name' => 'Solis School of Life',        'w' => 477],
        ['slug' => 'smart-integrated-business', 'name' => 'Smart Integrated Business',   'w' => 948],
    ];
@endphp

<section class="border-y border-zinc-200 bg-white py-12 lg:py-14">
    @if ($title)
        <p class="mb-8 text-center text-sm font-semibold uppercase tracking-wider text-muted">{{ $title }}</p>
    @endif

    <div class="relative flex overflow-hidden [mask-image:linear-gradient(to_right,transparent,black_8%,black_92%,transparent)]">
        @foreach (['', 'aria-hidden'] as $copy)
            <div
                class="flex shrink-0 animate-marquee items-center gap-10 pr-10 sm:gap-14 sm:pr-14 lg:gap-16 lg:pr-16"
                @if ($copy) aria-hidden="true" @endif
            >
                @foreach ($partners as $partner)
                    <img
                        src="{{ asset('images/partners/'.$partner['slug'].'.png') }}"
                        alt="{{ $copy ? '' : $partner['name'] }}"
                        width="{{ $partner['w'] }}"
                        height="240"
                        loading="lazy"
                        decoding="async"
                        class="h-7 w-auto shrink-0 opacity-60 transition duration-200 hover:opacity-100 sm:h-9 lg:h-10"
                    />
                @endforeach
            </div>
        @endforeach
    </div>
</section>
