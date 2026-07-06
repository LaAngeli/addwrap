@php
    use App\Support\Localization;

    $svc = __('services.items.'.$serviceKey);
    $page = __('service_pages.'.$serviceKey);
    $features = $svc['features'] ?? [];
    $addons = $svc['addons'] ?? [];
@endphp

@extends('layouts.app')

@section('content')

    {{-- Hero --}}
    <section class="border-b border-zinc-200 bg-paper">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-14 lg:px-8 lg:py-20">
            <x-breadcrumbs />

            <div class="mt-6 grid grid-cols-1 gap-6 sm:mt-8 sm:gap-8 lg:grid-cols-2 lg:items-center">
                <div class="lg:col-start-1 lg:row-start-1">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-zinc-900 text-white">
                            <x-service-icon :name="$service['icon'] ?? 'megaphone'" class="h-6 w-6" />
                        </span>
                    </div>
                    <h1 data-animate="fade-up" class="mt-6 text-balance">
                        <span class="block text-sm font-semibold uppercase tracking-wider text-muted">{{ $svc['name'] }}</span>
                        <span class="mt-3 block text-4xl font-bold tracking-tight text-ink sm:text-5xl">{{ $svc['tagline'] }}</span>
                    </h1>
                    <p data-animate="fade-up" class="mt-5 text-lg text-muted">{{ $svc['description'] }}</p>

                    @if (! empty($svc['price']))
                        <div class="mt-8 flex flex-wrap items-baseline gap-x-3 gap-y-1">
                            <span class="text-3xl font-bold tracking-tight text-ink">{{ $svc['price']['amount'] }}</span>
                            <span class="text-sm text-muted">{{ $svc['price']['frequency'] ?? '' }} · {{ $svc['price']['vat'] ?? '' }}</span>
                        </div>
                    @endif

                </div>

                {{-- B: ilustrație (între text și CTA pe mobil) --}}
                {{-- Previzualizare reclamă (feed) --}}
                <div data-animate="scale-in" x-data="{ platform: 'fb' }" class="mx-auto w-full max-w-sm rounded-3xl border border-zinc-200 bg-white p-4 shadow-sm lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:self-center">
                    {{-- Comutator platformă --}}
                    <div class="mb-3 inline-flex w-full rounded-full border border-zinc-200 bg-zinc-50 p-1">
                        <button type="button" @click="platform = 'fb'" :class="platform === 'fb' ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:text-ink'" class="flex-1 rounded-full px-3 py-1.5 text-xs font-semibold transition">{{ $page['platform_fb'] }}</button>
                        <button type="button" @click="platform = 'ig'" :class="platform === 'ig' ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:text-ink'" class="flex-1 rounded-full px-3 py-1.5 text-xs font-semibold transition">{{ $page['platform_ig'] }}</button>
                    </div>

                    {{-- Header postare --}}
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-zinc-900">
                            <x-brand-glyph class="h-3.5 w-auto text-white" />
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-ink">{{ $page['preview_brand'] }}</p>
                            <p class="text-xs text-muted">{{ $page['preview_sponsored'] }}</p>
                        </div>
                    </div>

                    {{-- Media: vizualul reclamei (imagine per platformă) --}}
                    <div class="mt-3 aspect-[4/5] overflow-hidden rounded-xl bg-zinc-100">
                        <img x-show="platform === 'fb'" x-cloak src="{{ asset('images/services/meta-ads/ad-fb.jpg') }}" alt="{{ $page['preview_brand'] }} · Facebook" width="760" height="950" loading="lazy" decoding="async" class="h-full w-full object-cover" />
                        <img x-show="platform === 'ig'" x-cloak src="{{ asset('images/services/meta-ads/ad-ig.jpg') }}" alt="{{ $page['preview_brand'] }} · Instagram" width="760" height="950" loading="lazy" decoding="async" class="h-full w-full object-cover" />
                    </div>

                    {{-- Zonă acțiuni (înălțime fixă: nu mai salt layout-ul la schimbarea tab-ului) --}}
                    <div class="mt-3 flex min-h-[3.75rem] items-center">
                        {{-- Facebook: headline + CTA --}}
                        <div x-show="platform === 'fb'" x-cloak class="flex w-full items-center justify-between rounded-lg bg-zinc-100 p-3">
                            <div class="min-w-0">
                                <p class="truncate text-xs uppercase text-muted">{{ $page['preview_url'] }}</p>
                                <p class="text-sm font-semibold text-ink">{{ $page['preview_headline'] }}</p>
                            </div>
                            <span class="shrink-0 rounded-md bg-zinc-900 px-3 py-1.5 text-xs font-semibold text-white">{{ $page['preview_cta'] }}</span>
                        </div>

                        {{-- Instagram: acțiuni --}}
                        <div x-show="platform === 'ig'" x-cloak class="flex items-center gap-4 text-zinc-800">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M6 12L3.27 3.27 21 12 3.27 20.73 6 12zm0 0h6" /></svg>
                        </div>
                    </div>

                    <p class="mt-3 text-xs text-muted">{{ $page['preview_engagement'] }}</p>
                </div>

                {{-- C: CTA --}}
                <div class="lg:col-start-1 lg:row-start-2">
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a href="{{ Localization::route('contact') }}" class="rounded-lg bg-orange px-6 py-3 text-center text-base font-semibold text-white transition hover:bg-orange-deep">{{ $page['price_cta'] }}</a>
                        <a href="{{ Localization::route('pricing') }}" class="rounded-lg border border-zinc-300 px-6 py-3 text-center text-base font-semibold text-ink transition hover:bg-white">{{ __('services.index.cta_secondary') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Funnel --}}
    <section class="bg-paper py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $page['funnel_eyebrow'] }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ $page['funnel_title'] }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ $page['funnel_subtitle'] }}</p>
            </div>
            @php
                $funnelWidths = ['lg:max-w-3xl', 'lg:max-w-2xl', 'lg:max-w-xl'];
                $funnelIcons = [
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 10v4a1 1 0 001 1h3l5 4V5L7 9H4a1 1 0 00-1 1zM16.5 8a4 4 0 010 8" />',
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 21C7 17 4 14 4 9.5A4.5 4.5 0 0112 7a4.5 4.5 0 018 2.5C20 14 17 17 12 21z" />',
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M6 6h15l-1.6 9H7.5L6 6zm0 0L5.2 3H3M9 20a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z" />',
                ];
                $stepLabel = app()->getLocale() === 'ro' ? 'Pasul' : 'Step';
            @endphp
            <div data-animate-group class="mt-10 flex flex-col items-center gap-2.5 sm:mt-14 sm:gap-3">
                @foreach ($page['funnel'] as $i => $stage)
                    <div class="w-full {{ $funnelWidths[$i] ?? '' }} rounded-2xl border border-zinc-200 bg-white p-4 shadow-sm transition card-hover-neon sm:p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-zinc-900 text-white">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $funnelIcons[$i] ?? '' !!}</svg>
                                </span>
                                <div>
                                    <span class="text-xs font-semibold uppercase tracking-wider text-muted">{{ $stepLabel }} {{ $i + 1 }}</span>
                                    <h3 class="text-lg font-bold leading-tight text-ink">{{ $stage['stage'] }}</h3>
                                </div>
                            </div>
                            <span class="shrink-0 rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-700">{{ $stage['tag'] }}</span>
                        </div>
                        <p class="mt-3 text-sm leading-relaxed text-muted">{{ $stage['desc'] }}</p>
                    </div>
                    @if (! $loop->last)
                        <svg class="h-5 w-5 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M6 13l6 6 6-6" /></svg>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- Ce includem --}}
    @if (! empty($features))
        @php
            $featureIcons = [
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M4 7h10M18 7h2M4 17h2M10 17h10M14 5v4M8 15v4" />',
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 17l6-6 4 4 8-8M21 7v6m0-6h-6" />',
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M5 3v16h16M9 14l3-4 3 2 4-6" />',
            ];
            $incIndex = 0;
        @endphp
        <section class="border-y border-zinc-200 bg-paper py-12 sm:py-16 lg:py-20">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-ink">{{ $svc['features_title'] ?? '' }}</h2>
                <div data-animate-group class="mt-8 grid grid-cols-2 gap-3 sm:gap-5">
                    @foreach ($features as $feature)
                        @php $excl = str_contains($feature, 'Nu include') || str_contains($feature, 'Does not'); @endphp
                        <div @class([
                            'flex flex-col gap-3 rounded-2xl border bg-white p-4 transition sm:flex-row sm:items-start sm:gap-4 sm:p-6',
                            'border-zinc-200 hover:-translate-y-1 hover:border-zinc-900 hover:shadow-lg' => ! $excl,
                            'border-dashed border-zinc-300' => $excl,
                        ])>
                            <span @class([
                                'inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl',
                                'bg-zinc-900 text-white' => ! $excl,
                                'bg-zinc-100 text-zinc-500' => $excl,
                            ])>
                                @if ($excl)
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 9v4m0 4h.01M10.3 4l-7.4 12.5A1.5 1.5 0 004.2 19h15.6a1.5 1.5 0 001.3-2.5L13.7 4a1.5 1.5 0 00-3.4 0z" /></svg>
                                @else
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $featureIcons[$incIndex++ % count($featureIcons)] !!}</svg>
                                @endif
                            </span>
                            <p @class(['text-sm font-medium leading-relaxed sm:text-base', 'text-ink' => ! $excl, 'text-muted' => $excl])>{{ $feature }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Add-on-uri --}}
    @if (! empty($addons))
        <section class="bg-paper py-12 sm:py-16 lg:py-20">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-ink">{{ $page['addons_title'] }}</h2>
                <div data-animate-group class="mt-8 grid grid-cols-2 gap-3 sm:gap-5">
                    @foreach ($addons as $addon)
                        <div class="flex flex-col rounded-2xl border border-zinc-200 bg-white p-4 transition hover:-translate-y-1 card-hover-neon sm:p-6">
                            <div class="flex items-center justify-between gap-3">
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-zinc-900 text-white">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14" /></svg>
                                </span>
                                <span class="rounded-full border border-zinc-200 px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-muted">{{ app()->getLocale() === 'ro' ? 'Opțional' : 'Optional' }}</span>
                            </div>
                            <h3 class="mt-4 font-semibold text-ink">{{ $addon['title'] }}</h3>
                            @if (! empty($addon['note']))
                                <p class="mt-1 flex-1 text-sm text-muted">{{ $addon['note'] }}</p>
                            @endif
                            <p class="mt-4 text-lg font-bold text-ink">{{ $addon['price'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Notă: buget media --}}
    @if (! empty($svc['note']))
        <section class="bg-paper pb-16">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <div class="rounded-2xl border border-zinc-300 bg-white p-5 text-sm text-zinc-700">
                    <span class="font-semibold text-ink">{{ $page['note_title'] }}:</span> {{ $svc['note'] }}
                </div>
            </div>
        </section>
    @endif

    {{-- Alte servicii --}}
    <x-service-faq :faq="$svc['faq'] ?? []" />

    <x-other-services :current="$serviceKey" />

    <x-cta-band
        :title="__('services.show.cta_title')"
        :text="__('services.show.cta_text')"
        :button="__('messages.cta.offer')"
        :href="Localization::route('contact')"
    />

@endsection
