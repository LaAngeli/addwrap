@php use App\Support\Localization; @endphp

@extends('layouts.app')

@section('content')

    {{-- Hero — Split + mockup interactiv --}}
    <section class="relative overflow-hidden bg-white">
        <div class="bg-dot-grid pointer-events-none absolute inset-0 -z-10 opacity-[0.5] [mask-image:radial-gradient(ellipse_at_top_right,black,transparent_65%)]"></div>
        <div class="pointer-events-none absolute -right-32 -top-32 -z-10 h-96 w-96 rounded-full bg-zinc-100 blur-3xl"></div>

        <div class="mx-auto max-w-7xl px-4 pt-16 pb-16 sm:px-6 sm:pt-20 lg:px-8 lg:py-28">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:items-center lg:gap-12">

                {{-- A: titlu + subtitlu --}}
                <div class="text-center lg:col-start-1 lg:row-start-1 lg:text-left">
                    <p data-animate="fade-up" class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-white/80 px-4 py-1.5 text-sm font-medium text-muted backdrop-blur">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-zinc-900 opacity-60"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-zinc-900"></span>
                        </span>
                        {{ __('pages.home.hero_eyebrow') }}
                    </p>
                    <h1 data-animate="fade-up" data-animate-delay="0.08" class="mt-6 text-4xl font-bold tracking-tight text-ink sm:text-6xl lg:text-7xl text-balance">{{ __('pages.home.hero_title') }}</h1>
                    <p data-animate="fade-up" data-animate-delay="0.16" class="mx-auto mt-5 max-w-xl text-lg text-muted sm:mt-6 sm:text-xl text-pretty lg:mx-0">{{ __('pages.home.hero_subtitle') }}</p>
                </div>

                {{-- B: ilustrație (între titlu și CTA pe mobil) --}}
                @php
                    $dash = __('pages.home.hero_dashboard');
                    $dashBars = [
                        'brandbook' => [55, 62, 58, 70, 66, 80, 90],
                        'content-strategy' => [40, 50, 48, 62, 70, 78, 88],
                        'google-ads' => [45, 55, 50, 68, 62, 82, 95],
                        'meta-ads' => [50, 58, 66, 60, 78, 72, 90],
                        'seo-aeo-geo' => [30, 42, 50, 58, 70, 82, 96],
                        'web-development' => [60, 65, 70, 75, 80, 88, 94],
                    ];
                    $dashServices = [];
                    foreach (Localization::services() as $dkey => $dsvc) {
                        $dashServices[$dkey] = array_merge($dash['kpis'][$dkey] ?? [], [
                            'name' => __('services.items.'.$dkey.'.name'),
                            'bars' => $dashBars[$dkey] ?? [50, 55, 60, 65, 70, 80, 90],
                        ]);
                    }
                    $dashState = [
                        'sel' => array_key_first($dashServices),
                        'services' => $dashServices,
                        'colors' => ['bg-zinc-200', 'bg-zinc-300', 'bg-zinc-400', 'bg-zinc-500', 'bg-zinc-700', 'bg-zinc-800', 'bg-zinc-900'],
                    ];
                @endphp
                <div data-animate="scale-in" class="relative mx-auto w-full max-w-md lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:max-w-none lg:self-center">
                    {{-- Card browser --}}
                    <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-xl shadow-zinc-900/5">
                        <div class="flex items-center gap-1.5 border-b border-zinc-200 bg-zinc-50 px-4 py-3">
                            <span class="h-2.5 w-2.5 rounded-full bg-zinc-300"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-zinc-300"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-zinc-300"></span>
                            <span class="ml-2 flex-1 truncate rounded-md border border-zinc-200 bg-white px-2.5 py-1 text-xs text-muted">{{ $dash['url'] }}</span>
                        </div>
                        <div class="space-y-4 p-5" x-data="{{ json_encode($dashState) }}">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-muted">{{ $dash['service_label'] }}</p>
                                    <p class="text-sm font-bold text-ink" x-text="services[sel].name"></p>
                                </div>
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-semibold text-zinc-700">
                                    <span class="relative flex h-1.5 w-1.5"><span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-zinc-900 opacity-60"></span><span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-zinc-900"></span></span>{{ $dash['live'] }}
                                </span>
                            </div>

                            {{-- Selector servicii (parcurge tot spectrul) --}}
                            <div class="flex items-center justify-between gap-1.5">
                                @foreach (Localization::services() as $dkey => $dsvc)
                                    <button
                                        type="button"
                                        @click="sel = '{{ $dkey }}'"
                                        :class="sel === '{{ $dkey }}' ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-200 bg-white text-zinc-500 hover:border-zinc-400'"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border transition"
                                        title="{{ __('services.items.'.$dkey.'.name') }}"
                                        aria-label="{{ __('services.items.'.$dkey.'.name') }}"
                                    >
                                        <x-service-icon :name="config('site.services.'.$dkey.'.icon', 'simple')" class="h-4 w-4" />
                                    </button>
                                @endforeach
                            </div>

                            {{-- Grafic reactiv --}}
                            <div class="flex h-28 items-end gap-2">
                                <template x-for="(h, i) in services[sel].bars" :key="i">
                                    <div class="w-full rounded-t transition-all duration-500 ease-out" :class="colors[i]" :style="'height: ' + h + '%'"></div>
                                </template>
                            </div>

                            {{-- KPI --}}
                            <div class="grid grid-cols-2 gap-3">
                                <div class="rounded-xl border border-zinc-200 p-3">
                                    <p class="text-xs text-muted" x-text="services[sel].k1l"></p>
                                    <p class="mt-1 text-xl font-bold text-ink" x-text="services[sel].k1v"></p>
                                </div>
                                <div class="rounded-xl border border-zinc-200 p-3">
                                    <p class="text-xs text-muted" x-text="services[sel].k2l"></p>
                                    <p class="mt-1 text-xl font-bold text-ink" x-text="services[sel].k2v"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card plutitor: optimizare --}}
                    <div class="animate-float absolute -left-4 -bottom-5 hidden items-center gap-2 rounded-xl border border-zinc-200 bg-white px-3 py-2 shadow-lg sm:flex">
                        <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-zinc-900 text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        <span class="text-xs font-semibold text-ink">{{ $dash['float_opt'] }}</span>
                    </div>

                    {{-- Card plutitor: lead-uri --}}
                    <div class="animate-float-slow absolute -right-4 -top-5 hidden flex-col rounded-xl border border-zinc-200 bg-white px-3 py-2 shadow-lg sm:flex">
                        <span class="text-[10px] uppercase tracking-wider text-muted">{{ $dash['float_new_label'] }}</span>
                        <span class="inline-flex items-center gap-1 text-sm font-bold text-ink">
                            <svg class="h-3.5 w-3.5 text-zinc-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l6-6 4 4 8-8M21 7v6m0-6h-6" /></svg>
                            {{ $dash['float_new_value'] }}
                        </span>
                    </div>
                </div>

                {{-- C: CTA + chips --}}
                <div class="text-center lg:col-start-1 lg:row-start-2 lg:text-left">
                    <div data-animate="fade-up" class="flex flex-col gap-3 sm:flex-row sm:justify-center lg:justify-start">
                        <a href="#start" class="w-full rounded-lg bg-zinc-900 px-6 py-3.5 text-base font-semibold text-white shadow-sm transition hover:bg-black hover:shadow-md sm:w-auto">{{ __('pages.home.hero_cta_primary') }}</a>
                        <a href="{{ Localization::route('services.index') }}" class="w-full rounded-lg border border-zinc-300 bg-white px-6 py-3.5 text-base font-semibold text-ink transition hover:border-zinc-900 sm:w-auto">{{ __('pages.home.hero_cta_secondary') }}</a>
                    </div>
                    <div data-animate="fade-up" class="mt-8 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-muted lg:justify-start">
                        @foreach (__('pages.home.hero_points') as $point)
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

    {{-- Încredere: logo-uri clienți --}}
    <x-clients-marquee :title="__('pages.home.clients_title')" />

    {{-- Avantaje integrate (bento) --}}
    @php
        $bentoFeature = __('pages.home.bento_feature');
        $bentoItems = __('pages.home.bento_items');
        $serviceKeys = array_keys(Localization::services());
        $itemIcons = [
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M4 5h7v7H4zM13 5h7v4h-7zM13 12h7v7h-7zM4 14h7v5H4z" />',
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 10v4a1 1 0 001 1h3l5 4V5L7 9H4a1 1 0 00-1 1zM16.5 8a4 4 0 010 8" />',
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9.8 3.5l1 2.7 2.7 1-2.7 1-1 2.7-1-2.7-2.7-1 2.7-1 1-2.7zM18 11l.6 1.6 1.6.6-1.6.6L18 16l-.6-1.6-1.6-.6 1.6-.6L18 11z" />',
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 3a9 9 0 100 18 9 9 0 000-18zM3 12h18M12 3c2.5 2.5 2.5 15 0 18M12 3c-2.5 2.5-2.5 15 0 18" />',
        ];
    @endphp
    <section class="bg-white py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('pages.home.bento_eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ __('pages.home.bento_title') }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ __('pages.home.bento_subtitle') }}</p>
            </div>

            <div data-animate-group class="mt-14 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

                {{-- Card-semnătură (mare, închis) --}}
                <div class="relative flex flex-col justify-between overflow-hidden rounded-3xl bg-zinc-900 p-8 text-white sm:col-span-2">
                    <div class="bg-dot-grid pointer-events-none absolute inset-0 opacity-[0.15]"></div>
                    <div class="relative">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-white">
                            <span class="h-1.5 w-1.5 rounded-full bg-white"></span>{{ $bentoFeature['badge'] }}
                        </span>
                        <h3 class="mt-5 text-2xl font-bold tracking-tight sm:text-3xl">{{ $bentoFeature['title'] }}</h3>
                        <p class="mt-3 max-w-md text-zinc-300">{{ $bentoFeature['text'] }}</p>
                    </div>
                    <div class="relative mt-8 flex flex-wrap items-center gap-4">
                        <span class="rounded-full bg-white px-4 py-2 text-sm font-bold text-zinc-900">{{ $bentoFeature['price'] }}</span>
                        <a href="{{ Localization::serviceUrl('web-development') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-white hover:underline">
                            {{ $bentoFeature['cta'] }} <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>

                {{-- Carduri item --}}
                @foreach ($bentoItems as $i => $item)
                    <div class="group flex flex-col rounded-3xl border border-zinc-200 bg-white p-6 transition hover:-translate-y-1 hover:border-zinc-900 hover:shadow-lg">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-zinc-900 text-white transition group-hover:scale-105">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $itemIcons[$i] ?? '' !!}</svg>
                        </span>
                        <h3 class="mt-5 text-lg font-semibold text-ink">{{ $item['title'] }}</h3>
                        <p class="mt-2 flex-1 text-sm leading-relaxed text-muted">{{ $item['text'] }}</p>

                        @if ($i === 0)
                            <div class="mt-4 flex flex-wrap gap-1.5">
                                @foreach ($serviceKeys as $key)
                                    <a href="{{ Localization::serviceUrl($key) }}" class="inline-flex h-7 w-7 items-center justify-center rounded-lg border border-zinc-200 text-zinc-500 transition hover:border-zinc-900 hover:bg-zinc-900 hover:text-white" title="{{ __('services.items.'.$key.'.name') }}" aria-label="{{ __('services.items.'.$key.'.name') }}">
                                        <x-service-icon :name="config('site.services.'.$key.'.icon', 'simple')" class="h-3.5 w-3.5" />
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    {{-- De ce noi --}}
    <section class="border-y border-zinc-200 bg-paper py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('pages.home.why_eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ __('pages.home.why_title') }}</h2>
            </div>
            <div data-animate-group class="mt-14 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (__('pages.home.why_items') as $i => $item)
                    <div class="group rounded-2xl border border-zinc-200 bg-white p-6 transition hover:-translate-y-1 hover:border-zinc-900 hover:shadow-lg">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-zinc-900 text-white transition group-hover:scale-105">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                @switch($i)
                                    @case(0) <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M5 3v16h16M9 14l3-4 3 2 4-6" /> @break
                                    @case(1) <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 13a9 9 0 1018 0M12 3v6m0 0l-2.5-2.5M12 9l2.5-2.5" /> @break
                                    @case(2) <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 3l8 4v5c0 5-3.5 7.5-8 9-4.5-1.5-8-4-8-9V7z" /> @break
                                    @default <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M13 2L4.5 13H11l-1 9 8.5-12H12z" />
                                @endswitch
                            </svg>
                        </span>
                        <h3 class="mt-5 text-lg font-semibold text-ink">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Servicii --}}
    <section class="bg-white py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('pages.home.services_eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ __('pages.home.services_title') }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ __('pages.home.services_subtitle') }}</p>
            </div>
            <div data-animate-group class="mt-14 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach (Localization::services() as $key => $service)
                    <x-service-card :service-key="$key" />
                @endforeach
            </div>
            <div data-animate="fade-up" class="mt-10 text-center">
                <a href="{{ Localization::route('services.index') }}" class="inline-flex items-center gap-1 text-base font-semibold text-ink hover:underline">
                    {{ __('messages.cta.all_services') }}
                    <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    {{-- Proces --}}
    <section class="border-t border-zinc-200 bg-paper py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('pages.home.process_eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ __('pages.home.process_title') }}</h2>
            </div>
            <div data-animate-group class="mt-14 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (__('pages.home.process_steps') as $i => $step)
                    <div class="relative">
                        <span class="text-5xl font-bold text-zinc-200">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="mt-3 text-lg font-semibold text-ink">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm text-muted">{{ $step['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Statistici --}}
    <section class="relative overflow-hidden bg-zinc-900 py-16 text-white lg:py-20">
        <div class="bg-dot-grid pointer-events-none absolute inset-0 opacity-[0.12]"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div data-animate-group class="grid grid-cols-2 gap-8 lg:grid-cols-4">
                @foreach (__('pages.home.stats') as $stat)
                    <div class="text-center">
                        <div class="text-4xl font-bold tracking-tight sm:text-5xl">{{ $stat['value'] }}</div>
                        <p class="mt-2 text-sm text-zinc-400">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Starter / formular --}}
    <section id="start" class="scroll-mt-20 bg-paper py-20 lg:py-24">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-10 max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('pages.home.starter_eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ __('pages.home.starter_title') }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ __('pages.home.starter_subtitle') }}</p>
            </div>
            <div data-animate="scale-in">
                <livewire:project-starter />
            </div>
        </div>
    </section>

    {{-- CTA final --}}
    <x-cta-band
        :title="__('pages.home.cta_title')"
        :text="__('pages.home.cta_text')"
        :button="__('pages.home.cta_button')"
        :href="Localization::route('contact')"
    />

@endsection

