@php
    use App\Support\Localization;

    $svc = __('services.items.'.$serviceKey);
    $page = __('service_pages.'.$serviceKey);
    $modules = $svc['modules'] ?? [];
    $price = $svc['price'] ?? null;
@endphp

@extends('layouts.app')

@section('content')

    {{-- Hero --}}
    <section class="border-b border-zinc-200 bg-paper">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-14 lg:px-8 lg:py-20">
            <x-breadcrumbs />

            <div class="mt-6 grid grid-cols-1 gap-6 sm:mt-8 sm:gap-8 lg:grid-cols-2 lg:items-center">
                {{-- A: text --}}
                <div class="lg:col-start-1 lg:row-start-1">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-zinc-900 text-white">
                            <x-service-icon :name="$service['icon'] ?? 'palette'" class="h-6 w-6" />
                        </span>
                    </div>
                    <h1 data-animate="fade-up" class="mt-6 text-balance">
                        <span class="block text-sm font-semibold uppercase tracking-wider text-muted">{{ $svc['name'] }}</span>
                        <span class="mt-3 block text-4xl font-bold tracking-tight text-ink sm:text-5xl">{{ $svc['tagline'] }}</span>
                    </h1>
                    <p data-animate="fade-up" class="mt-5 text-lg text-muted">{{ $svc['description'] }}</p>

                    @if ($price)
                        <div class="mt-8 flex flex-wrap items-baseline gap-x-3 gap-y-1">
                            <span class="text-3xl font-bold tracking-tight text-ink">{{ $price['amount'] }}</span>
                            <span class="text-sm text-muted">{{ $price['frequency'] ?? '' }} · {{ $price['vat'] ?? '' }}</span>
                        </div>
                    @endif

                </div>

                {{-- B: ilustrație (între text și CTA pe mobil) --}}
                {{-- Brand board interactiv --}}
                <div
                    data-animate="scale-in"
                    x-data="{
                        sel: 0,
                        swatches: [
                            { bg: '#18181b', text: '#ffffff' },
                            { bg: '#3f3f46', text: '#ffffff' },
                            { bg: '#a1a1aa', text: '#ffffff' },
                            { bg: '#e4e4e7', text: '#18181b' },
                            { bg: '#fafafa', text: '#18181b' },
                        ],
                        w: 3,
                        weights: ['font-light', 'font-normal', 'font-bold', 'font-black'],
                        labels: ['Light', 'Regular', 'Bold', 'Black'],
                        pp: 0,
                        patterns: ['bg-dot-grid', 'bg-stripes', 'bg-grid'],
                        patternNames: {!! app()->getLocale() === 'ro' ? "['Puncte', 'Linii', 'Grilă']" : "['Dots', 'Lines', 'Grid']" !!},
                    }"
                    class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:self-center"
                >
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wider text-muted">Brand board</span>
                        <span class="text-xs text-muted">{{ app()->getLocale() === 'ro' ? 'apasă culorile' : 'tap the colors' }}</span>
                    </div>

                    {{-- Preview logo (fundal dinamic) --}}
                    <div class="mt-4 flex items-center justify-center rounded-2xl py-10 transition-colors duration-300" :style="{ backgroundColor: swatches[sel].bg }">
                        {{-- Marca addWrap (culoare dinamică după swatch, dimensiune mică).
                             `::style` (dublu „:") = escape Blade → randează literal `:style`
                             pentru Alpine, nu binding de atribut Blade (PHP). --}}
                        <x-brand-mark class="h-9 w-auto transition-colors duration-300" ::style="{ color: swatches[sel].text }" />
                    </div>

                    {{-- Paletă (clickabilă) --}}
                    <div class="mt-4 grid grid-cols-5 gap-2">
                        <template x-for="(s, i) in swatches" :key="i">
                            <button
                                type="button"
                                @click="sel = i"
                                :style="{ backgroundColor: s.bg }"
                                :class="sel === i ? 'ring-2 ring-zinc-900 ring-offset-2' : 'border border-zinc-200'"
                                class="h-10 rounded-lg transition"
                                :aria-pressed="sel === i ? 'true' : 'false'"
                            ></button>
                        </template>
                    </div>

                    {{-- Tipografie (clic = schimbă greutatea) + pattern --}}
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        <button type="button" @click="w = (w + 1) % weights.length" class="rounded-2xl border border-zinc-200 p-4 text-left transition hover:border-zinc-400">
                            <div class="text-3xl text-ink" :class="weights[w]">Aa</div>
                            <div class="mt-1 text-xs text-muted">Instrument Sans · <span x-text="labels[w]"></span></div>
                        </button>
                        <button type="button" @click="pp = (pp + 1) % patterns.length" :class="patterns[pp]" class="overflow-hidden rounded-2xl border border-zinc-200 p-4 text-left transition hover:border-zinc-400">
                            <div class="text-2xl font-bold text-ink">Pattern</div>
                            <div class="mt-1 text-xs text-muted">Design · <span x-text="patternNames[pp]"></span></div>
                        </button>
                    </div>
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

    {{-- Stepper interactiv: ce conține pachetul (modulele I-V) --}}
    @if (! empty($modules))
        <section class="bg-white py-12 sm:py-16 lg:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $page['modules_eyebrow'] }}</p>
                    <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ $page['modules_title'] }}</h2>
                    <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ $page['modules_subtitle'] }}</p>
                </div>

                <div x-data="{ active: 0 }" class="mt-14">
                    {{-- Pași --}}
                    <div class="flex gap-2 overflow-x-auto pb-2 lg:flex-wrap lg:justify-center lg:overflow-visible lg:pb-0">
                        @foreach ($modules as $i => $module)
                            <button
                                type="button"
                                @click="active = {{ $i }}"
                                :class="active === {{ $i }} ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-200 text-zinc-700 hover:border-zinc-400'"
                                class="shrink-0 rounded-full border px-4 py-2 text-sm font-semibold transition"
                            >
                                {{ $module['title'] }}
                            </button>
                        @endforeach
                    </div>

                    {{-- Panou --}}
                    <div class="mx-auto mt-8 max-w-3xl">
                        @foreach ($modules as $i => $module)
                            <div
                                x-show="active === {{ $i }}"
                                x-cloak
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-3"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="rounded-3xl border border-zinc-200 p-6 sm:p-8"
                            >
                                <h3 class="text-xl font-bold text-ink">{{ $module['title'] }}</h3>
                                <ul class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">
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
            </div>
        </section>
    @endif

    {{-- Livrabile (board) --}}
    <section class="border-y border-zinc-200 bg-paper py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $page['board_eyebrow'] }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ $page['board_title'] }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ $page['board_subtitle'] }}</p>
            </div>
            <div data-animate-group class="mt-8 grid grid-cols-2 gap-3 sm:mt-12 sm:gap-6 lg:grid-cols-3">
                @foreach ($page['board'] as $item)
                    <div class="rounded-2xl border border-zinc-200 bg-white p-4 transition hover:-translate-y-1 hover:border-zinc-900 hover:shadow-lg sm:p-6">
                        <h3 class="font-semibold text-ink">{{ $item['label'] }}</h3>
                        <p class="mt-1 text-sm text-muted">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
            <p class="mt-8 text-center text-sm text-muted">{{ $page['board_note'] }}</p>
        </div>
    </section>

    {{-- Pachet flexibil --}}
    @if (! empty($svc['highlight']))
        <section class="bg-white py-12 sm:py-16 lg:py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative overflow-hidden rounded-3xl bg-zinc-900 p-8 text-white sm:p-12">
                    <div class="bg-dot-grid pointer-events-none absolute inset-0 opacity-[0.12]"></div>
                    <div class="relative">
                        <p class="text-sm font-semibold uppercase tracking-wider text-zinc-400">{{ $svc['highlight']['title'] }}</p>
                        <p class="mt-3 max-w-3xl text-xl font-medium">{{ $svc['highlight']['text'] }}</p>
                        <a href="{{ Localization::route('contact') }}" class="mt-6 inline-block rounded-lg bg-white px-6 py-3 text-sm font-semibold text-zinc-900 transition hover:bg-zinc-200">{{ $page['price_cta'] }}</a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Proces --}}
    <section class="border-t border-zinc-200 bg-paper py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('pages.home.process_eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ __('pages.home.process_title') }}</h2>
            </div>
            <div data-animate-group class="mt-10 grid grid-cols-2 gap-6 sm:mt-14 sm:gap-8 lg:grid-cols-4">
                @foreach (__('pages.home.process_steps') as $i => $step)
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
    <x-service-faq :faq="$svc['faq'] ?? []" />

    <x-other-services :current="$serviceKey" />

    <x-cta-band
        :title="__('services.show.cta_title')"
        :text="__('services.show.cta_text')"
        :button="__('messages.cta.offer')"
        :href="Localization::route('contact')"
    />

@endsection
