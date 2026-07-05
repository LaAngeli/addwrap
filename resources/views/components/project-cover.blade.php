@props([
    'project' => [],
    'tall' => false,
])

@php
    use App\Support\Projects;

    $content = Projects::content($project);
    $tag = $content['tag'] ?? __('portfolio.categories.'.($project['category'] ?? 'general'));
    $keywords = $content['keywords'] ?? null;
    $logo = $project['logo'] ?? ($project['slug'] ?? '');
@endphp

{{--
| Copertă client: structură constantă (etichetă sus, nume + cuvinte-cheie jos),
| cu logo-ul real în culoare, direct pe card (fără fundal). Dimensiune dublată
| în varianta `tall` (showcase mare + banner detaliu); moderată în grila compactă
| „alte proiecte", care e prea joasă pentru dublare. Fără hover — cardul e static.
--}}
<div {{ $attributes->merge(['class' => 'relative flex w-full flex-col overflow-hidden rounded-2xl bg-gradient-to-br from-teal-ink to-teal-deep '.($tall ? 'aspect-[16/10]' : 'aspect-[16/9]')]) }}>
    <div class="bg-dot-grid pointer-events-none absolute inset-0 text-white opacity-[0.06]"></div>
    <div class="pointer-events-none absolute -right-16 -top-20 h-52 w-52 rounded-full bg-orange/20 blur-3xl"></div>

    {{-- Antet: eticheta de nișă --}}
    <div class="relative flex items-center justify-between px-5 pt-4 sm:px-6">
        <span class="text-[11px] font-semibold uppercase tracking-[0.2em] text-white/70">{{ $tag }}</span>
        <span class="h-1.5 w-1.5 rounded-full bg-orange"></span>
    </div>

    {{-- Logo client, în culoare, direct pe card --}}
    <div class="relative flex flex-1 items-center justify-center {{ $tall ? 'px-8 py-4' : 'px-5 py-3' }}">
        @if ($logo)
            <img
                src="{{ \App\Support\Media::partnerLogo($logo, true) }}"
                alt=""
                height="480"
                loading="lazy"
                decoding="async"
                @class([
                    'w-auto object-contain',
                    'max-h-32 max-w-[72%] sm:max-h-40' => $tall,
                    'max-h-16 max-w-[64%]' => ! $tall,
                ])
            />
        @endif
    </div>

    {{-- Subsol: nume client + cuvinte-cheie de domeniu --}}
    <div class="relative px-5 pb-5 sm:px-6">
        <p class="text-xl font-black tracking-tight text-white sm:text-2xl">{{ $project['client'] ?? '' }}</p>
        @if ($keywords)
            <p class="mt-1 text-[11px] font-medium uppercase tracking-wider text-white/45">{{ $keywords }}</p>
        @endif
    </div>
</div>
