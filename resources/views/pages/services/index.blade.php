@php
    use App\Support\Localization;
    $services = Localization::services();
    $first = array_key_first($services);
@endphp

@extends('layouts.app')

@section('content')

    {{-- Hero — Split + vizual servicii --}}
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
                        {{ __('services.index.eyebrow') }}
                    </p>
                    <h1 data-animate="fade-up" data-animate-delay="0.08" class="mt-6 text-4xl font-bold tracking-tight text-ink sm:text-6xl lg:text-7xl text-balance">{{ __('services.index.title') }}</h1>
                    <p data-animate="fade-up" data-animate-delay="0.16" class="mx-auto mt-5 max-w-xl text-lg text-muted sm:mt-6 sm:text-xl text-pretty lg:mx-0">{{ __('services.index.subtitle') }}</p>
                </div>

                {{-- B: ilustrație (între titlu și CTA pe mobil) --}}
                {{-- Ilustrație personalizată: ecosistem de servicii --}}
                @php
                    $orbitPos = [
                        'left-[88%] top-[50%]',
                        'left-[69%] top-[83%]',
                        'left-[31%] top-[83%]',
                        'left-[12%] top-[50%]',
                        'left-[31%] top-[17%]',
                        'left-[69%] top-[17%]',
                    ];
                    $orbitLines = [[88, 50], [69, 83], [31, 83], [12, 50], [31, 17], [69, 17]];
                @endphp
                <div data-animate="fade-in" x-data="{ sel: 'aw' }" class="relative mx-auto w-full max-w-xs sm:max-w-sm lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:max-w-md lg:self-center">
                    <div class="relative aspect-square">
                        {{-- Linii de legătură + inel (linia activă se evidențiază) --}}
                        <svg viewBox="0 0 100 100" class="absolute inset-0 h-full w-full" fill="none" aria-hidden="true">
                            <circle cx="50" cy="50" r="38" stroke="#e4e4e7" stroke-width="0.5" stroke-dasharray="1.2 2.4" />
                            @foreach ($services as $key => $service)
                                @php [$lx, $ly] = $orbitLines[$loop->index]; @endphp
                                <line x1="50" y1="50" x2="{{ $lx }}" y2="{{ $ly }}" stroke-width="0.7" class="transition-all" :stroke="sel === '{{ $key }}' ? '#18181b' : '#e4e4e7'" />
                            @endforeach
                        </svg>

                        {{-- Noduri servicii (clickabile) --}}
                        @foreach ($services as $key => $service)
                            <div class="absolute {{ $orbitPos[$loop->index] ?? '' }} -translate-x-1/2 -translate-y-1/2">
                                <button
                                    type="button"
                                    @click="sel = '{{ $key }}'"
                                    :class="sel === '{{ $key }}' ? 'border-zinc-900 bg-zinc-900 text-white shadow-md' : 'border-zinc-200 bg-white text-zinc-800 hover:-translate-y-0.5 hover:border-zinc-900 hover:shadow-md'"
                                    class="flex h-12 w-12 items-center justify-center rounded-2xl border shadow-sm transition sm:h-14 sm:w-14"
                                    title="{{ __('services.items.'.$key.'.name') }}"
                                    aria-label="{{ __('services.items.'.$key.'.name') }}"
                                >
                                    <x-service-icon :name="$service['icon'] ?? 'simple'" class="h-5 w-5 sm:h-6 sm:w-6" />
                                </button>
                            </div>
                        @endforeach

                        {{-- Hub central (clickabil) --}}
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                            <button
                                type="button"
                                @click="sel = 'aw'"
                                :class="sel === 'aw' ? 'ring-2 ring-zinc-900 ring-offset-2' : ''"
                                class="flex h-16 w-16 items-center justify-center rounded-full bg-zinc-900 text-white shadow-xl transition sm:h-20 sm:w-20"
                                aria-label="{{ config('site.company.name') }}"
                            >
                                {{-- Glyph „AW" alb pe hub negru --}}
                                <x-brand-glyph class="h-5 w-auto sm:h-6 text-white" />
                            </button>
                        </div>
                    </div>

                    {{-- Caption dinamic: addWrap (implicit) sau serviciul selectat --}}
                    <div class="relative mt-6 min-h-[5.5rem] text-center">
                        <div
                            x-show="sel === 'aw'"
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            class="absolute inset-0"
                        >
                            <p class="font-semibold text-ink">{{ config('site.company.name') }}</p>
                            <p class="mx-auto mt-1 max-w-xs text-sm text-muted">{{ __('services.index.hero_caption') }}</p>
                        </div>

                        @foreach ($services as $key => $service)
                            <div
                                x-show="sel === '{{ $key }}'"
                                x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                class="absolute inset-0"
                            >
                                <p class="font-semibold text-ink">{{ __('services.items.'.$key.'.name') }}</p>
                                <p class="mx-auto mt-1 max-w-xs text-sm text-muted">{{ __('services.items.'.$key.'.tagline') }}</p>
                                <a href="{{ Localization::serviceUrl($key) }}" class="mt-2 inline-flex items-center gap-1 text-sm font-semibold text-ink hover:underline">{{ __('services.index.view_service') }} <span aria-hidden="true">&rarr;</span></a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- C: CTA + chips --}}
                <div class="text-center lg:col-start-1 lg:row-start-2 lg:text-left">
                    <div data-animate="fade-up" class="flex flex-col gap-3 sm:flex-row sm:justify-center lg:justify-start">
                        <a href="{{ Localization::route('home') }}#start" class="w-full rounded-lg bg-orange px-6 py-3.5 text-base font-semibold text-white shadow-sm transition hover:bg-orange-deep hover:shadow-md sm:w-auto">{{ __('services.index.cta_primary') }}</a>
                        <a href="{{ Localization::route('pricing') }}" class="w-full rounded-lg border border-zinc-300 bg-white px-6 py-3.5 text-base font-semibold text-ink transition hover:border-zinc-900 sm:w-auto">{{ __('services.index.cta_secondary') }}</a>
                    </div>
                    <div data-animate="fade-up" class="mt-8 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-muted lg:justify-start">
                        @foreach (__('services.index.hero_points') as $point)
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

    {{-- Explorer interactiv de servicii --}}
    <section class="bg-paper py-20 lg:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('services.index.explorer_eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ __('services.index.explorer_title') }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ __('services.index.explorer_subtitle') }}</p>
            </div>

            <div x-data="{ active: '{{ $first }}' }" class="mt-14 flex flex-col gap-6 lg:flex-row lg:items-start lg:gap-8">

                {{-- Lista de servicii (tab-uri) --}}
                <div class="flex gap-2 overflow-x-auto pb-2 lg:w-72 lg:shrink-0 lg:flex-col lg:gap-3 lg:overflow-visible lg:pb-0">
                    @foreach ($services as $key => $service)
                        <button
                            type="button"
                            @click="active = '{{ $key }}'"
                            :class="active === '{{ $key }}' ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-200 text-zinc-700 hover:border-zinc-400'"
                            class="flex shrink-0 items-center gap-3 rounded-2xl border px-4 py-3 text-left transition lg:w-full"
                        >
                            <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg"
                                :class="active === '{{ $key }}' ? 'bg-white/10' : 'bg-zinc-100'">
                                <x-service-icon :name="$service['icon'] ?? 'simple'" class="h-5 w-5" />
                            </span>
                            <span class="whitespace-nowrap text-sm font-semibold lg:whitespace-normal">{{ __('services.items.'.$key.'.name') }}</span>
                        </button>
                    @endforeach
                </div>

                {{-- Panou detaliu --}}
                <div class="w-full flex-1 min-w-0">
                    @foreach ($services as $key => $service)
                        @php
                            $svc = __('services.items.'.$key);
                            $price = $svc['price'] ?? null;
                            if (! $price && ! empty($svc['packages'])) {
                                $p0 = $svc['packages'][0];
                                $price = ['amount' => $p0['price'], 'frequency' => $p0['unit'] ?? '', 'vat' => ''];
                            }
                            $priceMeta = trim(($price['frequency'] ?? ($price['period'] ?? '')).' '.($price['vat'] ?? ''));

                            $highlights = $svc['features'] ?? [];
                            if (empty($highlights) && ! empty($svc['modules'])) {
                                $highlights = array_map(fn ($m) => $m['title'], $svc['modules']);
                            }
                            if (empty($highlights) && ! empty($svc['packages'])) {
                                $highlights = array_map(fn ($p) => $p['name'].' · '.$p['volume'], $svc['packages']);
                            }
                            $highlights = array_slice($highlights, 0, 4);
                        @endphp

                        <div
                            x-show="active === '{{ $key }}'"
                            x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-3"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="rounded-3xl border border-zinc-200 p-6 sm:p-8 lg:p-10"
                        >
                            <div class="flex items-center gap-4">
                                <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-zinc-900 text-white">
                                    <x-service-icon :name="$service['icon'] ?? 'simple'" class="h-6 w-6" />
                                </span>
                                <div>
                                    <h3 class="text-2xl font-bold tracking-tight text-ink">{{ $svc['name'] }}</h3>
                                    <p class="text-sm text-muted">{{ $svc['tagline'] }}</p>
                                </div>
                            </div>

                            <p class="mt-6 text-lg leading-relaxed text-muted">{{ $svc['description'] }}</p>

                            @if (! empty($highlights))
                                <ul class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
                                    @foreach ($highlights as $h)
                                        <li class="flex items-start gap-3 text-sm text-zinc-700">
                                            <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-zinc-900 text-white">
                                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                            </span>
                                            {{ $h }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="mt-8 flex flex-col gap-4 border-t border-zinc-200 pt-6 sm:flex-row sm:items-center sm:justify-between">
                                @if ($price)
                                    <div>
                                        <span class="text-2xl font-bold tracking-tight text-ink">{{ $price['amount'] }}</span>
                                        @if ($priceMeta)
                                            <span class="text-sm text-muted">{{ $priceMeta }}</span>
                                        @endif
                                    </div>
                                @else
                                    <span></span>
                                @endif

                                <div class="flex flex-col gap-3 sm:flex-row">
                                    <a href="{{ Localization::serviceUrl($key) }}" class="rounded-lg bg-zinc-900 px-5 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-zinc-900">{{ __('services.index.view_service') }}</a>
                                    <a href="{{ Localization::route('contact') }}" class="rounded-lg border border-zinc-300 px-5 py-2.5 text-center text-sm font-semibold text-ink transition hover:bg-zinc-50">{{ __('services.show.price_cta') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Mini-quiz: ce servicii ți se potrivesc --}}
    <section class="border-y border-zinc-200 bg-paper py-20 lg:py-24">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-10 max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('quiz.eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ __('quiz.title') }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ __('quiz.subtitle') }}</p>
            </div>
            <div data-animate="scale-in">
                <livewire:brief-wizard />
            </div>
        </div>
    </section>

    {{-- Proces --}}
    <section class="bg-paper py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('pages.home.process_eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ __('pages.home.process_title') }}</h2>
            </div>
            <div data-animate-group class="mt-14 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
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

    <x-cta-band
        :title="__('pages.home.cta_title')"
        :text="__('pages.home.cta_text')"
        :button="__('pages.home.cta_button')"
        :href="Localization::route('contact')"
    />

@endsection
