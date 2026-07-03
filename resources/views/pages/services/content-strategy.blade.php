@php
    use App\Support\Localization;

    $svc = __('services.items.'.$serviceKey);
    $page = __('service_pages.'.$serviceKey);
    $packages = $svc['packages'] ?? [];
    $features = $svc['features'] ?? [];
    $addon = $svc['addons'][0] ?? null;
@endphp

@extends('layouts.app')

@section('content')

    {{-- Hero --}}
    <section class="border-b border-zinc-200 bg-paper">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <x-breadcrumbs />

            <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-2 lg:items-center">
                <div class="lg:col-start-1 lg:row-start-1">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-zinc-900 text-white">
                            <x-service-icon :name="$service['icon'] ?? 'document-text'" class="h-6 w-6" />
                        </span>
                    </div>
                    <h1 data-animate="fade-up" class="mt-6 text-balance">
                        <span class="block text-sm font-semibold uppercase tracking-wider text-muted">{{ $svc['name'] }}</span>
                        <span class="mt-3 block text-4xl font-bold tracking-tight text-ink sm:text-5xl">{{ $svc['tagline'] }}</span>
                    </h1>
                    <p data-animate="fade-up" class="mt-5 text-lg text-muted">{{ $svc['description'] }}</p>

                    <div class="mt-8 flex flex-wrap items-baseline gap-x-3 gap-y-1">
                        <span class="text-3xl font-bold tracking-tight text-ink">{{ $page['price_from'] }}</span>
                        <span class="text-sm text-muted">{{ $page['price_period'] }}</span>
                    </div>

                </div>

                {{-- B: ilustrație (între text și CTA pe mobil) --}}
                {{-- Roadmap 12 luni interactiv (lună → temă + mix de conținut + KPI) --}}
                @php
                    $csMix = [
                        [40, 20, 22, 18], [48, 18, 20, 14], [45, 25, 18, 12], [38, 16, 30, 16],
                        [35, 38, 14, 13], [30, 18, 16, 36], [50, 16, 20, 14], [42, 20, 22, 16],
                        [34, 34, 18, 14], [40, 22, 26, 12], [28, 42, 18, 12], [44, 20, 18, 18],
                    ];
                    $csMeasured = [62, 70, 86, 74, 80, 88, 72, 76, 84, 82, 90, 78];
                    $csMonths = [];
                    foreach ($page['roadmap'] as $i => $rm) {
                        $csMonths[] = [
                            'm' => $rm['m'],
                            'theme' => $rm['theme'],
                            'goal' => $rm['goal'],
                            'mix' => $csMix[$i] ?? [40, 25, 20, 15],
                            'measured' => $csMeasured[$i] ?? 75,
                        ];
                    }
                    $csState = [
                        'sel' => max(0, min(11, (int) now()->month - 1)),
                        'months' => $csMonths,
                        'types' => $page['roadmap_types'],
                        'barColors' => ['bg-zinc-900', 'bg-orange', 'bg-zinc-600', 'bg-zinc-400'],
                    ];
                @endphp
                <div data-animate="scale-in" x-data="{{ json_encode($csState) }}" class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:self-center">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-ink">{{ $page['roadmap_title'] }}</span>
                        <span class="rounded-full bg-orange/10 px-2.5 py-1 text-[11px] font-semibold text-orange">{{ $page['roadmap_badge'] }}</span>
                    </div>

                    {{-- Bara celor 12 luni --}}
                    <div class="mt-4 grid grid-cols-6 gap-1.5">
                        <template x-for="(mo, i) in months" :key="i">
                            <button type="button" @click="sel = i" :class="sel === i ? 'bg-zinc-900 text-white shadow-sm' : 'bg-zinc-50 text-zinc-500 hover:bg-zinc-100'" class="rounded-lg py-2 text-center text-[11px] font-semibold transition" x-text="mo.m"></button>
                        </template>
                    </div>

                    {{-- Luna selectată: temă + mix de conținut --}}
                    <div class="mt-4 rounded-2xl border border-zinc-100 bg-zinc-50 p-4">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex h-7 items-center rounded-lg bg-zinc-900 px-2 text-xs font-bold text-white" x-text="'Luna ' + String(sel + 1).padStart(2, '0')"></span>
                            <span class="text-sm font-semibold text-ink" x-text="months[sel].theme"></span>
                        </div>
                        <div class="mt-4 space-y-2.5">
                            <template x-for="(t, i) in types" :key="i">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-20 shrink-0 text-xs text-zinc-600" x-text="t"></span>
                                    <div class="h-1.5 flex-1 rounded-full bg-zinc-200">
                                        <div class="h-1.5 rounded-full transition-all duration-500 ease-out" :class="barColors[i]" :style="'width: ' + months[sel].mix[i] + '%'"></div>
                                    </div>
                                    <span class="w-8 shrink-0 text-right text-xs text-zinc-500" x-text="months[sel].mix[i] + '%'"></span>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- KPI: obiectiv SMART + măsurat --}}
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        <div class="rounded-xl border border-zinc-200 p-3">
                            <p class="text-[10px] uppercase tracking-wider text-muted">{{ $page['roadmap_goal_label'] }}</p>
                            <p class="mt-0.5 text-base font-bold text-ink" x-text="months[sel].goal"></p>
                        </div>
                        <div class="rounded-xl bg-zinc-900 p-3">
                            <p class="text-[10px] uppercase tracking-wider text-zinc-400">{{ $page['roadmap_measured_label'] }}</p>
                            <p class="mt-0.5 text-base font-bold text-white"><span class="text-orange" x-text="months[sel].measured + '%'"></span> {{ $page['roadmap_target_suffix'] }}</p>
                        </div>
                    </div>

                    <div class="mt-4 text-xs text-muted">{{ $page['roadmap_legend'] }}</div>
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

    {{-- Pachete cu comutator de facturare --}}
    @if (! empty($packages))
        <section class="bg-white py-20 lg:py-24" x-data="{ billing: 'annual' }">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $page['packages_eyebrow'] }}</p>
                    <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ $page['packages_title'] }}</h2>
                    <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ $page['packages_subtitle'] }}</p>
                </div>

                {{-- Toggle --}}
                <div class="mt-8 flex justify-center">
                    <div class="inline-flex rounded-full border border-zinc-200 bg-white p-1">
                        <button type="button" @click="billing = 'annual'" :class="billing === 'annual' ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:text-ink'" class="rounded-full px-4 py-1.5 text-sm font-semibold transition">{{ $page['billing_annual'] }}</button>
                        <button type="button" @click="billing = 'monthly'" :class="billing === 'monthly' ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:text-ink'" class="rounded-full px-4 py-1.5 text-sm font-semibold transition">{{ $page['billing_monthly'] }}</button>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    @foreach ($packages as $plan)
                        <div @class([
                            'relative flex flex-col rounded-3xl border p-8',
                            'border-zinc-900 shadow-xl ring-1 ring-zinc-900' => $plan['featured'] ?? false,
                            'border-zinc-200' => ! ($plan['featured'] ?? false),
                        ])>
                            @if (! empty($plan['badge']))
                                <span class="absolute -top-3 left-1/2 -translate-x-1/2 rounded-full bg-zinc-900 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-white">{{ $plan['badge'] }}</span>
                            @endif
                            <h3 class="text-lg font-semibold text-ink">{{ $plan['name'] }}</h3>
                            <p class="mt-4 text-2xl font-bold tracking-tight text-ink">{{ $plan['volume'] }}</p>

                            <div class="mt-4">
                                <div x-show="billing === 'annual'">
                                    <span class="text-3xl font-bold tracking-tight text-ink">{{ $plan['price'] }}</span>
                                    <span class="text-sm text-muted">{{ $plan['unit'] }}</span>
                                </div>
                                <div x-show="billing === 'monthly'" x-cloak>
                                    <span class="text-3xl font-bold tracking-tight text-ink">{{ $plan['equivalent'] }}</span>
                                </div>
                            </div>

                            <a href="{{ Localization::route('contact') }}" @class([
                                'mt-8 block rounded-lg px-5 py-3 text-center text-sm font-semibold transition',
                                'bg-zinc-900 text-white hover:bg-black' => $plan['featured'] ?? false,
                                'border border-zinc-300 text-ink hover:bg-zinc-50' => ! ($plan['featured'] ?? false),
                            ])>{{ $page['price_cta'] }}</a>
                        </div>
                    @endforeach
                </div>

                {{-- Ambele pachete includ --}}
                @if (! empty($features))
                    <div class="mt-12 rounded-3xl border border-zinc-200 bg-paper p-6 sm:p-8">
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $svc['features_title'] ?? '' }}</h3>
                        <ul class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">
                            @foreach ($features as $feature)
                                <li class="flex items-start gap-3 text-sm text-zinc-700">
                                    <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-zinc-900 text-white">
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                    </span>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>

                        @if ($addon)
                            <div class="mt-6 flex flex-col gap-2 border-t border-zinc-200 pt-5 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-muted">{{ $page['addon_eyebrow'] }}</p>
                                    <p class="mt-1 text-sm font-semibold text-ink">{{ $addon['title'] }}@if (! empty($addon['note']))<span class="font-normal text-muted"> · {{ $addon['note'] }}</span>@endif</p>
                                </div>
                                <span class="shrink-0 text-lg font-bold text-ink">{{ $addon['price'] }}</span>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- Tipuri de conținut (piloni) --}}
    <section class="border-y border-zinc-200 bg-paper py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $page['pillars_eyebrow'] }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ $page['pillars_title'] }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ $page['pillars_subtitle'] }}</p>
            </div>
            <div data-animate-group class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($page['pillars'] as $pillar)
                    <div class="flex flex-col rounded-2xl border border-zinc-200 bg-white p-6 transition hover:-translate-y-1 hover:border-zinc-900 hover:shadow-lg">
                        <h3 class="text-lg font-semibold text-ink">{{ $pillar['title'] }}</h3>
                        <p class="mt-2 text-sm text-muted">{{ $pillar['desc'] }}</p>
                        <ul class="mt-4 space-y-1.5 border-t border-zinc-100 pt-4 text-sm text-zinc-600">
                            @foreach ($pillar['examples'] as $ex)
                                <li class="flex items-start gap-2"><span class="mt-1.5 inline-block h-1 w-1 shrink-0 rounded-full bg-zinc-400"></span>{{ $ex }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Proces --}}
    <section class="bg-white py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $page['process_eyebrow'] }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ $page['process_title'] }}</h2>
            </div>
            <div data-animate-group class="mt-14 grid grid-cols-2 gap-8 lg:grid-cols-5">
                @foreach ($page['process'] as $i => $step)
                    <div>
                        <span class="text-4xl font-bold text-zinc-200">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="mt-3 font-semibold text-ink">{{ $step['title'] }}</h3>
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
