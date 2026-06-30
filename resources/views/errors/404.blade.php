@php
    use App\Support\Localization;
    use App\Support\Seo;

    /*
    | Setăm starea SEO ÎNAINTE ca layout-ul să randeze <head> — meta-uri proprii
    | pentru pagina 404, plus noindex/nofollow (404 nu trebuie indexat).
    */
    app(Seo::class)
        ->title(__('errors.404.meta_title'))
        ->description(__('errors.404.subtitle'))
        ->noindex();
@endphp

@extends('layouts.app')

@section('content')

    {{-- Hero 404 --}}
    <section class="relative overflow-hidden bg-white">
        <div class="bg-dot-grid pointer-events-none absolute inset-0 -z-10 opacity-40 [mask-image:radial-gradient(ellipse_at_center,black,transparent_60%)]"></div>
        <div class="pointer-events-none absolute -right-32 -top-32 -z-10 h-96 w-96 rounded-full bg-zinc-100 blur-3xl"></div>

        <div class="mx-auto max-w-3xl px-4 pt-20 pb-16 text-center sm:px-6 sm:pt-24 lg:px-8 lg:py-32">
            {{-- 404 vizual (decorativ, ascuns pentru screen-reader) --}}
            <p data-animate="scale-in" aria-hidden="true" class="select-none text-[7rem] font-black leading-none tracking-tighter text-zinc-100 sm:text-[10rem] lg:text-[14rem]">404</p>

            <p data-animate="fade-up" class="-mt-4 inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-white/80 px-4 py-1.5 text-sm font-medium text-muted backdrop-blur sm:-mt-6 lg:-mt-10">
                <span class="relative flex h-2 w-2">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-zinc-900 opacity-60"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-zinc-900"></span>
                </span>
                {{ __('errors.404.eyebrow') }}
            </p>

            <h1 data-animate="fade-up" data-animate-delay="0.08" class="mt-6 text-3xl font-bold tracking-tight text-ink sm:text-5xl lg:text-6xl text-balance">
                {{ __('errors.404.title') }}
            </h1>

            <p data-animate="fade-up" data-animate-delay="0.16" class="mx-auto mt-5 max-w-xl text-base text-muted sm:text-lg text-pretty">
                {{ __('errors.404.subtitle') }}
            </p>

            <div data-animate="fade-up" data-animate-delay="0.24" class="mt-10 flex flex-col gap-3 sm:flex-row sm:justify-center">
                <a href="{{ Localization::route('home') }}" class="w-full rounded-lg bg-zinc-900 px-6 py-3.5 text-base font-semibold text-white shadow-sm transition hover:bg-black hover:shadow-md sm:w-auto">
                    {{ __('errors.404.cta_home') }}
                </a>
                <a href="{{ Localization::route('contact') }}" class="w-full rounded-lg border border-zinc-300 bg-white px-6 py-3.5 text-base font-semibold text-ink transition hover:border-zinc-900 sm:w-auto">
                    {{ __('errors.404.cta_contact') }}
                </a>
            </div>
        </div>
    </section>

    {{-- Scurtături către secțiunile principale --}}
    @php
        $shortcuts = [
            ['route' => 'services.index', 'label' => __('messages.nav.services')],
            ['route' => 'portfolio',      'label' => __('messages.nav.portfolio')],
            ['route' => 'blog',           'label' => __('messages.nav.blog')],
            ['route' => 'pricing',        'label' => __('messages.nav.pricing')],
            ['route' => 'about',          'label' => __('messages.nav.about')],
            ['route' => 'faq',            'label' => __('messages.nav.faq')],
        ];
    @endphp
    <section class="border-t border-zinc-200 bg-paper py-16 lg:py-20">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('errors.404.help_eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-2xl font-bold tracking-tight text-ink sm:text-3xl">{{ __('errors.404.help_title') }}</h2>
            </div>

            <div data-animate-group class="mt-10 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">
                @foreach ($shortcuts as $sc)
                    <a
                        href="{{ Localization::route($sc['route']) }}"
                        class="group flex items-center justify-between gap-3 rounded-xl border border-zinc-200 bg-white p-4 transition hover:-translate-y-0.5 hover:border-zinc-900 hover:shadow-md"
                    >
                        <span class="text-sm font-medium text-ink">{{ $sc['label'] }}</span>
                        <svg class="h-4 w-4 shrink-0 text-zinc-400 transition group-hover:translate-x-0.5 group-hover:text-ink" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

@endsection
