@php use App\Support\Localization; @endphp

@extends('layouts.app')

@section('content')

    {{-- Hero — Split + help center interactiv --}}
    @php
        $heroFaq = collect(__('faq.categories'))->map(fn ($c) => [
            'title' => $c['title'],
            'q' => $c['items'][0]['q'] ?? '',
            'a' => $c['items'][0]['a'] ?? '',
        ])->take(4)->values();
    @endphp
    <section class="relative overflow-hidden border-b border-zinc-200 bg-paper">
        <div class="bg-dot-grid pointer-events-none absolute inset-0 -z-10 opacity-[0.5] [mask-image:radial-gradient(ellipse_at_top_right,black,transparent_65%)]"></div>
        <div class="pointer-events-none absolute -right-32 -top-32 -z-10 h-96 w-96 rounded-full bg-zinc-100 blur-3xl"></div>

        <div class="mx-auto max-w-7xl px-4 pt-16 pb-16 sm:px-6 sm:pt-20 lg:px-8 lg:py-28">
            <div class="grid grid-cols-1 items-center gap-14 lg:grid-cols-2 lg:gap-12">

                {{-- Text --}}
                <div class="text-center lg:text-left">
                    <p data-animate="fade-up" class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-white/80 px-4 py-1.5 text-sm font-medium text-muted backdrop-blur">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-orange opacity-60"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-orange"></span>
                        </span>
                        {{ __('faq.eyebrow') }}
                    </p>
                    <h1 data-animate="fade-up" data-animate-delay="0.08" class="mt-6 text-4xl font-bold tracking-tight text-ink sm:text-6xl lg:text-7xl text-balance">{{ __('faq.title') }}</h1>
                    <p data-animate="fade-up" data-animate-delay="0.16" class="mx-auto mt-5 max-w-xl text-lg text-muted sm:mt-6 sm:text-xl text-pretty lg:mx-0">{{ __('faq.subtitle') }}</p>

                    <div data-animate="fade-up" data-animate-delay="0.24" class="mt-9 flex flex-col gap-3 sm:flex-row sm:justify-center lg:justify-start">
                        <a href="#intrebari" class="w-full rounded-lg bg-orange px-6 py-3.5 text-base font-semibold text-white shadow-sm transition hover:bg-orange-deep hover:shadow-md sm:w-auto">{{ __('faq.hero_cta') }}</a>
                        <a href="{{ Localization::route('contact') }}" class="w-full rounded-lg border border-zinc-300 bg-white px-6 py-3.5 text-base font-semibold text-ink transition hover:border-zinc-900 sm:w-auto">{{ __('messages.nav.contact') }}</a>
                    </div>
                </div>

                {{-- Help center interactiv --}}
                <div data-animate="scale-in" x-data="{ sel: 0 }" class="mx-auto w-full max-w-md lg:max-w-none">
                    <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-xl shadow-zinc-900/5 sm:p-7">
                        {{-- Bară de căutare (decorativă) --}}
                        <div class="flex items-center gap-2 rounded-full border border-zinc-200 bg-zinc-50 px-4 py-2.5">
                            <svg class="h-4 w-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-width="2" d="M21 21l-4.3-4.3m1.8-4.7a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            <span class="text-sm text-muted">{{ __('faq.hero_search') }}</span>
                        </div>

                        {{-- Chips categorii --}}
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($heroFaq as $i => $item)
                                <button
                                    type="button"
                                    @click="sel = {{ $i }}"
                                    :class="sel === {{ $i }} ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-200 text-zinc-600 hover:border-zinc-400'"
                                    class="rounded-full border px-3 py-1.5 text-xs font-semibold transition"
                                >{{ $item['title'] }}</button>
                            @endforeach
                        </div>

                        {{-- Preview întrebare + răspuns --}}
                        <div class="relative mt-4 min-h-[150px]">
                            @foreach ($heroFaq as $i => $item)
                                <div
                                    x-show="sel === {{ $i }}"
                                    @unless ($loop->first) x-cloak @endunless
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    class="absolute inset-0 rounded-2xl border border-zinc-200 bg-paper p-5"
                                >
                                    <div class="flex items-start gap-2">
                                        <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-zinc-900 text-[10px] font-bold text-white">?</span>
                                        <p class="text-sm font-semibold text-ink">{{ $item['q'] }}</p>
                                    </div>
                                    <p class="mt-3 text-sm leading-relaxed text-muted line-clamp-4">{{ $item['a'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="intrebari" class="scroll-mt-20 bg-paper py-16 lg:py-24">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            {{-- Navigare rapidă pe categorii --}}
            <div class="flex flex-wrap justify-center gap-2">
                @foreach (__('faq.categories') as $cat)
                    <a href="#{{ $cat['id'] }}" class="rounded-full border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 transition hover:border-zinc-900 hover:text-ink">
                        {{ $cat['title'] }}
                    </a>
                @endforeach
            </div>

            {{-- Grupuri de întrebări --}}
            <div class="mt-16 space-y-16">
                @foreach (__('faq.categories') as $cat)
                    <div id="{{ $cat['id'] }}" class="scroll-mt-28">
                        <h2 class="text-2xl font-bold tracking-tight text-ink">{{ $cat['title'] }}</h2>

                        <div class="mt-6 divide-y divide-zinc-200 border-t border-zinc-200" x-data="{ open: null }">
                            @foreach ($cat['items'] as $i => $item)
                                <div class="py-2">
                                    <button
                                        type="button"
                                        @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                                        class="flex w-full items-center justify-between gap-4 py-4 text-left"
                                        :aria-expanded="open === {{ $i }}"
                                    >
                                        <span class="text-lg font-medium text-ink">{{ $item['q'] }}</span>
                                        <svg class="h-5 w-5 shrink-0 text-zinc-900 transition" :class="open === {{ $i }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                    </button>
                                    <div x-show="open === {{ $i }}" x-collapse x-cloak>
                                        <p class="pb-4 leading-relaxed text-muted">{{ $item['a'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA: nu ai găsit răspunsul --}}
    <x-cta-band
        :title="__('faq.cta_title')"
        :text="__('faq.cta_text')"
        :button="__('messages.nav.contact')"
        :href="Localization::route('contact')"
    />

@endsection
