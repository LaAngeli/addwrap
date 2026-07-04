@php
    use App\Support\Localization;

    $industries = __('pages.about.industries');
    $industryIcons = [
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M6 6h15l-1.6 9H7.5L6 6zm0 0L5.2 3H3M9 20a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z" />',
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M4 8h13v4a5 5 0 01-5 5H9a5 5 0 01-5-5V8zm13 1h2a2 2 0 010 4h-2M6 3v2M9.5 3v2M13 3v2" />',
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 8h18v11H3V8zm5 0V6a2 2 0 012-2h4a2 2 0 012 2v2M3 13h18" />',
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 11l9-7 9 7M5 10v9h14v-9M10 19v-5h4v5" />',
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 21C7 17 4 14 4 9.5A4.5 4.5 0 0112 7a4.5 4.5 0 018 2.5C20 14 17 17 12 21z" />',
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 9l9-4 9 4-9 4-9-4zm4 2.2V15c0 1.1 2.2 2.5 5 2.5s5-1.4 5-2.5v-3.8M21 9v5" />',
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 21V10l6 4V10l6 4V8l6 4v9H3zm0 0h18" />',
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 21s7-6 7-11a7 7 0 10-14 0c0 5 7 11 7 11zm0-8.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />',
    ];
@endphp

@extends('layouts.app')

@section('content')

    {{-- Hero — Split + ilustrație interactivă (selector de domenii) --}}
    <section class="relative overflow-hidden border-b border-zinc-200 bg-white">
        <div class="bg-dot-grid pointer-events-none absolute inset-0 -z-10 opacity-[0.5] [mask-image:radial-gradient(ellipse_at_top_right,black,transparent_65%)]"></div>
        <div class="pointer-events-none absolute -right-32 -top-32 -z-10 h-96 w-96 rounded-full bg-zinc-100 blur-3xl"></div>

        <div class="mx-auto max-w-7xl px-4 pt-10 pb-10 sm:px-6 sm:pt-16 sm:pb-16 lg:px-8 lg:py-28">
            <div class="grid grid-cols-1 gap-6 sm:gap-8 lg:grid-cols-2 lg:items-center lg:gap-12">

                {{-- A: titlu + subtitlu --}}
                <div class="text-center lg:col-start-1 lg:row-start-1 lg:text-left">
                    <p data-animate="fade-up" class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-white/80 px-4 py-1.5 text-sm font-medium text-muted backdrop-blur">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-orange opacity-60"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-orange"></span>
                        </span>
                        {{ __('pages.about.hero_eyebrow') }}
                    </p>
                    <h1 data-animate="fade-up" data-animate-delay="0.08" class="mt-5 text-4xl font-bold tracking-tight text-ink sm:mt-6 sm:text-6xl lg:text-7xl text-balance">{{ __('pages.about.hero_title') }}</h1>
                    <p data-animate="fade-up" data-animate-delay="0.16" class="mx-auto mt-5 max-w-xl text-lg text-muted sm:mt-6 sm:text-xl text-pretty lg:mx-0">{{ __('pages.about.hero_subtitle') }}</p>
                </div>

                {{-- B: ilustrație (între titlu și CTA pe mobil) --}}
                {{-- Ilustrație interactivă: selector de domenii --}}
                <div data-animate="scale-in" x-data="{ sel: 0 }" class="mx-auto w-full max-w-md lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:max-w-none lg:self-center">
                    <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-xl shadow-zinc-900/5 sm:p-7">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold uppercase tracking-wider text-muted">{{ __('pages.about.industries_eyebrow') }}</span>
                            <span class="text-xs text-muted">{{ count($industries) }}</span>
                        </div>

                        {{-- Panou preview (se schimbă la clic) --}}
                        <div class="relative mt-4 min-h-[168px] overflow-hidden rounded-2xl bg-zinc-900 p-6 text-white">
                            <div class="bg-dot-grid pointer-events-none absolute inset-0 opacity-[0.12]"></div>
                            @foreach ($industries as $i => $ind)
                                <div
                                    x-show="sel === {{ $i }}"
                                    @unless ($loop->first) x-cloak @endunless
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-y-3"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    class="absolute inset-0 flex flex-col justify-center p-6"
                                >
                                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 text-white">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $industryIcons[$i] ?? '' !!}</svg>
                                    </span>
                                    <p class="mt-4 text-xl font-bold tracking-tight">{{ $ind['name'] }}</p>
                                    <p class="mt-1 text-sm leading-relaxed text-zinc-300">{{ $ind['focus'] }}</p>
                                </div>
                            @endforeach
                        </div>

                        {{-- Grilă domenii (clickabile) --}}
                        <div class="mt-4 grid grid-cols-4 gap-2">
                            @foreach ($industries as $i => $ind)
                                <button
                                    type="button"
                                    @click="sel = {{ $i }}"
                                    :class="sel === {{ $i }} ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-200 text-zinc-500 hover:border-zinc-400'"
                                    class="flex items-center justify-center rounded-xl border p-2.5 transition"
                                    :aria-pressed="sel === {{ $i }} ? 'true' : 'false'"
                                    aria-label="{{ $ind['name'] }}"
                                >
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $industryIcons[$i] ?? '' !!}</svg>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- C: CTA + chips --}}
                <div class="text-center lg:col-start-1 lg:row-start-2 lg:text-left">
                    <div data-animate="fade-up" class="flex flex-col gap-3 sm:flex-row sm:justify-center lg:justify-start">
                        <a href="{{ Localization::route('contact') }}" class="w-full rounded-lg bg-orange px-6 py-3.5 text-base font-semibold text-white shadow-sm transition hover:bg-orange-deep hover:shadow-md sm:w-auto">{{ __('messages.cta.offer') }}</a>
                        <a href="{{ Localization::route('services.index') }}" class="w-full rounded-lg border border-zinc-300 bg-white px-6 py-3.5 text-base font-semibold text-ink transition hover:border-zinc-900 sm:w-auto">{{ __('messages.cta.all_services') }}</a>
                    </div>
                    <div data-animate="fade-up" class="mt-6 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-muted sm:mt-8 lg:justify-start">
                        @foreach (__('pages.about.hero_points') as $point)
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="h-4 w-4 text-zinc-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                {{ $point }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Poveste --}}
    <section class="relative overflow-hidden bg-white py-12 sm:py-16 lg:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Antet: logo (stânga) + textul poveștii (dreapta) --}}
            <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-2 lg:gap-16">

                {{-- Logo în spațiul eliberat (doar desktop; pe mobil logo-ul e în navbar) --}}
                <div data-animate="fade-in" class="hidden lg:order-1 lg:block">
                    <img src="{{ asset('images/logo/addwrap-standard.png') }}" alt="{{ config('site.company.name') }}" width="900" height="461" class="h-auto w-full max-w-sm" />
                    <p class="mt-6 max-w-[30rem] text-sm leading-relaxed text-muted">{!! __('pages.about.story_logo_tagline') !!}</p>
                </div>

                {{-- Text poveste --}}
                <div class="lg:order-2">
                    <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('pages.about.story_eyebrow') }}</p>
                    <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ __('pages.about.story_title') }}</h2>
                    <p data-animate="fade-up" class="mt-5 border-l-2 border-zinc-900 pl-6 text-xl font-medium leading-relaxed text-ink text-pretty">{{ __('pages.about.story_lead') }}</p>
                    <p data-animate="fade-up" class="mt-5 text-base leading-relaxed text-muted">{{ __('pages.about.story_text') }}</p>
                </div>
            </div>

            {{-- Triptic narativ (origine → misiune → promisiune) + diagrama „sub același acoperiș" --}}
            <div class="mt-10 grid grid-cols-1 gap-8 sm:mt-14 lg:mt-16 lg:grid-cols-2 lg:items-center lg:gap-20">

                {{-- Triptic narativ --}}
                <div data-animate-group class="space-y-4 sm:space-y-7">
                    @foreach (__('pages.about.story_steps') as $i => $step)
                        <div @class([
                            'flex gap-4 rounded-2xl p-5 sm:gap-5 sm:p-8',
                            'bg-zinc-900' => $loop->last,
                            'border border-zinc-200 bg-white' => ! $loop->last,
                        ])>
                            <span @class([
                                'inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-sm font-bold text-white',
                                'bg-orange' => $loop->last,
                                'bg-zinc-900' => ! $loop->last,
                            ])>{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            <div>
                                <h3 @class(['text-lg font-semibold', 'text-white' => $loop->last, 'text-ink' => ! $loop->last])>{{ $step['title'] }}</h3>
                                <p @class(['mt-2 text-sm leading-relaxed', 'text-zinc-300' => $loop->last, 'text-muted' => ! $loop->last])>{{ $step['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Diagrama interactivă: cele 6 servicii converg către brand (sub același acoperiș) --}}
                @php
                    $arcPos = ['left-[14%] top-[38%]', 'left-[25%] top-[51%]', 'left-[41%] top-[58%]', 'left-[59%] top-[58%]', 'left-[75%] top-[51%]', 'left-[86%] top-[38%]'];
                    $arcLines = [[14, 38], [25, 51], [41, 58], [59, 58], [75, 51], [86, 38]];
                @endphp
                <div data-animate="fade-in" x-data="{ sel: null }" class="mx-auto w-full max-w-[26rem]">
                    <p class="mb-4 text-center text-sm font-semibold uppercase tracking-wider text-muted">{{ __('pages.about.story_roof_label') }}</p>

                    <div class="relative aspect-square">
                        {{-- Linii: servicii → brand (linia activă se evidențiază) + baza comună --}}
                        <svg viewBox="0 0 100 100" class="absolute inset-0 h-full w-full" fill="none" aria-hidden="true">
                            <path d="M14 38 Q50 78 86 38" stroke="#e4e4e7" stroke-width="0.6" stroke-dasharray="1.4 2.6" />
                            @foreach (Localization::services() as $key => $service)
                                @php [$lx, $ly] = $arcLines[$loop->index]; @endphp
                                <line x1="{{ $lx }}" y1="{{ $ly }}" x2="50" y2="18" class="transition-all duration-300" :stroke="sel === '{{ $key }}' ? '#f26c00' : '#e4e4e7'" :stroke-width="sel === '{{ $key }}' ? 1.4 : 0.7" />
                            @endforeach
                        </svg>

                        {{-- Noduri servicii (clickabile) --}}
                        @foreach (Localization::services() as $key => $service)
                            <div class="absolute {{ $arcPos[$loop->index] ?? '' }} -translate-x-1/2 -translate-y-1/2">
                                <button
                                    type="button"
                                    @click="sel = sel === '{{ $key }}' ? null : '{{ $key }}'"
                                    :class="sel === '{{ $key }}' ? 'border-zinc-900 bg-zinc-900 text-white shadow-md' : 'border-zinc-200 bg-white text-zinc-800 hover:-translate-y-0.5 hover:border-zinc-900 hover:shadow-md'"
                                    class="flex h-12 w-12 items-center justify-center rounded-2xl border shadow-sm transition sm:h-14 sm:w-14"
                                    :aria-pressed="sel === '{{ $key }}' ? 'true' : 'false'"
                                    aria-label="{{ __('services.items.'.$key.'.name') }}"
                                >
                                    <x-service-icon :name="config('site.services.'.$key.'.icon', 'simple')" class="h-5 w-5 sm:h-6 sm:w-6" />
                                </button>
                            </div>
                        @endforeach

                        {{-- Brand central (acoperișul comun, resetează selecția) --}}
                        <div class="absolute left-1/2 top-[17%] -translate-x-1/2 -translate-y-1/2">
                            <button
                                type="button"
                                @click="sel = null"
                                class="flex h-16 w-16 items-center justify-center rounded-full bg-zinc-900 shadow-xl ring-4 ring-white transition sm:h-20 sm:w-20"
                                aria-label="{{ config('site.company.name') }}"
                            >
                                <x-brand-glyph class="h-5 w-auto sm:h-6 text-white" />
                            </button>
                        </div>
                    </div>

                    {{-- Caption dinamic: agenția integrată (implicit) sau serviciul selectat --}}
                    <div class="relative -mt-16 min-h-[5.5rem] text-center lg:-mt-12">
                        <div x-show="sel === null" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                            <p class="font-semibold text-ink">{{ config('site.company.name') }}</p>
                            <p class="mx-auto mt-1 max-w-xs text-sm text-muted">{{ __('pages.about.story_roof_caption') }}</p>
                        </div>
                        @foreach (Localization::services() as $key => $service)
                            <div x-show="sel === '{{ $key }}'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                                <p class="font-semibold text-ink">{{ __('services.items.'.$key.'.name') }}</p>
                                <p class="mx-auto mt-1 max-w-xs text-sm text-muted">{{ __('services.items.'.$key.'.tagline') }}</p>
                                <a href="{{ Localization::serviceUrl($key) }}" class="mt-2 inline-flex items-center gap-1 text-sm font-semibold text-ink hover:underline">{{ app()->getLocale() === 'ro' ? 'Vezi serviciul' : 'View service' }} <span aria-hidden="true">&rarr;</span></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Parcursul nostru (cronologie) --}}
    <section class="border-t border-zinc-200 bg-paper py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <p data-animate="fade-up" class="text-center text-sm font-semibold uppercase tracking-wider text-muted">{{ __('pages.about.story_rail_label') }}</p>

            <div data-animate-group class="relative mt-10 space-y-8 border-l-2 border-zinc-200 pl-8 sm:mt-12 sm:space-y-10">
                @foreach (__('pages.about.story_milestones') as $milestone)
                    <div class="relative">
                        <span class="absolute -left-10 top-1 h-4 w-4 rounded-full border-2 border-zinc-900 bg-paper"></span>
                        <p class="text-sm font-bold text-zinc-400">{{ $milestone['year'] }}</p>
                        <h3 class="mt-1 text-lg font-semibold text-ink">{{ $milestone['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted">{{ $milestone['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Statistici --}}
    <section class="relative overflow-hidden bg-zinc-900 py-12 text-white sm:py-16 lg:py-20">
        <div class="bg-dot-grid pointer-events-none absolute inset-0 opacity-[0.12]"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 data-animate="fade-up" class="text-center text-2xl font-bold tracking-tight text-balance sm:text-3xl">{{ __('pages.about.stats_title') }}</h2>
            <div data-animate-group class="mt-10 grid grid-cols-2 gap-8 lg:grid-cols-4">
                @foreach (__('pages.about.stats') as $stat)
                    <div class="text-center">
                        <div class="text-4xl font-bold tracking-tight sm:text-5xl">{{ $stat['value'] }}</div>
                        <p class="mt-2 text-sm text-zinc-400">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Valori --}}
    <section class="bg-white py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 data-animate="fade-up" class="text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ __('pages.about.values_title') }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ __('pages.about.values_subtitle') }}</p>
            </div>
            <div data-animate-group class="mt-10 grid grid-cols-2 gap-3 sm:mt-14 sm:gap-6 lg:grid-cols-4">
                @foreach (__('pages.about.values') as $i => $value)
                    <div class="rounded-2xl border border-zinc-200 p-4 sm:p-6">
                        <span class="text-sm font-bold text-zinc-300">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="mt-3 text-lg font-semibold text-ink">{{ $value['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted">{{ $value['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- De ce noi --}}
    @php
        $whyIcons = [
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M21 11.5a8.4 8.4 0 01-9 8.4 8.5 8.5 0 01-3.8-.9L3 20l1.5-4.2A8.4 8.4 0 1121 11.5z" />',
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M4 5h7v7H4zM13 5h7v4h-7zM13 12h7v7h-7zM4 14h7v5H4z" />',
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M4 7h9M17 7h3M4 17h3M11 17h9M14 5v4M8 15v4" />',
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 21C7 17 4 14 4 9.5A4.5 4.5 0 0112 7a4.5 4.5 0 018 2.5C20 14 17 17 12 21z" />',
        ];
    @endphp
    <section class="border-y border-zinc-200 bg-paper py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('pages.about.why_eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ __('pages.about.why_title') }}</h2>
            </div>
            <div data-animate-group class="mt-10 grid grid-cols-2 gap-3 sm:mt-14 sm:gap-6">
                @foreach (__('pages.about.why_points') as $i => $point)
                    <div class="flex flex-col gap-3 rounded-2xl border border-zinc-200 bg-white p-4 transition hover:-translate-y-1 hover:border-zinc-900 hover:shadow-lg sm:flex-row sm:items-start sm:gap-4 sm:p-6">
                        <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-zinc-900 text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $whyIcons[$i] ?? '' !!}</svg>
                        </span>
                        <p class="text-sm leading-relaxed text-zinc-700 sm:text-base">{{ $point }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Cu cine lucrăm (industrii) --}}
    <section class="bg-white py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('pages.about.industries_eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ __('pages.about.industries_title') }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ __('pages.about.industries_subtitle') }}</p>
            </div>
            <div data-animate-group class="mt-8 grid grid-cols-2 gap-3 sm:mt-12 sm:gap-5 lg:grid-cols-4">
                @foreach ($industries as $i => $industry)
                    <div class="group flex flex-col rounded-2xl border border-zinc-200 bg-white p-4 transition hover:-translate-y-1 hover:border-zinc-900 hover:shadow-lg sm:p-6">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-zinc-900 text-white transition group-hover:scale-105">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $industryIcons[$i] ?? '' !!}</svg>
                        </span>
                        <h3 class="mt-4 font-semibold text-ink">{{ $industry['name'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted">{{ $industry['focus'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-band
        :title="__('pages.home.cta_title')"
        :text="__('pages.home.cta_text')"
        :button="__('pages.home.cta_button')"
        :href="Localization::route('contact')"
    />

@endsection
