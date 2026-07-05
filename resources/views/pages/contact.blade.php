@php
    use App\Support\Localization;
    $company = config('site.company');
    $phoneHref = preg_replace('/\s+/', '', $company['phone']);
@endphp

@extends('layouts.app')

@section('content')

    {{-- Hero — Split + chat interactiv --}}
    @php $chat = __('pages.contact.hero_chat'); @endphp
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
                        {{ __('pages.contact.response_badge') }}
                    </p>
                    <h1 data-animate="fade-up" data-animate-delay="0.08" class="mt-6 text-4xl font-bold tracking-tight text-ink sm:text-6xl lg:text-7xl text-balance">{{ __('pages.contact.hero_title') }}</h1>
                    <p data-animate="fade-up" data-animate-delay="0.16" class="mx-auto mt-5 max-w-xl text-lg text-muted sm:mt-6 sm:text-xl text-pretty lg:mx-0">{{ __('pages.contact.hero_subtitle') }}</p>
                </div>

                {{-- B: chat interactiv (între titlu și CTA pe mobil) --}}
                <div data-animate="scale-in" x-data="{ sel: 0 }" class="mx-auto w-full max-w-md lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:max-w-none lg:self-center">
                    <div class="overflow-hidden rounded-3xl border border-zinc-200 bg-white shadow-xl shadow-zinc-900/5">
                        {{-- Header --}}
                        <div class="flex items-center gap-3 border-b border-zinc-200 bg-zinc-50 px-5 py-4">
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-zinc-900">
                                <x-brand-glyph class="h-3 w-auto text-white" />
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-ink">addWrap</p>
                                <p class="flex items-center gap-1.5 text-xs text-muted"><span class="h-1.5 w-1.5 rounded-full bg-zinc-900"></span>{{ __('pages.contact.response_badge') }}</p>
                            </div>
                        </div>

                        {{-- Conversație --}}
                        <div class="relative min-h-[208px] space-y-3 p-5">
                            @foreach ($chat as $i => $msg)
                                <div
                                    x-show="sel === {{ $i }}"
                                    @unless ($loop->first) x-cloak @endunless
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    class="absolute inset-0 flex flex-col justify-center gap-3 p-5"
                                >
                                    <div class="flex justify-end">
                                        <p class="max-w-[80%] rounded-2xl rounded-br-sm bg-zinc-900 px-4 py-2.5 text-sm text-white">{{ $msg['q'] }}</p>
                                    </div>
                                    <div class="flex justify-start">
                                        <p class="max-w-[85%] rounded-2xl rounded-bl-sm bg-zinc-100 px-4 py-2.5 text-sm text-zinc-800">{{ $msg['a'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Întrebări rapide --}}
                        <div class="flex flex-wrap gap-2 border-t border-zinc-200 p-4">
                            @foreach ($chat as $i => $msg)
                                <button
                                    type="button"
                                    @click="sel = {{ $i }}"
                                    :class="sel === {{ $i }} ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-200 text-zinc-600 hover:border-zinc-400'"
                                    class="rounded-full border px-3 py-1.5 text-xs font-semibold transition"
                                >{{ $msg['q'] }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- C: CTA --}}
                <div class="text-center lg:col-start-1 lg:row-start-2 lg:text-left">
                    <div data-animate="fade-up" class="flex flex-col gap-3 sm:flex-row sm:justify-center lg:justify-start">
                        <a href="#form" class="w-full rounded-lg bg-orange px-6 py-3.5 text-base font-semibold text-white shadow-sm transition hover:bg-orange-deep hover:shadow-md sm:w-auto">{{ __('pages.contact.hero_cta_write') }}</a>
                        <a href="https://wa.me/{{ $company['whatsapp'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-zinc-300 bg-white px-6 py-3.5 text-base font-semibold text-ink transition hover:border-zinc-900 sm:w-auto">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.71.306 1.263.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.885-9.885 9.885z" /></svg>
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Date contact + formular --}}
    <section id="form" class="scroll-mt-20 bg-paper py-16 lg:py-24">
        <div class="mx-auto grid max-w-6xl grid-cols-1 gap-10 px-4 sm:px-6 lg:grid-cols-5 lg:gap-16 lg:px-8">

            {{-- Panou de contact --}}
            <div class="lg:col-span-2">
                <h2 class="text-xl font-semibold text-ink">{{ __('pages.contact.info_title') }}</h2>

                <div class="mt-6 space-y-3">
                    {{-- Email --}}
                    <a href="mailto:{{ $company['email'] }}" class="flex items-center gap-4 rounded-2xl border border-zinc-200 p-4 transition hover:border-zinc-400 hover:bg-zinc-50">
                        <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-zinc-900 text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </span>
                        <span>
                            <span class="block text-xs font-semibold uppercase tracking-wider text-muted">{{ __('contact.fields.email') }}</span>
                            <span class="block font-medium text-ink">{{ $company['email'] }}</span>
                        </span>
                    </a>

                    {{-- Telefon --}}
                    <a href="tel:{{ $phoneHref }}" class="flex items-center gap-4 rounded-2xl border border-zinc-200 p-4 transition hover:border-zinc-400 hover:bg-zinc-50">
                        <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-zinc-900 text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 5a2 2 0 012-2h2.6a1 1 0 01.95.68l1.2 3.5a1 1 0 01-.5 1.2L8 9.6a12 12 0 006.4 6.4l1.2-1.5a1 1 0 011.2-.5l3.5 1.2a1 1 0 01.68.95V19a2 2 0 01-2 2A16 16 0 013 5z" /></svg>
                        </span>
                        <span>
                            <span class="block text-xs font-semibold uppercase tracking-wider text-muted">{{ __('contact.fields.phone') }}</span>
                            <span class="block font-medium text-ink">{{ $company['phone'] }}</span>
                        </span>
                    </a>

                    {{-- WhatsApp --}}
                    <a href="https://wa.me/{{ $company['whatsapp'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-4 rounded-2xl border border-zinc-200 p-4 transition hover:border-zinc-400 hover:bg-zinc-50">
                        <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-zinc-900 text-white">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12.04 2a9.9 9.9 0 00-8.4 15.16L2 22l4.96-1.3A9.9 9.9 0 1012.04 2zm0 1.8a8.1 8.1 0 11-4.13 15.06l-.3-.18-2.94.77.78-2.87-.2-.3A8.1 8.1 0 0112.04 3.8zm4.66 11.49c-.25-.13-1.47-.72-1.7-.8-.23-.09-.4-.13-.56.13-.17.25-.64.8-.79.97-.14.17-.29.19-.54.06-.25-.13-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.38-1.72-.14-.25-.02-.39.11-.51.11-.11.25-.29.37-.43.13-.14.17-.25.25-.41.08-.17.04-.31-.02-.44-.06-.13-.56-1.35-.77-1.85-.2-.48-.41-.42-.56-.42l-.48-.01c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.23.9 2.42 1.03 2.59.13.17 1.77 2.7 4.3 3.79.6.26 1.07.41 1.43.53.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.14-1.18-.06-.1-.23-.16-.48-.29z" /></svg>
                        </span>
                        <span>
                            <span class="block text-xs font-semibold uppercase tracking-wider text-muted">{{ __('pages.contact.whatsapp') }}</span>
                            <span class="block font-medium text-ink">{{ $company['phone'] }}</span>
                        </span>
                    </a>
                </div>

                {{-- Social --}}
                <p class="mt-8 text-sm font-semibold uppercase tracking-wider text-muted">{{ __('pages.contact.social_title') }}</p>
                <div class="mt-3 flex gap-3">
                    @foreach ($company['social'] as $network => $url)
                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($network) }}" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-zinc-200 text-zinc-700 transition hover:border-zinc-900 hover:text-ink">
                            @switch($network)
                                @case('facebook') <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M13.5 9H16l.5-3h-3V4.5c0-.87.3-1.5 1.6-1.5H16V.3C15.7.27 14.8.2 13.8.2 11.6.2 10 1.6 10 4.1V6H7v3h3v9h3.5z" /></svg> @break
                                @case('instagram') <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5" stroke-width="1.7"/><circle cx="12" cy="12" r="4" stroke-width="1.7"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg> @break
                                @case('whatsapp') <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.71.306 1.263.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.885-9.885 9.885m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" /></svg> @break
                                @default <span class="h-2 w-2 rounded-full bg-current"></span>
                            @endswitch
                        </a>
                    @endforeach
                </div>

                {{-- Alternativă ghidată --}}
                <div class="relative overflow-hidden mt-8 rounded-2xl bg-teal-ink p-6 text-white">
                    <div class="bg-dot-grid pointer-events-none absolute inset-0 opacity-[0.12]"></div>
                    <div class="relative">
                        <p class="font-semibold">{{ __('pages.contact.guided_title') }}</p>
                        <p class="mt-1 text-sm text-zinc-400">{{ __('pages.contact.guided_text') }}</p>
                        <a href="{{ Localization::route('pricing') }}#calculator" class="mt-4 inline-block rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-zinc-900 transition hover:bg-zinc-200">{{ __('pages.contact.start_project') }}</a>
                    </div>
                </div>
            </div>

            {{-- Formular --}}
            <div class="lg:col-span-3">
                <div class="rounded-2xl border border-zinc-200 p-6 sm:p-8">
                    <h2 class="text-xl font-semibold text-ink">{{ __('pages.contact.form_title') }}</h2>
                    <div class="mt-6">
                        <livewire:contact-form />
                    </div>
                </div>

                {{-- Explorează --}}
                <div class="mt-6 flex flex-wrap items-center gap-2 rounded-2xl border border-zinc-200 bg-paper p-4 text-sm">
                    <span class="font-medium text-ink">{{ __('pages.contact.explore_title') }}</span>
                    <a href="{{ Localization::route('portfolio') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-zinc-200 bg-white px-3 py-1.5 font-medium text-zinc-700 transition hover:border-zinc-900 hover:text-ink">
                        {{ __('messages.nav.portfolio') }}
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                    <a href="{{ Localization::route('faq') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-zinc-200 bg-white px-3 py-1.5 font-medium text-zinc-700 transition hover:border-zinc-900 hover:text-ink">
                        {{ __('messages.nav.faq') }}
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                    <a href="{{ Localization::route('blog') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-zinc-200 bg-white px-3 py-1.5 font-medium text-zinc-700 transition hover:border-zinc-900 hover:text-ink">
                        {{ __('messages.nav.blog') }}
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Ce urmează --}}
    <section class="border-t border-zinc-200 bg-paper py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-center text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ __('pages.contact.steps_title') }}</h2>
            <div data-animate-group class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-3">
                @foreach (__('pages.contact.steps') as $i => $step)
                    <div>
                        <span class="text-4xl font-bold text-zinc-200">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="mt-3 text-lg font-semibold text-ink">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted">{{ $step['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Întrebări frecvente --}}
    <section class="border-t border-zinc-200 bg-paper py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-3 lg:gap-16">

                {{-- Titlu + card ajutor --}}
                <div class="lg:col-span-1">
                    <h2 class="text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ __('pages.contact.faq_title') }}</h2>
                    <p class="mt-4 text-lg text-muted">{{ __('pages.contact.faq_subtitle') }}</p>

                    <div class="relative overflow-hidden mt-8 rounded-3xl bg-teal-ink p-6 text-white">
                        <div class="bg-dot-grid pointer-events-none absolute inset-0 opacity-[0.12]"></div>
                        <div class="relative">
                        <p class="font-semibold">{{ __('pages.contact.faq_help_title') }}</p>
                        <p class="mt-1 text-sm text-zinc-400">{{ __('pages.contact.faq_help_text') }}</p>
                        <div class="mt-5 flex flex-col gap-2">
                            <a href="https://wa.me/{{ $company['whatsapp'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-zinc-900 transition hover:bg-zinc-200">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.71.306 1.263.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.885-9.885 9.885m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" /></svg>
                                WhatsApp
                            </a>
                            <a href="mailto:{{ $company['email'] }}" class="inline-flex items-center justify-center rounded-lg border border-white/20 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-white/10">{{ $company['email'] }}</a>
                        </div>
                        </div>
                    </div>
                </div>

                {{-- Accordion --}}
                <div class="lg:col-span-2" x-data="{ open: null }">
                    <div class="divide-y divide-zinc-200 overflow-hidden rounded-3xl border border-zinc-200 bg-white">
                        @foreach (__('pages.contact.faq') as $i => $item)
                            <div>
                                <button type="button" @click="open === {{ $i }} ? open = null : open = {{ $i }}" class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left transition hover:bg-zinc-50" :aria-expanded="open === {{ $i }} ? 'true' : 'false'">
                                    <span class="font-semibold text-ink">{{ $item['q'] }}</span>
                                    <svg class="h-5 w-5 shrink-0 text-zinc-900 transition-transform duration-200" :class="open === {{ $i }} ? 'rotate-45' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14" /></svg>
                                </button>
                                <div x-show="open === {{ $i }}" x-collapse x-cloak>
                                    <p class="px-6 pb-5 text-sm leading-relaxed text-muted">{{ $item['a'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <x-turnstile-scripts />
@endpush
