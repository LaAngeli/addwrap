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
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <x-breadcrumbs />

            <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-2 lg:items-center">
                <div class="lg:col-start-1 lg:row-start-1">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-zinc-900 text-white">
                            <x-service-icon :name="$service['icon'] ?? 'magnifying-glass'" class="h-6 w-6" />
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
                {{-- Dashboard interactiv --}}
                <div
                    data-animate="scale-in"
                    x-data="{
                        ch: 'search',
                        bars: {
                            search: [45, 60, 40, 78, 55, 90, 68],
                            display: [72, 54, 66, 48, 82, 60, 76],
                            youtube: [28, 44, 58, 50, 72, 86, 96],
                        },
                    }"
                    class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:self-center"
                >
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-ink">{{ $page['dashboard_title'] }}</span>
                        <span class="text-xs text-muted">{{ $page['dashboard_note'] }}</span>
                    </div>

                    {{-- Segmented control: canale --}}
                    <div class="mt-4 inline-flex w-full rounded-full border border-zinc-200 bg-zinc-50 p-1">
                        @foreach ($page['channels'] as $c)
                            <button type="button" @click="ch = '{{ $c['key'] }}'" :class="ch === '{{ $c['key'] }}' ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:text-ink'" class="flex-1 rounded-full px-3 py-1.5 text-xs font-semibold transition">{{ $c['name'] }}</button>
                        @endforeach
                    </div>

                    {{-- Conținut per canal --}}
                    @foreach ($page['channels'] as $c)
                        <div x-show="ch === '{{ $c['key'] }}'" x-cloak class="mt-4">
                            <p class="text-xs leading-relaxed text-muted">{{ $c['desc'] }}</p>
                            <div class="mt-4 grid grid-cols-3 gap-2">
                                @foreach ($c['kpis'] as $k)
                                    <div class="rounded-xl border border-zinc-100 bg-zinc-50 p-3 text-center">
                                        <div class="text-lg font-bold tracking-tight text-ink">{{ $k['value'] }}</div>
                                        <div class="text-[10px] text-muted">{{ $k['label'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    {{-- Chart reactiv la canalul ales --}}
                    <div class="mt-5">
                        <div class="flex h-20 items-end justify-between gap-1.5">
                            <template x-for="(h, i) in bars[ch]" :key="i">
                                <div class="flex-1 rounded-t bg-zinc-900 transition-all duration-500 ease-out" :style="'height: ' + h + '%'"></div>
                            </template>
                        </div>
                        <div class="mt-2 text-[10px] text-muted">{{ $page['period_label'] }}</div>
                    </div>

                    {{-- ROAS --}}
                    <div class="mt-4 flex items-center justify-between rounded-xl bg-zinc-900 px-4 py-3 text-white">
                        <span class="text-xs text-zinc-400">{{ $page['roas_label'] }}</span>
                        <span class="text-xl font-bold">{{ $page['roas_value'] }}</span>
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

    {{-- Ce includem --}}
    @if (! empty($features))
        @php
            $featureIcons = [
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M4 7h10M18 7h2M4 17h2M10 17h10M14 5v4M8 15v4" />',
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M6 9a3 3 0 100 6c2.5 0 4-3 6-3s3.5 3 6 3a3 3 0 100-6c-2.5 0-4 3-6 3s-3.5-3-6-3z" />',
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M5 3v16h16M9 14l3-4 3 2 4-6" />',
                '<circle cx="12" cy="12" r="8" stroke-width="1.7" /><circle cx="12" cy="12" r="3.5" stroke-width="1.7" /><circle cx="12" cy="12" r="0.7" fill="currentColor" stroke="none" />',
            ];
        @endphp
        <section class="bg-white py-16 lg:py-20">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-ink">{{ $svc['features_title'] ?? '' }}</h2>
                <div data-animate-group class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2">
                    @foreach ($features as $i => $feature)
                        <div class="group flex items-start gap-4 rounded-2xl border border-zinc-200 bg-white p-6 transition hover:-translate-y-1 hover:border-zinc-900 hover:shadow-lg">
                            <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-zinc-900 text-white transition group-hover:scale-105">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $featureIcons[$i % count($featureIcons)] !!}</svg>
                            </span>
                            <p class="text-base font-medium leading-relaxed text-ink">{{ $feature }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Proces --}}
    <section class="border-y border-zinc-200 bg-paper py-20 lg:py-24">
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

    {{-- Add-on-uri --}}
    @if (! empty($addons))
        <section class="bg-white py-16 lg:py-20">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-ink">{{ $page['addons_title'] }}</h2>
                <div class="mt-8 divide-y divide-zinc-200 overflow-hidden rounded-2xl border border-zinc-200">
                    @foreach ($addons as $addon)
                        <div class="flex flex-col gap-1 p-5 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="font-medium text-ink">{{ $addon['title'] }}</p>
                                @if (! empty($addon['note']))
                                    <p class="text-sm text-muted">{{ $addon['note'] }}</p>
                                @endif
                            </div>
                            <span class="shrink-0 text-lg font-bold text-ink">{{ $addon['price'] }}</span>
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
