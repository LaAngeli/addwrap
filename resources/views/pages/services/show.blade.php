@php
    use App\Support\Localization;

    $svc = __('services.items.'.$serviceKey);
    $svc = is_array($svc) ? $svc : [];
@endphp

@extends('layouts.app')

@section('content')

    {{-- Hero + card preț --}}
    <section class="border-b border-zinc-200 bg-paper">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
            <x-breadcrumbs />

            <div class="mt-6 grid grid-cols-1 gap-10 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $svc['tagline'] ?? '' }}</p>
                    <h1 data-animate="fade-up" class="mt-3 text-4xl font-bold tracking-tight text-ink sm:text-5xl">{{ $svc['name'] ?? '' }}</h1>
                    <p data-animate="fade-up" class="mt-5 max-w-2xl text-lg text-muted">{{ $svc['description'] ?? '' }}</p>
                </div>

                @if (! empty($svc['price']))
                    <div data-animate="scale-in" class="flex flex-col justify-center rounded-2xl bg-zinc-900 p-6 text-white">
                        <span class="text-4xl font-bold tracking-tight">{{ $svc['price']['amount'] }}</span>
                        @if (! empty($svc['price']['frequency']))
                            <span class="mt-1 text-sm text-zinc-400">{{ $svc['price']['frequency'] }} · {{ $svc['price']['vat'] ?? '' }}</span>
                        @else
                            <span class="mt-1 text-sm text-zinc-400">{{ $svc['price']['vat'] ?? '' }}</span>
                        @endif
                        @if (! empty($svc['price']['unit']))
                            <span class="mt-3 text-sm text-zinc-300">{{ $svc['price']['unit'] }}</span>
                        @endif
                        <a href="{{ Localization::route('contact') }}" class="mt-6 rounded-lg bg-white px-5 py-2.5 text-center text-sm font-semibold text-zinc-900 transition hover:bg-zinc-200">{{ __('services.show.price_cta') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Highlight (avantaj / flexibil / inclus) --}}
    @if (! empty($svc['highlight']))
        <section class="bg-white pt-16 lg:pt-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="rounded-2xl border border-zinc-900 bg-zinc-50 p-6 sm:p-8">
                    <p class="text-sm font-semibold uppercase tracking-wider text-ink">{{ $svc['highlight']['title'] }}</p>
                    <p class="mt-2 max-w-3xl text-lg text-zinc-700">{{ $svc['highlight']['text'] }}</p>
                </div>
            </div>
        </section>
    @endif

    {{-- Pachete --}}
    @if (! empty($svc['packages']))
        <section class="bg-white py-16 lg:py-20">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-ink">{{ __('services.show.packages_title') }}</h2>
                <div data-animate-group class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    @foreach ($svc['packages'] as $plan)
                        <div @class([
                            'relative flex flex-col rounded-2xl border p-8',
                            'border-zinc-900 shadow-xl ring-1 ring-zinc-900' => $plan['featured'] ?? false,
                            'border-zinc-200' => ! ($plan['featured'] ?? false),
                        ])>
                            @if (! empty($plan['badge']))
                                <span class="absolute -top-3 left-1/2 -translate-x-1/2 rounded-full bg-zinc-900 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-white">{{ $plan['badge'] }}</span>
                            @endif
                            <h3 class="text-lg font-semibold text-ink">{{ $plan['name'] }}</h3>
                            <p class="mt-4 text-3xl font-bold tracking-tight text-ink">{{ $plan['volume'] }}</p>
                            <p class="mt-4 text-2xl font-bold text-ink">{{ $plan['price'] }}</p>
                            <p class="text-sm text-muted">{{ $plan['unit'] }}</p>
                            @if (! empty($plan['equivalent']))
                                <p class="mt-1 text-sm text-muted">{{ $plan['equivalent'] }}</p>
                            @endif
                            <a href="{{ Localization::route('contact') }}" @class([
                                'mt-6 block rounded-lg px-5 py-2.5 text-center text-sm font-semibold transition',
                                'bg-zinc-900 text-white hover:bg-black' => $plan['featured'] ?? false,
                                'border border-zinc-300 text-ink hover:bg-zinc-50' => ! ($plan['featured'] ?? false),
                            ])>{{ __('services.show.price_cta') }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Module grupate (livrabile pe categorii) --}}
    @if (! empty($svc['modules']))
        <section class="bg-white py-16 lg:py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-ink">{{ __('services.show.deliverables_title') }}</h2>
                <div data-animate-group class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 {{ count($svc['modules']) >= 3 ? 'lg:grid-cols-3' : '' }}">
                    @foreach ($svc['modules'] as $module)
                        <div class="rounded-2xl border border-zinc-200 p-6">
                            <h3 class="text-lg font-semibold text-ink">{{ $module['title'] }}</h3>
                            <ul class="mt-4 space-y-2.5">
                                @foreach ($module['items'] as $item)
                                    <li class="flex items-start gap-3 text-sm text-zinc-700">
                                        <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-zinc-900 text-white">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
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

    {{-- Features (listă simplă) --}}
    @if (! empty($svc['features']))
        <section class="border-t border-zinc-200 bg-white py-16 lg:py-20">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-ink">{{ $svc['features_title'] ?? __('services.show.included_title') }}</h2>
                <ul class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @foreach ($svc['features'] as $feature)
                        <li class="flex items-start gap-3 rounded-xl border border-zinc-200 p-4 text-sm text-zinc-700">
                            <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-zinc-900 text-white">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </span>
                            {{ $feature }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    {{-- Add-on-uri / servicii suplimentare --}}
    @if (! empty($svc['addons']))
        <section class="border-t border-zinc-200 bg-paper py-16 lg:py-20">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-ink">{{ __('services.show.addons_title') }}</h2>
                <div class="mt-8 divide-y divide-zinc-200 overflow-hidden rounded-2xl border border-zinc-200 bg-white">
                    @foreach ($svc['addons'] as $addon)
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

    {{-- Notă --}}
    @if (! empty($svc['note']))
        <section class="bg-white">
            <div class="mx-auto max-w-4xl px-4 pb-4 sm:px-6 lg:px-8">
                <p class="text-sm text-muted">{{ $svc['note'] }} {{ __('services.show.vat_hint') }}</p>
            </div>
        </section>
    @endif

    {{-- FAQ specific serviciului (FAQPage schema injectat în controller) --}}
    <x-service-faq :faq="$svc['faq'] ?? []" />

    {{-- Alte servicii --}}
    <x-other-services :current="$serviceKey" />

    <x-cta-band
        :title="__('services.show.cta_title')"
        :text="__('services.show.cta_text')"
        :button="__('messages.cta.offer')"
        :href="Localization::route('contact')"
    />

@endsection
