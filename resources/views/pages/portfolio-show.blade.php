@php
    use App\Support\Projects;
    use App\Support\Localization;

    $c = Projects::content($project);
    $blocks = $c['blocks'] ?? [];
    $metrics = $c['metrics'] ?? [];
@endphp

@extends('layouts.app')

@section('content')

    {{-- Hero --}}
    <section class="bg-paper">
        <div class="mx-auto max-w-7xl px-4 pt-14 sm:px-6 lg:px-8 lg:pt-20">
            <x-breadcrumbs />

            <div class="mt-6 max-w-3xl">
                <img src="{{ asset('images/partners/'.($project['logo'] ?? $slug).'.png') }}" alt="{{ $project['client'] ?? '' }}" height="240" class="h-9 w-auto max-w-[220px] object-contain sm:h-10" loading="lazy" decoding="async">
                <div class="mt-5 flex flex-wrap items-center gap-2 text-xs text-muted">
                    <span class="rounded-full bg-deep px-3 py-1 font-semibold uppercase tracking-wider text-white">{{ $c['tag'] ?? __('portfolio.categories.'.($project['category'] ?? 'general')) }}</span>
                    <span aria-hidden="true">·</span>
                    <span class="font-medium text-ink">{{ $project['client'] ?? '' }}</span>
                </div>
                <h1 data-animate="fade-up" class="mt-5 text-4xl font-bold tracking-tight text-ink sm:text-6xl text-balance">{{ $c['title'] ?? '' }}</h1>
                <p data-animate="fade-up" class="mt-5 text-lg text-muted">{{ $c['excerpt'] ?? '' }}</p>
            </div>
        </div>

        {{-- Cover mare, suprapus peste secțiunile de jos --}}
        <div class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-project-cover :project="$project" tall class="!aspect-[2/1] shadow-xl" />
        </div>
    </section>

    {{-- Metrici --}}
    @if (! empty($metrics))
        <section class="bg-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-8 border-b border-zinc-200 py-12 lg:grid-cols-3 lg:py-16">
                    @foreach ($metrics as $metric)
                        <div>
                            <div class="text-4xl font-bold tracking-tight text-ink sm:text-5xl">{{ $metric['value'] }}</div>
                            <p class="mt-2 text-sm text-muted">{{ $metric['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Corp + sidebar detalii --}}
    <section class="bg-white py-14 lg:py-20">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-12 px-4 sm:px-6 lg:grid-cols-3 lg:gap-16 lg:px-8">

            {{-- Corp --}}
            <div class="lg:col-span-2">
                @foreach ($blocks as $block)
                    @switch($block['type'])
                        @case('heading')
                            <h2 class="mt-12 text-2xl font-bold tracking-tight text-ink first:mt-0">{{ $block['text'] }}</h2>
                            @break

                        @case('list')
                            <ul class="mt-6 space-y-3">
                                @foreach ($block['items'] as $item)
                                    <li class="flex items-start gap-3 text-lg leading-relaxed text-zinc-700">
                                        <span class="mt-2.5 inline-block h-1.5 w-1.5 shrink-0 rounded-full bg-deep"></span>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                            @break

                        @case('quote')
                            <blockquote class="my-10 border-l-4 border-zinc-900 pl-6">
                                <p class="text-xl font-medium italic text-ink">{{ $block['text'] }}</p>
                                @if (! empty($block['author']))
                                    <footer class="mt-3 text-sm font-medium text-muted">— {{ $block['author'] }}</footer>
                                @endif
                            </blockquote>
                            @break

                        @default
                            <p class="mt-6 text-lg leading-relaxed text-zinc-700 first:mt-0">{{ $block['text'] }}</p>
                    @endswitch
                @endforeach
            </div>

            {{-- Sidebar detalii proiect --}}
            <aside class="lg:col-span-1">
                <div class="lg:sticky lg:top-24 rounded-2xl border border-zinc-200 bg-paper p-6">
                    <h2 class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('portfolio.details_title') }}</h2>
                    <dl class="mt-5 space-y-4 text-sm">
                        <div class="flex justify-between gap-4 border-b border-zinc-200 pb-4">
                            <dt class="text-muted">{{ __('portfolio.client_label') }}</dt>
                            <dd class="font-medium text-ink">{{ $project['client'] ?? '' }}</dd>
                        </div>
                        <div class="flex justify-between gap-4 border-b border-zinc-200 pb-4">
                            <dt class="text-muted">{{ __('portfolio.category_label') }}</dt>
                            <dd class="font-medium text-ink">{{ __('portfolio.categories.'.($project['category'] ?? 'general')) }}</dd>
                        </div>
                        <div @class(['flex justify-between gap-4', 'border-b border-zinc-200 pb-4' => ! empty($project['url'])])>
                            <dt class="text-muted">{{ __('portfolio.year_label') }}</dt>
                            <dd class="font-medium text-ink">{{ $project['year'] ?? '' }}</dd>
                        </div>
                        @if (! empty($project['url']))
                            <div class="flex items-center justify-between gap-4">
                                <dt class="text-muted">{{ __('portfolio.website_label') }}</dt>
                                <dd>
                                    <a href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 font-medium text-orange transition hover:text-orange-deep">
                                        {{ preg_replace('#^https?://(www\.)?#', '', rtrim($project['url'], '/')) }}
                                        <svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H9M17 7v8" /></svg>
                                    </a>
                                </dd>
                            </div>
                        @endif
                    </dl>

                    <a href="{{ Localization::route('contact') }}" class="mt-6 block rounded-lg bg-orange px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-orange-deep">{{ __('messages.cta.discuss') }}</a>
                </div>
            </aside>
        </div>
    </section>

    {{-- Alte proiecte --}}
    @if (! empty($others))
        <section class="border-t border-zinc-200 bg-paper py-16 lg:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-ink">{{ __('portfolio.other_projects_title') }}</h2>
                <div class="mt-10 grid grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($others as $oSlug => $oProject)
                        <x-project-card :project="$oProject" :slug="$oSlug" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-cta-band
        :title="__('portfolio.cta_title')"
        :text="__('portfolio.cta_text')"
        :button="__('messages.cta.discuss')"
        :href="Localization::route('contact')"
    />

@endsection
