@php
    use App\Support\BlogPosts;
    use App\Support\Localization;
    use Illuminate\Support\Carbon;

    $featuredSlug = collect($posts)->search(fn ($p) => $p['featured'] ?? false) ?: array_key_first($posts);
    $featured = $posts[$featuredSlug] ?? null;
    $rest = collect($posts)->except($featuredSlug);
    $categories = collect($posts)->pluck('category')->unique()->values();
@endphp

@extends('layouts.app')

@section('content')

    {{-- Hero — Split + preview interactiv de articol --}}
    @php
        $catSamples = collect($categories)->map(function ($cat) use ($posts) {
            $slug = collect($posts)->search(fn ($p) => $p['category'] === $cat);
            $post = $posts[$slug];
            $c = BlogPosts::content($post);
            return [
                'cat' => $cat,
                'slug' => $slug,
                'title' => $c['title'] ?? '',
                'excerpt' => $c['excerpt'] ?? '',
                'read' => $post['read_minutes'] ?? 5,
            ];
        })->take(4)->values();
    @endphp
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
                        {{ __('pages.blog.hero_eyebrow') }}
                    </p>
                    <h1 data-animate="fade-up" data-animate-delay="0.08" class="mt-6 text-4xl font-bold tracking-tight text-ink sm:text-6xl lg:text-7xl text-balance">{{ __('pages.blog.hero_title') }}</h1>
                    <p data-animate="fade-up" data-animate-delay="0.16" class="mx-auto mt-5 max-w-xl text-lg text-muted sm:mt-6 sm:text-xl text-pretty lg:mx-0">{{ __('pages.blog.hero_subtitle') }}</p>
                </div>

                {{-- B: ilustrație (între titlu și CTA pe mobil) --}}
                {{-- Preview interactiv de articol --}}
                <div data-animate="scale-in" x-data="{ sel: 0 }" class="mx-auto w-full max-w-md lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:max-w-none lg:self-center">
                    <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-xl shadow-zinc-900/5 sm:p-7">
                        {{-- Chips categorii --}}
                        <div class="flex flex-wrap gap-2">
                            @foreach ($catSamples as $i => $sample)
                                <button
                                    type="button"
                                    @click="sel = {{ $i }}"
                                    :class="sel === {{ $i }} ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-200 text-zinc-600 hover:border-zinc-400'"
                                    class="rounded-full border px-3 py-1.5 text-xs font-semibold transition"
                                >{{ __('blog.categories.'.$sample['cat']) }}</button>
                            @endforeach
                        </div>

                        {{-- Preview articol --}}
                        <div class="relative mt-5 min-h-[240px]">
                            @foreach ($catSamples as $i => $sample)
                                <div
                                    x-show="sel === {{ $i }}"
                                    @unless ($loop->first) x-cloak @endunless
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-y-3"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    class="absolute inset-0 rounded-2xl border border-zinc-200 bg-paper p-5"
                                >
                                    <span class="inline-block rounded-full bg-zinc-900 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-white">{{ __('blog.categories.'.$sample['cat']) }}</span>
                                    <a href="{{ Localization::route('blog.show', ['slug' => $sample['slug']]) }}" class="mt-4 block text-lg font-bold leading-snug text-ink transition hover:text-zinc-600 text-balance">{{ $sample['title'] }}</a>
                                    <p class="mt-3 text-sm leading-relaxed text-muted line-clamp-3">{{ $sample['excerpt'] }}</p>
                                    <div class="mt-5 flex items-center gap-2 text-xs text-muted">
                                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-zinc-900">
                                            <x-brand-glyph class="h-2 w-auto text-white" />
                                        </span>
                                        <span>addWrap</span>
                                        <span aria-hidden="true">·</span>
                                        <span>{{ __('blog.read_time', ['min' => $sample['read']]) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- C: CTA + chips --}}
                <div class="text-center lg:col-start-1 lg:row-start-2 lg:text-left">
                    <div data-animate="fade-up" class="flex flex-col gap-3 sm:flex-row sm:justify-center lg:justify-start">
                        <a href="#articole" class="w-full rounded-lg bg-orange px-6 py-3.5 text-base font-semibold text-white shadow-sm transition hover:bg-orange-deep hover:shadow-md sm:w-auto">{{ __('blog.read_more') }}</a>
                        <a href="{{ Localization::route('contact') }}" class="w-full rounded-lg border border-zinc-300 bg-white px-6 py-3.5 text-base font-semibold text-ink transition hover:border-zinc-900 sm:w-auto">{{ __('messages.cta.offer') }}</a>
                    </div>
                    <div data-animate="fade-up" class="mt-8 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-muted lg:justify-start">
                        @foreach (__('pages.blog.hero_points') as $point)
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="h-4 w-4 text-zinc-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                {{ $point }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Articol featured --}}
    @if ($featured)
        @php $fc = BlogPosts::content($featured); @endphp
        <section id="articole" class="scroll-mt-20 bg-paper py-16 lg:py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <a href="{{ Localization::route('blog.show', ['slug' => $featuredSlug]) }}" data-animate="fade-up" class="group grid grid-cols-1 items-center gap-8 lg:grid-cols-2 lg:gap-12">
                    <x-blog-cover :post="$featured" tall class="transition group-hover:opacity-95" />
                    <div>
                        <div class="flex items-center gap-2 text-xs text-muted">
                            <span class="rounded-full bg-zinc-900 px-3 py-1 font-semibold uppercase tracking-wider text-white">{{ __('blog.featured_label') }}</span>
                            <span class="font-semibold uppercase tracking-wider text-ink">{{ __('blog.categories.'.$featured['category']) }}</span>
                        </div>
                        <h2 class="mt-4 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ $fc['title'] }}</h2>
                        <p class="mt-4 text-lg text-muted">{{ $fc['excerpt'] }}</p>
                        <div class="mt-6 flex items-center gap-3 text-sm text-muted">
                            <span>{{ $featured['author'] }}</span>
                            <span aria-hidden="true">·</span>
                            <time datetime="{{ $featured['date'] }}">{{ Carbon::parse($featured['date'])->locale(app()->getLocale())->isoFormat('D MMMM YYYY') }}</time>
                            <span aria-hidden="true">·</span>
                            <span>{{ __('blog.read_time', ['min' => $featured['read_minutes']]) }}</span>
                        </div>
                        <span class="mt-6 inline-flex items-center gap-1 text-sm font-semibold text-ink">
                            {{ __('blog.read_more') }}
                            <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                        </span>
                    </div>
                </a>
            </div>
        </section>
    @endif

    {{-- Filtru + grilă --}}
    <section class="border-t border-zinc-200 bg-paper py-16 lg:py-24" x-data="{ cat: 'all' }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex flex-wrap gap-2">
                <button type="button" @click="cat = 'all'" :class="cat === 'all' ? 'bg-zinc-900 text-white' : 'border border-zinc-300 text-zinc-700 hover:border-zinc-400'" class="rounded-full px-4 py-2 text-sm font-medium transition">
                    {{ __('blog.all_label') }}
                </button>
                @foreach ($categories as $cat)
                    <button type="button" @click="cat = '{{ $cat }}'" :class="cat === '{{ $cat }}' ? 'bg-zinc-900 text-white' : 'border border-zinc-300 text-zinc-700 hover:border-zinc-400'" class="rounded-full px-4 py-2 text-sm font-medium transition">
                        {{ __('blog.categories.'.$cat) }}
                    </button>
                @endforeach
            </div>

            <div class="mt-12 grid grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($rest as $slug => $post)
                    <div x-show="cat === 'all' || cat === '{{ $post['category'] }}'" x-transition.opacity>
                        <x-blog-card :post="$post" :slug="$slug" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-band
        :title="__('pages.home.cta_title')"
        :text="__('pages.home.cta_text')"
        :button="__('pages.home.cta_button')"
        :href="Localization::route('contact')"
    />

@endsection
