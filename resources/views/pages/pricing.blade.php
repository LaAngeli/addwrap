@php use App\Support\Localization; @endphp

@extends('layouts.app')

@section('content')

    {{-- Hero — Split + mini-calculator dinamic (sincronizat cu config) --}}
    @php
        // Mini-calc din hero = DOAR abonament lunar (titlul „Estimează-ți abonamentul").
        // One-time-ul (creare site, brandbook, setări) trăiește în calculatorul complet
        // de mai jos. Item-urile vin din pricing.calculator.monthly; 'from' = estimativ.
        // 'addonPrice' = tarif redus, aplicat automat când item-ul e bifat împreună cu
        // alt serviciu (nu contează care; semnal de „client cu contract activ").
        $calcItems = [];
        foreach (config('site.pricing.calculator.monthly') as $key => $p) {
            $calcItems[] = [
                'key' => $key,
                'name' => __('calculator.items.'.$key),
                'price' => (int) $p['price'],
                'addonPrice' => isset($p['addon_price']) ? (int) $p['addon_price'] : null,
                'from' => (bool) $p['from'],
            ];
        }
        $addonBadge = __('calculator.addon_badge');
        $addonHint = __('calculator.addon_hint');
    @endphp
    <section class="relative overflow-hidden border-b border-zinc-200 bg-paper">
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
                        {{ __('pages.pricing.hero_eyebrow') }}
                    </p>
                    <h1 data-animate="fade-up" data-animate-delay="0.08" class="mt-5 text-4xl font-bold tracking-tight text-ink sm:mt-6 sm:text-6xl lg:text-7xl text-balance">{{ __('pages.pricing.hero_title') }}</h1>
                    <p data-animate="fade-up" data-animate-delay="0.16" class="mx-auto mt-5 max-w-xl text-lg text-muted sm:mt-6 sm:text-xl text-pretty lg:mx-0">{{ __('pages.pricing.hero_subtitle') }}</p>
                </div>

                {{-- B: ilustrație (între titlu și CTA pe mobil) --}}
                {{-- Mini-calculator dinamic — doar abonament lunar --}}
                <div
                    data-animate="scale-in"
                    x-data="{
                        items: @js($calcItems),
                        sel: {},
                        init() {
                            window.addEventListener('pageshow', (e) => { if (e.persisted) this.sel = {}; });
                        },
                        selectedCount() { return this.items.filter(i => this.sel[i.key]).length; },
                        priceFor(item) {
                            return (item.addonPrice !== null && this.sel[item.key] && this.selectedCount() > 1) ? item.addonPrice : item.price;
                        },
                        isAddon(item) {
                            return item.addonPrice !== null && this.sel[item.key] && this.selectedCount() > 1;
                        },
                        total() { let t = 0; this.items.forEach(i => { if (this.sel[i.key]) t += this.priceFor(i); }); return t; },
                        totalVat() { return Math.round(this.total() * 1.21); },
                        hasFrom() { return this.items.some(i => this.sel[i.key] && i.from); },
                        hasAddonActive() { return this.items.some(i => this.isAddon(i)); }
                    }"
                    class="mx-auto w-full max-w-md lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:max-w-none lg:self-center"
                >
                    <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-xl shadow-zinc-900/5 sm:p-7">
                        <div class="flex items-center justify-between">
                            <p class="font-semibold text-ink">{{ __('pages.pricing.hero_calc_title') }}</p>
                            <span class="text-xs text-muted">{{ __('pages.pricing.hero_calc_hint') }}</span>
                        </div>

                        <div class="mt-5 space-y-2.5">
                            @foreach ($calcItems as $item)
                                <button
                                    type="button"
                                    @click="sel['{{ $item['key'] }}'] = !sel['{{ $item['key'] }}']"
                                    :class="sel['{{ $item['key'] }}'] ? 'border-zinc-900 bg-zinc-50' : 'border-zinc-200 hover:border-zinc-400'"
                                    class="flex w-full items-center justify-between gap-3 rounded-xl border p-3 text-left transition"
                                    :aria-pressed="sel['{{ $item['key'] }}'] ? 'true' : 'false'"
                                >
                                    <span class="flex items-center gap-3">
                                        <span :class="sel['{{ $item['key'] }}'] ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-300 text-transparent'" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border transition">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                        </span>
                                        <span class="flex flex-col">
                                            <span class="text-sm font-semibold text-ink">{{ $item['name'] }}</span>
                                            <span x-show="isAddon(items[{{ $loop->index }}])" x-cloak class="text-[10px] font-semibold uppercase tracking-wide text-teal">{{ $addonBadge }}</span>
                                        </span>
                                    </span>
                                    <span class="shrink-0 text-sm font-semibold text-ink">
                                        @if ($item['from'])<span class="mr-0.5 text-[10px] font-medium uppercase tracking-wide text-muted">{{ __('calculator.from_prefix') }}</span> @endif<span x-text="priceFor(items[{{ $loop->index }}])">{{ $item['price'] }}</span> €<span class="text-xs font-medium text-muted">{{ __('calculator.unit_month') }}</span>
                                    </span>
                                </button>
                            @endforeach
                            <p x-show="hasAddonActive()" x-cloak class="text-xs text-muted">{{ $addonHint }}</p>
                        </div>

                        <div class="mt-5 rounded-2xl bg-zinc-900 p-4 text-white">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-zinc-400">{{ __('pages.pricing.hero_calc_total') }}</p>
                                    <p class="text-xs text-zinc-500">{{ __('pages.pricing.hero_calc_novat') }}</p>
                                </div>
                                <p class="text-right">
                                    <span class="text-sm font-medium text-zinc-400" x-show="hasFrom()" x-cloak>{{ __('calculator.from_prefix') }} </span><span class="text-3xl font-bold tracking-tight text-orange" x-text="total()">0</span><span class="text-sm text-zinc-300"> {{ __('pages.pricing.hero_calc_unit') }}</span>
                                </p>
                            </div>
                            <div class="mt-3 flex items-center justify-between gap-3 border-t border-white/10 pt-3">
                                <p class="text-sm text-zinc-300">{{ __('pages.pricing.hero_calc_withvat') }}</p>
                                <p class="text-right">
                                    <span class="text-sm font-medium text-zinc-400" x-show="hasFrom()" x-cloak>{{ __('calculator.from_prefix') }} </span><span class="text-lg font-bold" x-text="totalVat()">0</span><span class="text-sm text-zinc-400"> {{ __('pages.pricing.hero_calc_unit') }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- C: CTA + chips --}}
                <div class="text-center lg:col-start-1 lg:row-start-2 lg:text-left">
                    <div data-animate="fade-up" class="flex flex-col gap-3 sm:flex-row sm:justify-center lg:justify-start">
                        <a href="{{ Localization::route('contact') }}" class="w-full rounded-lg bg-orange px-6 py-3.5 text-base font-semibold text-white shadow-sm transition hover:bg-orange-deep hover:shadow-md sm:w-auto">{{ __('messages.cta.offer') }}</a>
                        <a href="#calculator" class="w-full rounded-lg border border-zinc-300 bg-white px-6 py-3.5 text-base font-semibold text-ink transition hover:border-zinc-900 sm:w-auto">{{ __('pages.pricing.hero_more') }}</a>
                    </div>
                    <div data-animate="fade-up" class="mt-6 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-muted sm:mt-8 lg:justify-start">
                        @foreach (__('pages.pricing.trust') as $chip)
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="h-4 w-4 text-zinc-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                {{ $chip }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Carduri de preț pe servicii --}}
    <section class="bg-paper py-12 sm:py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 data-animate="fade-up" class="text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ __('pages.pricing.cards_title') }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ __('pages.pricing.cards_subtitle') }}</p>
            </div>

            <div data-animate-group class="mt-10 grid grid-cols-2 gap-3 sm:mt-14 sm:gap-6 lg:grid-cols-3">
                @foreach (__('pages.pricing.cards') as $card)
                    <div class="relative flex flex-col rounded-2xl border border-zinc-200 bg-white p-4 transition hover:-translate-y-1 card-hover-neon sm:p-8">
                        <h3 class="text-base font-semibold text-ink sm:text-lg">{{ __('services.items.'.$card['key'].'.name') }}</h3>
                        <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-muted sm:line-clamp-none">{{ __('services.items.'.$card['key'].'.excerpt') }}</p>

                        <div class="mt-4 sm:mt-6">
                            <span class="text-3xl font-bold tracking-tight text-ink">{{ $card['price'] }}</span>
                            <span class="text-sm text-muted">{{ $card['period'] }}</span>
                            @if (! empty($card['note']))
                                <p class="mt-1 text-xs text-muted">{{ $card['note'] }}</p>
                            @endif
                        </div>

                        <div class="mt-5 flex flex-1 flex-col justify-end gap-2 sm:mt-8 sm:gap-3">
                            <a href="{{ Localization::route('contact') }}" class="block rounded-lg bg-orange px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-orange-deep">{{ __('services.show.price_cta') }}</a>
                            <a href="{{ Localization::serviceUrl($card['key']) }}" class="text-center text-sm font-medium text-muted transition hover:text-ink">{{ __('messages.cta.learn_more') }} &rarr;</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Calculator de buget (element interactiv central) --}}
    <section id="calculator" class="scroll-mt-20 border-y border-zinc-200 bg-paper py-12 sm:py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-8 max-w-2xl text-center sm:mb-10">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('calculator.eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ __('calculator.title') }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ __('calculator.subtitle') }}</p>
            </div>
            <div data-animate="scale-in">
                <livewire:budget-calculator />
            </div>
        </div>
    </section>

    {{-- Lista completă de prețuri — structurată pe tip de plată --}}
    <section class="bg-paper py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 data-animate="fade-up" class="text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ __('pages.pricing.full_list_title') }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ __('pages.pricing.full_list_subtitle') }}</p>
            </div>

            <div data-animate-group class="mt-8 grid grid-cols-1 gap-4 sm:mt-12 sm:gap-6 lg:grid-cols-2">
                @foreach (__('pages.pricing.table_groups') as $group)
                    <div class="rounded-2xl border border-zinc-200 bg-white p-5 card-neon-active sm:p-8">
                        <div class="flex items-center gap-3">
                            <span class="inline-block h-2 w-2 rounded-full bg-zinc-900"></span>
                            <h3 class="text-sm font-semibold uppercase tracking-wider text-ink">{{ $group['title'] }}</h3>
                        </div>
                        <ul class="mt-5 divide-y divide-zinc-100">
                            @foreach ($group['rows'] as $row)
                                <li class="flex items-baseline justify-between gap-4 py-2.5 sm:py-3">
                                    <span class="text-sm text-zinc-700">{{ $row['service'] }}</span>
                                    <span class="shrink-0 text-sm font-bold text-ink">{{ $row['price'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <p class="mt-8 text-center text-sm text-muted">{{ __('pages.pricing.tax_note') }}</p>
        </div>
    </section>

    {{-- FAQ prețuri --}}
    <section class="border-t border-zinc-200 bg-paper py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-center text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ __('pages.pricing.faq_title') }}</h2>
            <div class="mt-8 divide-y divide-zinc-200 sm:mt-10" x-data="{ open: null }">
                @foreach (__('pages.pricing.faq') as $i => $item)
                    <div class="py-2">
                        <button type="button" @click="open === {{ $i }} ? open = null : open = {{ $i }}" class="flex w-full items-center justify-between gap-4 py-4 text-left" :aria-expanded="open === {{ $i }}">
                            <span class="text-lg font-medium text-ink">{{ $item['q'] }}</span>
                            <svg class="h-5 w-5 shrink-0 text-zinc-900 transition" :class="open === {{ $i }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div x-show="open === {{ $i }}" x-collapse x-cloak>
                            <p class="pb-4 text-muted">{{ $item['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Ofertă personalizată --}}
    <x-cta-band
        :title="__('pages.pricing.custom_title')"
        :text="__('pages.pricing.custom_text')"
        :button="__('pages.pricing.custom_cta')"
        :href="Localization::route('contact')"
    />

@endsection
