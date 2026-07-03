@php
    use App\Support\BlogPosts;
    use App\Support\Localization;
    use Illuminate\Support\Carbon;

    $c = BlogPosts::content($post);
    $blocks = $c['blocks'] ?? [];

    // Internal linking SEO: dacă există un serviciu mapat pentru categoria
    // articolului, expunem un card cu link direct către pagina serviciului.
    $relatedServiceKey = config('site.blog_category_service.'.($post['category'] ?? ''));
    $relatedService = $relatedServiceKey
        ? __('services.items.'.$relatedServiceKey)
        : null;
@endphp

@extends('layouts.app')

@section('content')

    <article class="bg-white">

        {{-- Antet articol --}}
        <header class="border-b border-zinc-200 bg-paper">
            <div class="mx-auto max-w-3xl px-4 py-14 sm:px-6 lg:py-20">
                <x-breadcrumbs />

                <div class="mt-6 flex items-center gap-2 text-xs text-muted">
                    <span class="rounded-full bg-zinc-900 px-3 py-1 font-semibold uppercase tracking-wider text-white">{{ __('blog.categories.'.($post['category'] ?? 'general')) }}</span>
                    <span aria-hidden="true">·</span>
                    <span>{{ __('blog.read_time', ['min' => $post['read_minutes'] ?? 5]) }}</span>
                </div>

                <h1 data-animate="fade-up" class="mt-5 text-4xl font-bold tracking-tight text-ink sm:text-5xl text-balance">{{ $c['title'] ?? '' }}</h1>
                <p data-animate="fade-up" class="mt-5 text-lg text-muted">{{ $c['excerpt'] ?? '' }}</p>

                <div class="mt-8 flex items-center gap-3">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-zinc-900 text-sm font-bold text-white">{{ mb_substr($post['author'] ?? 'A', 0, 1) }}</span>
                    <div class="text-sm">
                        <p class="font-medium text-ink">{{ $post['author'] ?? '' }}</p>
                        <p class="text-muted">{{ __('blog.published_on') }} {{ Carbon::parse($post['date'] ?? now())->locale(app()->getLocale())->isoFormat('D MMMM YYYY') }}</p>
                    </div>
                </div>
            </div>
        </header>

        {{-- Cover --}}
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <div class="-mt-8">
                <x-blog-cover :post="$post" tall />
            </div>
        </div>

        {{-- Corp articol --}}
        <div class="mx-auto max-w-2xl px-4 py-14 sm:px-6 lg:py-20">
            @foreach ($blocks as $block)
                @switch($block['type'])
                    @case('heading')
                        <h2 class="mt-12 text-2xl font-bold tracking-tight text-ink first:mt-0">{{ $block['text'] }}</h2>
                        @break

                    @case('list')
                        <ul class="mt-6 space-y-3">
                            @foreach ($block['items'] as $item)
                                <li class="flex items-start gap-3 text-lg leading-relaxed text-zinc-700">
                                    <span class="mt-2.5 inline-block h-1.5 w-1.5 shrink-0 rounded-full bg-zinc-900"></span>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                        @break

                    @case('quote')
                        <blockquote class="my-10 border-l-4 border-zinc-900 pl-6 text-xl font-medium italic text-ink">
                            {{ $block['text'] }}
                        </blockquote>
                        @break

                    @default
                        <p class="mt-6 text-lg leading-relaxed text-zinc-700 first:mt-0">{{ $block['text'] }}</p>
                @endswitch
            @endforeach

            {{-- Pași concreți (vizibili pentru utilizatori, redundanți cu HowTo schema) --}}
            @if (! empty($c['howto_steps']))
                <section class="mt-14 rounded-2xl border border-zinc-200 bg-paper p-6 sm:p-8">
                    <h2 class="text-xl font-bold tracking-tight text-ink">{{ __('blog.howto_title') }}</h2>
                    <ol class="mt-6 space-y-5">
                        @foreach ($c['howto_steps'] as $i => $step)
                            <li class="flex items-start gap-4">
                                <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-zinc-900 text-sm font-bold text-white">{{ $i + 1 }}</span>
                                <div>
                                    <h3 class="text-base font-semibold text-ink">{{ $step['name'] }}</h3>
                                    <p class="mt-1 text-sm leading-relaxed text-muted">{{ $step['text'] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </section>
            @endif

            {{-- Card serviciu relevant (internal linking SEO) --}}
            @if ($relatedServiceKey && is_array($relatedService))
                <div class="mt-14 rounded-2xl border border-zinc-900 bg-zinc-900 p-6 text-white sm:p-8">
                    <p class="text-xs font-semibold uppercase tracking-wider text-zinc-400">{{ __('blog.related_service.eyebrow') }}</p>
                    <h3 class="mt-2 text-xl font-bold text-balance">{{ $relatedService['name'] ?? '' }}</h3>
                    <p class="mt-2 text-sm text-zinc-300">{{ $relatedService['tagline'] ?? __('blog.related_service.text') }}</p>
                    <a href="{{ Localization::serviceUrl($relatedServiceKey) }}" class="mt-5 inline-flex items-center gap-1.5 rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-zinc-900 transition hover:bg-zinc-100">
                        {{ __('blog.related_service.cta') }}
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            @endif

            {{-- CTA inline --}}
            <div class="mt-8 rounded-2xl border border-zinc-200 bg-paper p-6 text-center sm:p-8">
                <p class="text-lg font-semibold text-ink">{{ __('blog.cta_title') }}</p>
                <p class="mt-2 text-sm text-muted">{{ __('blog.cta_text') }}</p>
                <a href="{{ Localization::route('contact') }}" class="mt-5 inline-block rounded-lg bg-orange px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-deep">{{ __('messages.cta.discuss') }}</a>
            </div>
        </div>
    </article>

    {{-- Articole similare --}}
    @if (! empty($related))
        <section class="border-t border-zinc-200 bg-paper py-16 lg:py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-ink">{{ __('blog.related_title') }}</h2>
                <div class="mt-10 grid grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($related as $rSlug => $rPost)
                        <x-blog-card :post="$rPost" :slug="$rSlug" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
