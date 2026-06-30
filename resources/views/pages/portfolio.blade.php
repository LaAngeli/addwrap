@php
    use App\Support\Projects;
    use App\Support\Localization;
@endphp

@extends('layouts.app')

@section('content')

    {{-- Hero — Split + showcase interactiv --}}
    @php
        $heroProjects = array_slice($projects, 0, 4, true);
        $coverGradients = [
            'seo' => 'from-zinc-900 to-zinc-700',
            'ads' => 'from-zinc-800 to-zinc-600',
            'content' => 'from-zinc-700 to-zinc-900',
            'branding' => 'from-zinc-900 to-zinc-600',
            'web' => 'from-zinc-800 to-zinc-950',
            'strategy' => 'from-zinc-600 to-zinc-800',
        ];
    @endphp
    <section class="relative overflow-hidden border-b border-zinc-200 bg-white">
        <div class="bg-dot-grid pointer-events-none absolute inset-0 -z-10 opacity-[0.5] [mask-image:radial-gradient(ellipse_at_top_right,black,transparent_65%)]"></div>
        <div class="pointer-events-none absolute -right-32 -top-32 -z-10 h-96 w-96 rounded-full bg-zinc-100 blur-3xl"></div>

        <div class="mx-auto max-w-7xl px-4 pt-16 pb-16 sm:px-6 sm:pt-20 lg:px-8 lg:py-28">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:items-center lg:gap-12">

                {{-- A: titlu + subtitlu --}}
                <div class="text-center lg:col-start-1 lg:row-start-1 lg:text-left">
                    <p data-animate="fade-up" class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-white/80 px-4 py-1.5 text-sm font-medium text-muted backdrop-blur">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-zinc-900 opacity-60"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-zinc-900"></span>
                        </span>
                        {{ __('pages.portfolio.hero_eyebrow') }}
                    </p>
                    <h1 data-animate="fade-up" data-animate-delay="0.08" class="mt-6 text-4xl font-bold tracking-tight text-ink sm:text-6xl lg:text-7xl text-balance">{{ __('pages.portfolio.hero_title') }}</h1>
                    <p data-animate="fade-up" data-animate-delay="0.16" class="mx-auto mt-5 max-w-xl text-lg text-muted sm:mt-6 sm:text-xl text-pretty lg:mx-0">{{ __('pages.portfolio.hero_subtitle') }}</p>
                </div>

                {{-- B: ilustrație (între titlu și CTA pe mobil) --}}
                {{-- Showcase interactiv --}}
                <div data-animate="scale-in" x-data="{ sel: 0 }" class="mx-auto w-full max-w-md lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:max-w-none lg:self-center">
                    {{-- Preview mare --}}
                    <div class="relative aspect-[16/11] overflow-hidden rounded-3xl border border-zinc-200 shadow-xl shadow-zinc-900/10">
                        @foreach ($heroProjects as $slug => $project)
                            @php $c = Projects::content($project); $grad = $coverGradients[$project['category']] ?? 'from-zinc-900 to-zinc-700'; $topMetric = $c['metrics'][0] ?? null; @endphp
                            <div
                                x-show="sel === {{ $loop->index }}"
                                x-cloak
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-[1.02]"
                                x-transition:enter-end="opacity-100 scale-100"
                                class="absolute inset-0 flex flex-col justify-between bg-gradient-to-br {{ $grad }} p-6"
                            >
                                <div class="bg-dot-grid pointer-events-none absolute inset-0 opacity-10"></div>
                                <div class="relative flex items-center justify-between">
                                    <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-white backdrop-blur">{{ __('portfolio.categories.'.$project['category']) }}</span>
                                    <span class="text-xs font-medium text-white/60">{{ $project['year'] }}</span>
                                </div>

                                {{-- Mock preview specific categoriei (placeholder până la imagini reale) --}}
                                @php $clientInitial = mb_substr($project['client'], 0, 1); @endphp
                                <div class="relative flex flex-1 items-center justify-center py-4">
                                    @switch($project['category'])
                                        @case('web')
                                            {{-- Mockup de site --}}
                                            <div class="w-4/5 max-w-[16rem] rounded-lg border border-white/15 bg-white/5 p-3 backdrop-blur-sm">
                                                <div class="flex items-center gap-1"><span class="h-1.5 w-1.5 rounded-full bg-white/25"></span><span class="h-1.5 w-1.5 rounded-full bg-white/25"></span><span class="h-1.5 w-1.5 rounded-full bg-white/25"></span><span class="ml-2 h-2 flex-1 rounded bg-white/10"></span></div>
                                                <div class="mt-2.5 h-9 rounded bg-white/15"></div>
                                                <div class="mt-2 grid grid-cols-3 gap-1.5"><div class="h-7 rounded bg-white/10"></div><div class="h-7 rounded bg-white/10"></div><div class="h-7 rounded bg-white/10"></div></div>
                                            </div>
                                            @break

                                        @case('seo')
                                            {{-- Rezultat #1 în căutare --}}
                                            <div class="w-4/5 max-w-[16rem] space-y-2">
                                                <div class="flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-2.5 py-1.5">
                                                    <svg class="h-3 w-3 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-width="2" d="M21 21l-4.3-4.3m1.8-4.7a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                                    <div class="h-1.5 w-1/2 rounded bg-white/20"></div>
                                                </div>
                                                <div class="rounded-md border border-white/30 bg-white/10 p-2">
                                                    <div class="flex items-center justify-between"><div class="h-1.5 w-1/3 rounded bg-white/30"></div><span class="rounded bg-white px-1 text-[8px] font-bold text-zinc-900">#1</span></div>
                                                    <div class="mt-1.5 h-1.5 w-2/3 rounded bg-white/20"></div>
                                                </div>
                                                <div class="rounded-md p-2"><div class="h-1.5 w-1/2 rounded bg-white/15"></div><div class="mt-1.5 h-1.5 w-2/3 rounded bg-white/10"></div></div>
                                            </div>
                                            @break

                                        @case('ads')
                                            {{-- Reclamă cu CTA --}}
                                            <div class="w-4/5 max-w-[15rem] rounded-lg border border-white/15 bg-white/5 p-3">
                                                <div class="flex items-center gap-2"><span class="h-5 w-5 rounded-full bg-white/20"></span><div class="h-1.5 w-1/3 rounded bg-white/20"></div><span class="ml-auto text-[8px] font-semibold uppercase text-white/40">Ad</span></div>
                                                <div class="mt-2 h-12 rounded bg-white/10"></div>
                                                <div class="mt-2 flex items-center justify-between"><div class="h-1.5 w-1/2 rounded bg-white/20"></div><span class="rounded bg-white px-2 py-0.5 text-[8px] font-bold text-zinc-900">CTA</span></div>
                                            </div>
                                            @break

                                        @case('content')
                                            {{-- Feed de postări --}}
                                            <div class="w-4/5 max-w-[15rem] space-y-1.5">
                                                @for ($k = 0; $k < 3; $k++)
                                                    <div class="flex items-center gap-2 rounded-md border border-white/15 bg-white/5 p-1.5">
                                                        <span class="h-7 w-7 shrink-0 rounded bg-white/15"></span>
                                                        <div class="flex-1"><div class="h-1.5 w-2/3 rounded bg-white/20"></div><div class="mt-1.5 h-1.5 w-1/2 rounded bg-white/10"></div></div>
                                                    </div>
                                                @endfor
                                            </div>
                                            @break

                                        @case('branding')
                                            {{-- Brand board --}}
                                            <div class="w-4/5 max-w-[15rem] rounded-lg border border-white/15 bg-white/5 p-3">
                                                <div class="flex items-center justify-center rounded bg-white/10 py-3 text-2xl font-black text-white/80">{{ $clientInitial }}</div>
                                                <div class="mt-2 grid grid-cols-5 gap-1"><div class="h-3 rounded bg-white/40"></div><div class="h-3 rounded bg-white/30"></div><div class="h-3 rounded bg-white/20"></div><div class="h-3 rounded bg-white/10"></div><div class="h-3 rounded border border-white/20"></div></div>
                                                <div class="mt-2 text-center text-base font-bold text-white/60">Aa</div>
                                            </div>
                                            @break

                                        @default
                                            {{-- Strategie / roadmap --}}
                                            <div class="w-4/5 max-w-[14rem] space-y-2.5">
                                                @for ($k = 1; $k <= 3; $k++)
                                                    <div class="flex items-center gap-2.5">
                                                        <span class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-white/30 text-[9px] font-bold text-white/60">{{ $k }}</span>
                                                        <div class="h-2 flex-1 rounded bg-white/15"></div>
                                                    </div>
                                                @endfor
                                            </div>
                                    @endswitch
                                </div>
                                <div class="relative">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-white/60">{{ $project['client'] }}</p>
                                    <p class="mt-1 text-lg font-bold leading-snug text-white text-balance">{{ $c['title'] }}</p>
                                    @if ($topMetric)
                                        <div class="mt-3 inline-flex items-baseline gap-2 rounded-lg bg-white/10 px-3 py-1.5 backdrop-blur">
                                            <span class="text-xl font-bold text-white">{{ $topMetric['value'] }}</span>
                                            <span class="text-xs text-white/70">{{ $topMetric['label'] }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Thumbnails (clickabile) --}}
                    <div class="mt-3 grid grid-cols-4 gap-3">
                        @foreach ($heroProjects as $slug => $project)
                            @php $grad = $coverGradients[$project['category']] ?? 'from-zinc-900 to-zinc-700'; @endphp
                            <button
                                type="button"
                                @click="sel = {{ $loop->index }}"
                                :class="sel === {{ $loop->index }} ? 'ring-2 ring-zinc-900 ring-offset-2' : 'opacity-70 hover:opacity-100'"
                                class="relative flex aspect-[4/3] items-center justify-center overflow-hidden rounded-xl bg-gradient-to-br {{ $grad }} transition"
                                aria-label="{{ $project['client'] }}"
                            >
                                <span class="px-1 text-center text-[11px] font-bold leading-tight text-white/90">{{ $project['client'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- C: CTA + chips --}}
                <div class="text-center lg:col-start-1 lg:row-start-2 lg:text-left">
                    <div data-animate="fade-up" class="flex flex-col gap-3 sm:flex-row sm:justify-center lg:justify-start">
                        <a href="{{ Localization::route('contact') }}" class="w-full rounded-lg bg-zinc-900 px-6 py-3.5 text-base font-semibold text-white shadow-sm transition hover:bg-black hover:shadow-md sm:w-auto">{{ __('messages.cta.offer') }}</a>
                        <a href="{{ Localization::route('services.index') }}" class="w-full rounded-lg border border-zinc-300 bg-white px-6 py-3.5 text-base font-semibold text-ink transition hover:border-zinc-900 sm:w-auto">{{ __('messages.cta.all_services') }}</a>
                    </div>
                    <div data-animate="fade-up" class="mt-8 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-muted lg:justify-start">
                        @foreach (__('pages.portfolio.hero_points') as $point)
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

    {{-- Banner clienți (logo-uri placeholder) --}}
    <x-clients-marquee :title="__('portfolio.clients_title')" />

    {{-- Showcase de lucrări — rânduri mari alternante --}}
    <section class="bg-white py-20 lg:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="space-y-20 lg:space-y-32">
                @foreach ($projects as $slug => $project)
                    @php
                        $c = Projects::content($project);
                        $even = $loop->iteration % 2 === 0;
                    @endphp
                    <a
                        href="{{ Localization::route('portfolio.show', ['slug' => $slug]) }}"
                        data-animate="fade-up"
                        class="group grid grid-cols-1 items-center gap-8 lg:grid-cols-2 lg:gap-16"
                    >
                        {{-- Vizual --}}
                        <div class="{{ $even ? 'lg:order-2' : '' }} overflow-hidden rounded-3xl">
                            <x-project-cover :project="$project" tall class="transition duration-500 group-hover:scale-[1.03]" />
                        </div>

                        {{-- Detalii --}}
                        <div class="{{ $even ? 'lg:order-1' : '' }}">
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-bold text-zinc-300">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="h-px flex-1 bg-zinc-200"></span>
                                <span class="text-xs font-semibold uppercase tracking-wider text-muted">{{ __('portfolio.categories.'.$project['category']) }}</span>
                            </div>

                            <p class="mt-6 text-sm font-medium text-muted">{{ $project['client'] }} · {{ $project['year'] }}</p>
                            <h2 class="mt-2 text-3xl font-bold tracking-tight text-ink transition group-hover:text-zinc-600 sm:text-4xl text-balance">{{ $c['title'] }}</h2>
                            <p class="mt-4 max-w-xl text-lg text-muted">{{ $c['excerpt'] }}</p>

                            @if (! empty($c['metrics']))
                                <div class="mt-8 flex flex-wrap gap-x-10 gap-y-4">
                                    @foreach ($c['metrics'] as $metric)
                                        <div>
                                            <div class="text-2xl font-bold tracking-tight text-ink sm:text-3xl">{{ $metric['value'] }}</div>
                                            <p class="mt-1 text-xs text-muted">{{ $metric['label'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <span class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-ink">
                                {{ __('portfolio.view_case') }}
                                <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-band
        :title="__('portfolio.cta_title')"
        :text="__('portfolio.cta_text')"
        :button="__('messages.cta.discuss')"
        :href="Localization::route('contact')"
    />

@endsection
