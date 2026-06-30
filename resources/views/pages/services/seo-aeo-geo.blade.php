@php
    use App\Support\Localization;

    $svc = __('services.items.'.$serviceKey);
    $page = __('service_pages.'.$serviceKey);
    $features = $svc['features'] ?? [];
@endphp

@extends('layouts.app')

@section('content')

    {{-- Hero --}}
    <section class="border-b border-zinc-200 bg-paper">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <a href="{{ Localization::route('services.index') }}" class="text-sm font-medium text-ink transition hover:underline">&larr; {{ __('messages.nav.services') }}</a>

            <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-2 lg:items-center">
                <div class="lg:col-start-1 lg:row-start-1">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-zinc-900 text-white">
                            <x-service-icon :name="$service['icon'] ?? 'chart-bar'" class="h-6 w-6" />
                        </span>
                        <span class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $svc['name'] }}</span>
                    </div>
                    <h1 data-animate="fade-up" class="mt-6 text-4xl font-bold tracking-tight text-ink sm:text-5xl text-balance">{{ $svc['tagline'] }}</h1>
                    <p data-animate="fade-up" class="mt-5 text-lg text-muted">{{ $svc['description'] }}</p>

                    <div data-animate="fade-up" class="mt-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:gap-6">
                        @if (! empty($svc['price']))
                            <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1">
                                <span class="text-3xl font-bold tracking-tight text-ink">{{ $svc['price']['amount'] }}</span>
                                <span class="text-sm text-muted">{{ $svc['price']['frequency'] ?? '' }} · {{ $svc['price']['vat'] ?? '' }}</span>
                            </div>
                        @endif

                        <a href="{{ Localization::serviceUrl('web-development') }}" class="inline-flex flex-col rounded-2xl border border-zinc-200 bg-white p-4 transition hover:border-zinc-400">
                            <span class="text-sm font-semibold text-ink">{{ $page['included_label'] }}</span>
                            <span class="mt-0.5 text-sm text-muted">{{ $page['included_sub'] }} &rarr;</span>
                        </a>
                    </div>

                </div>

                {{-- B: ilustrație (între text și CTA pe mobil) --}}
                {{-- Explainer interactiv: SEO / AEO / GEO --}}
                <div data-animate="scale-in" x-data="{ layer: 'seo' }" class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:self-center">
                    {{-- Comutator --}}
                    <div class="inline-flex w-full rounded-full border border-zinc-200 bg-zinc-50 p-1">
                        @foreach ($page['layers'] as $l)
                            <button type="button" @click="layer = '{{ $l['key'] }}'" :class="layer === '{{ $l['key'] }}' ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:text-ink'" class="flex-1 rounded-full px-3 py-1.5 text-xs font-bold transition">{{ $l['name'] }}</button>
                        @endforeach
                    </div>

                    {{-- Descriere activă --}}
                    @foreach ($page['layers'] as $l)
                        <div x-show="layer === '{{ $l['key'] }}'" x-cloak class="mt-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500">{{ $l['full'] }}</p>
                            <p class="mt-1 text-sm leading-relaxed text-muted">{{ $l['desc'] }}</p>
                        </div>
                    @endforeach

                    {{-- Mockup SEO --}}
                    <div x-show="layer === 'seo'" x-cloak class="mt-4 rounded-xl border border-zinc-200 p-3">
                        <div class="flex items-center gap-2 rounded-full border border-zinc-200 px-3 py-2 text-xs text-muted">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M21 21l-4.3-4.3m1.8-4.7a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            {{ $page['serp_query'] }}
                        </div>
                        <div class="mt-3 space-y-2">
                            <div class="rounded-lg border border-zinc-900 bg-zinc-50 p-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-semibold uppercase tracking-wider text-zinc-500">{{ $page['serp_you'] }}</span>
                                    <span class="rounded bg-zinc-900 px-1.5 py-0.5 text-[10px] font-bold text-white">#1</span>
                                </div>
                                <div class="mt-2 h-2.5 w-3/4 rounded bg-zinc-300"></div>
                                <div class="mt-1.5 h-2 w-1/2 rounded bg-zinc-200"></div>
                            </div>
                            @for ($i = 0; $i < 2; $i++)
                                <div class="rounded-lg border border-zinc-100 p-3">
                                    <div class="h-2.5 w-2/3 rounded bg-zinc-200"></div>
                                    <div class="mt-1.5 h-2 w-1/2 rounded bg-zinc-100"></div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- Mockup AEO: răspuns direct (featured snippet) --}}
                    <div x-show="layer === 'aeo'" x-cloak class="mt-4">
                        <div class="flex items-center gap-2 rounded-full border border-zinc-200 px-3 py-2 text-xs text-muted">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M21 21l-4.3-4.3m1.8-4.7a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            {{ $page['aeo_query'] }}
                        </div>
                        <div class="mt-3 rounded-xl border-2 border-zinc-900 p-4">
                            <span class="inline-block rounded bg-zinc-900 px-1.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-white">{{ $page['aeo_badge'] }}</span>
                            <p class="mt-2 text-sm leading-relaxed text-zinc-700">{{ $page['aeo_answer'] }}</p>
                            <p class="mt-2 text-[11px] text-muted">— {{ $page['aeo_source'] }}</p>
                        </div>
                    </div>

                    {{-- Mockup GEO: răspuns generativ AI cu surse citate --}}
                    <div x-show="layer === 'geo'" x-cloak class="mt-4 rounded-xl border border-zinc-200 p-4">
                        <div class="flex items-center gap-2 text-xs font-semibold text-muted">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9.8 3.5l1 2.7 2.7 1-2.7 1-1 2.7-1-2.7-2.7-1 2.7-1 1-2.7zM18 10l.7 1.8L20.5 12.5l-1.8.7L18 15l-.7-1.8-1.8-.7 1.8-.7L18 10z" /></svg>
                            {{ $page['geo_engine'] }}
                        </div>
                        <p class="mt-3 text-sm leading-relaxed text-zinc-700">{{ $page['geo_answer'] }}</p>
                        <p class="mt-4 text-[11px] font-semibold uppercase tracking-wider text-muted">{{ $page['geo_sources_label'] }}</p>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach ($page['geo_sources'] as $i => $src)
                                <span @class([
                                    'rounded-full px-2.5 py-1 text-[11px] font-medium',
                                    'bg-zinc-900 text-white' => $i === 0,
                                    'border border-zinc-200 text-zinc-600' => $i !== 0,
                                ])>{{ $src }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- C: CTA --}}
                <div class="lg:col-start-1 lg:row-start-2">
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a href="{{ Localization::route('contact') }}" class="rounded-lg bg-zinc-900 px-6 py-3 text-center text-base font-semibold text-white transition hover:bg-black">{{ $page['price_cta'] }}</a>
                        <a href="{{ Localization::route('pricing') }}" class="rounded-lg border border-zinc-300 px-6 py-3 text-center text-base font-semibold text-ink transition hover:bg-white">{{ __('services.index.cta_secondary') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Highlight: inclus în Website + SEO --}}
    @if (! empty($svc['highlight']))
        <section class="bg-white py-16 lg:py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative overflow-hidden rounded-3xl bg-zinc-900 p-8 text-white sm:p-12">
                    <div class="bg-dot-grid pointer-events-none absolute inset-0 opacity-[0.12]"></div>
                    <div class="relative">
                        <p class="text-sm font-semibold uppercase tracking-wider text-zinc-400">{{ $svc['highlight']['title'] }}</p>
                        <p class="mt-3 max-w-3xl text-xl font-medium">{{ $svc['highlight']['text'] }}</p>
                        <a href="{{ Localization::serviceUrl('web-development') }}" class="mt-6 inline-block rounded-lg bg-white px-6 py-3 text-sm font-semibold text-zinc-900 transition hover:bg-zinc-200">{{ __('services.items.web-development.name') }} &rarr;</a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Ce includem — grupat pe SEO / AEO / GEO --}}
    @if (! empty($page['includes']))
        <section class="border-y border-zinc-200 bg-paper py-16 lg:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $page['includes_eyebrow'] }}</p>
                    <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ $page['includes_title'] }}</h2>
                    <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ $page['includes_subtitle'] }}</p>
                </div>

                <div data-animate-group class="mt-12 grid grid-cols-1 gap-6 lg:grid-cols-3">
                    @foreach ($page['includes'] as $group)
                        <div class="flex flex-col rounded-3xl border border-zinc-200 bg-white p-6 transition hover:-translate-y-1 hover:border-zinc-900 hover:shadow-lg sm:p-8">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex shrink-0 items-center justify-center rounded-xl bg-zinc-900 px-3 py-2 text-sm font-black tracking-tight text-white">{{ $group['abbr'] }}</span>
                                <h3 class="text-sm font-semibold leading-tight text-ink">{{ $group['full'] }}</h3>
                            </div>
                            <ul class="mt-6 space-y-3">
                                @foreach ($group['items'] as $item)
                                    <li class="flex items-start gap-3 text-sm text-zinc-700">
                                        <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-zinc-100 text-zinc-900">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                        </span>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Cum cresc rezultatele în timp (timeline interactiv) --}}
    @if (! empty($page['timeline']))
        @php $tlProgress = array_column($page['timeline'], 'progress'); @endphp
        <section class="bg-white py-20 lg:py-24">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $page['timeline_eyebrow'] }}</p>
                    <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ $page['timeline_title'] }}</h2>
                    <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ $page['timeline_subtitle'] }}</p>
                </div>

                <div data-animate="fade-up" x-data="{ t: 0, progress: {{ json_encode($tlProgress) }} }" class="mt-12">
                    {{-- Milestones --}}
                    <div class="relative">
                        <div class="absolute inset-x-4 top-4 h-px bg-zinc-200"></div>
                        <div class="relative grid grid-cols-4 gap-2">
                            @foreach ($page['timeline'] as $i => $step)
                                <button type="button" @click="t = {{ $i }}" class="flex flex-col items-center gap-2 text-center">
                                    <span :class="t >= {{ $i }} ? 'bg-zinc-900 text-white' : 'border border-zinc-300 bg-white text-zinc-400'" class="relative z-10 inline-flex h-8 w-8 items-center justify-center rounded-full text-xs font-bold transition">{{ $i + 1 }}</span>
                                    <span :class="t === {{ $i }} ? 'font-semibold text-ink' : 'text-muted'" class="text-xs transition">{{ $step['month'] }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Bară de progres --}}
                    <div class="mt-8 h-2 w-full overflow-hidden rounded-full bg-zinc-100">
                        <div class="h-full rounded-full bg-zinc-900 transition-all duration-700 ease-out" :style="'width: ' + progress[t] + '%'"></div>
                    </div>

                    {{-- Panou --}}
                    <div class="relative mt-6 min-h-[6rem]">
                        @foreach ($page['timeline'] as $i => $step)
                            <div
                                x-show="t === {{ $i }}"
                                x-cloak
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute inset-0 rounded-2xl border border-zinc-200 bg-paper p-6"
                            >
                                <h3 class="text-lg font-bold text-ink">{{ $step['title'] }}</h3>
                                <p class="mt-2 text-sm leading-relaxed text-muted">{{ $step['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Proces --}}
    <section class="bg-white py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $page['process_eyebrow'] }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ $page['process_title'] }}</h2>
            </div>
            <div data-animate-group class="mt-14 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($page['process'] as $i => $step)
                    <div>
                        <span class="text-5xl font-bold text-zinc-200">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="mt-3 text-lg font-semibold text-ink">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm text-muted">{{ $step['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Alte servicii --}}
    <x-other-services :current="$serviceKey" />

    <x-cta-band
        :title="__('services.show.cta_title')"
        :text="__('services.show.cta_text')"
        :button="__('messages.cta.offer')"
        :href="Localization::route('contact')"
    />

@endsection
