@php
    use App\Support\Projects;
    use App\Support\Localization;
@endphp

@extends('layouts.app')

@section('content')

    {{-- Hero — Split + showcase interactiv cu logo-uri --}}
    <section class="relative overflow-hidden border-b border-zinc-200 bg-paper">
        <div class="bg-dot-grid pointer-events-none absolute inset-0 -z-10 opacity-[0.5] [mask-image:radial-gradient(ellipse_at_top_right,black,transparent_65%)]"></div>
        <div class="pointer-events-none absolute -right-32 -top-32 -z-10 h-96 w-96 rounded-full bg-zinc-100 blur-3xl"></div>

        <div class="mx-auto max-w-7xl px-4 pt-16 pb-16 sm:px-6 sm:pt-20 lg:px-8 lg:py-28">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:items-center lg:gap-12">

                {{-- A: titlu + subtitlu --}}
                <div class="text-center lg:col-start-1 lg:row-start-1 lg:text-left">
                    <p data-animate="fade-up" class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-white/80 px-4 py-1.5 text-sm font-medium text-muted backdrop-blur">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-orange opacity-60"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-orange"></span>
                        </span>
                        {{ __('pages.portfolio.hero_eyebrow') }}
                    </p>
                    <h1 data-animate="fade-up" data-animate-delay="0.08" class="mt-6 text-4xl font-bold tracking-tight text-ink sm:text-6xl lg:text-7xl text-balance">{{ __('pages.portfolio.hero_title') }}</h1>
                    <p data-animate="fade-up" data-animate-delay="0.16" class="mx-auto mt-5 max-w-xl text-lg text-muted sm:mt-6 sm:text-xl text-pretty lg:mx-0">{{ __('pages.portfolio.hero_subtitle') }}</p>
                </div>

                {{-- B: ilustrație — showcase interactiv cu logo-urile clienților --}}
                <div
                    data-animate="scale-in"
                    x-data="{
                        sel: 0,
                        count: {{ count($projects) }},
                        timer: null,
                        start() {
                            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
                            this.timer = setInterval(() => { this.sel = (this.sel + 1) % this.count; }, 3500);
                        },
                        stop() { clearInterval(this.timer); },
                    }"
                    x-init="start()"
                    @mouseenter="stop()"
                    @mouseleave="start()"
                    class="mx-auto w-full max-w-md lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:max-w-none lg:self-center"
                >
                    {{-- Scenă: logo-ul clientului selectat + info --}}
                    <div class="relative aspect-[16/11] overflow-hidden rounded-3xl border border-zinc-200 bg-white shadow-xl shadow-zinc-900/10">
                        <div class="bg-dot-grid pointer-events-none absolute inset-0 opacity-50 [mask-image:radial-gradient(ellipse_at_center,black,transparent_75%)]"></div>
                        @foreach ($projects as $slug => $project)
                            @php $c = Projects::content($project); @endphp
                            <div
                                x-show="sel === {{ $loop->index }}"
                                @unless ($loop->first) x-cloak @endunless
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-[1.03]"
                                x-transition:enter-end="opacity-100 scale-100"
                                class="absolute inset-0 flex flex-col items-center justify-center gap-4 p-8 text-center"
                            >
                                <img
                                    src="{{ \App\Support\Media::partnerLogo($project['logo'] ?? $slug) }}"
                                    alt="{{ $project['client'] }}"
                                    height="240"
                                    loading="lazy"
                                    decoding="async"
                                    @class([
                                        'w-auto max-w-[65%] object-contain',
                                        'h-[5.5rem] sm:h-28' => $slug === 'synaptica',
                                        'h-11 sm:h-14' => $slug !== 'synaptica',
                                    ])
                                />
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-orange">{{ $c['tag'] ?? '' }}</p>
                                    <p class="mt-1.5 text-base font-bold text-ink sm:text-lg">{{ $project['client'] }}</p>
                                    <p class="mx-auto mt-1.5 max-w-xs text-sm text-muted text-pretty">{{ $c['excerpt'] ?? '' }}</p>
                                </div>
                                <a href="{{ Localization::route('portfolio.show', ['slug' => $slug]) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-ink hover:underline">
                                    {{ __('portfolio.view_case') }}
                                    <span aria-hidden="true">&rarr;</span>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Selector: chip-uri cu logo (clic sau auto-derulare, pauză la hover) --}}
                    <div class="mt-3 grid grid-cols-4 gap-2.5">
                        @foreach ($projects as $slug => $project)
                            <button
                                type="button"
                                @click="sel = {{ $loop->index }}"
                                :class="sel === {{ $loop->index }} ? 'border-orange ring-1 ring-orange' : 'border-zinc-200 opacity-60 hover:opacity-100'"
                                class="flex aspect-[3/2] items-center justify-center rounded-xl border bg-white p-2 transition"
                                aria-label="{{ $project['client'] }}"
                                :aria-pressed="sel === {{ $loop->index }} ? 'true' : 'false'"
                            >
                                <img
                                    src="{{ \App\Support\Media::partnerLogo($project['logo'] ?? $slug) }}"
                                    alt="{{ $project['client'] }}"
                                    height="240"
                                    loading="lazy"
                                    decoding="async"
                                    @class([
                                        'w-auto max-w-full object-contain',
                                        'max-h-10 sm:max-h-12' => $slug === 'synaptica',
                                        'max-h-5 sm:max-h-6' => $slug !== 'synaptica',
                                    ])
                                />
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- C: CTA + chips --}}
                <div class="text-center lg:col-start-1 lg:row-start-2 lg:text-left">
                    <div data-animate="fade-up" class="flex flex-col gap-3 sm:flex-row sm:justify-center lg:justify-start">
                        <a href="{{ Localization::route('contact') }}" class="w-full rounded-lg bg-orange px-6 py-3.5 text-base font-semibold text-white shadow-sm transition hover:bg-orange-deep hover:shadow-md sm:w-auto">{{ __('messages.cta.offer') }}</a>
                        <a href="{{ Localization::route('services.index') }}" class="w-full rounded-lg border border-zinc-300 bg-white px-6 py-3.5 text-base font-semibold text-ink transition hover:border-zinc-900 sm:w-auto">{{ __('messages.cta.all_services') }}</a>
                    </div>
                    <div data-animate="fade-up" class="mt-8 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-muted lg:justify-start">
                        @foreach (__('pages.portfolio.hero_points') as $point)
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

    {{-- Banner clienți --}}
    <x-clients-marquee :title="__('portfolio.clients_title')" />

    {{-- Showcase de lucrări — rânduri mari alternante --}}
    <section class="bg-paper py-20 lg:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="space-y-20 lg:space-y-32">
                @foreach ($projects as $slug => $project)
                    @php
                        $c = Projects::content($project);
                        $even = $loop->iteration % 2 === 0;
                    @endphp
                    <a
                        href="{{ Localization::route('portfolio.show', ['slug' => $slug]) }}"
                        data-animate="fade-up"
                        class="group grid grid-cols-1 items-center gap-8 lg:grid-cols-2 lg:gap-16"
                    >
                        {{-- Vizual --}}
                        <div class="{{ $even ? 'lg:order-2' : '' }} overflow-hidden rounded-3xl">
                            <x-project-cover :project="$project" tall />
                        </div>

                        {{-- Detalii --}}
                        <div class="{{ $even ? 'lg:order-1' : '' }}">
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-bold text-zinc-300">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="h-px flex-1 bg-zinc-200"></span>
                                <span class="text-xs font-semibold uppercase tracking-wider text-muted">{{ $c['tag'] ?? __('portfolio.categories.'.$project['category']) }}</span>
                            </div>

                            <p class="mt-6 text-sm font-medium text-muted">{{ $project['client'] }} · {{ $project['year'] }}</p>
                            <h2 class="mt-2 text-3xl font-bold tracking-tight text-ink transition group-hover:text-zinc-600 sm:text-4xl text-balance">{{ $c['title'] }}</h2>
                            <p class="mt-4 max-w-xl text-lg text-muted">{{ $c['excerpt'] }}</p>

                            @if (! empty($c['metrics']))
                                <div class="mt-8 flex flex-wrap gap-x-10 gap-y-4">
                                    @foreach ($c['metrics'] as $metric)
                                        <div>
                                            <div class="text-2xl font-bold tracking-tight text-ink sm:text-3xl">{{ $metric['value'] }}</div>
                                            <p class="mt-1 text-xs text-muted">{{ $metric['label'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <span class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-ink">
                                {{ __('portfolio.view_case') }}
                                <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-band
        :title="__('portfolio.cta_title')"
        :text="__('portfolio.cta_text')"
        :button="__('messages.cta.discuss')"
        :href="Localization::route('contact')"
    />

@endsection
