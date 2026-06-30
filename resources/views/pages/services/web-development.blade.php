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
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <a href="{{ Localization::route('services.index') }}" class="text-sm font-medium text-ink transition hover:underline">&larr; {{ __('messages.nav.services') }}</a>

            <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-2 lg:items-center">
                <div class="lg:col-start-1 lg:row-start-1">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-zinc-900 text-white">
                            <x-service-icon :name="$service['icon'] ?? 'code-bracket'" class="h-6 w-6" />
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
                {{-- Mockup interactiv: tip de site + device --}}
                <div data-animate="scale-in" x-data="{ device: 'desktop', type: 'presentation' }" class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm lg:col-start-2 lg:row-start-1 lg:row-span-2 lg:self-center">
                    {{-- Controale --}}
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        {{-- Tip de site --}}
                        <div class="inline-flex rounded-full border border-zinc-200 bg-zinc-50 p-1 text-xs font-semibold">
                            <button type="button" @click="type = 'presentation'" :class="type === 'presentation' ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:text-ink'" class="rounded-full px-3 py-1.5 transition">{{ $page['type_presentation'] }}</button>
                            <button type="button" @click="type = 'ecommerce'" :class="type === 'ecommerce' ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:text-ink'" class="rounded-full px-3 py-1.5 transition">{{ $page['type_ecommerce'] }}</button>
                            <button type="button" @click="type = 'saas'" :class="type === 'saas' ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:text-ink'" class="rounded-full px-3 py-1.5 transition">{{ $page['type_saas'] }}</button>
                        </div>
                        {{-- Device --}}
                        <div class="inline-flex shrink-0 rounded-full border border-zinc-200 bg-zinc-50 p-1">
                            <button type="button" @click="device = 'desktop'" :aria-label="'{{ $page['device_desktop'] }}'" :class="device === 'desktop' ? 'bg-zinc-900 text-white' : 'text-zinc-500 hover:text-ink'" class="rounded-full p-1.5 transition">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 5h18v11H3zM8 20h8M12 16v4" /></svg>
                            </button>
                            <button type="button" @click="device = 'mobile'" :aria-label="'{{ $page['device_mobile'] }}'" :class="device === 'mobile' ? 'bg-zinc-900 text-white' : 'text-zinc-500 hover:text-ink'" class="rounded-full p-1.5 transition">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M7 3h10v18H7zM11 18h2" /></svg>
                            </button>
                        </div>
                    </div>

                    {{-- Preview adaptiv --}}
                    <div class="mt-4 flex justify-center">
                        <div class="overflow-hidden bg-white transition-all duration-300" :class="device === 'mobile' ? 'w-52 rounded-[1.75rem] border-[5px] border-zinc-900' : 'w-full rounded-xl border border-zinc-200'">
                            {{-- Bara browser (doar desktop) --}}
                            <div x-show="device === 'desktop'" x-cloak class="flex items-center gap-1.5 border-b border-zinc-200 bg-zinc-50 px-3 py-2">
                                <span class="h-2.5 w-2.5 rounded-full bg-zinc-300"></span>
                                <span class="h-2.5 w-2.5 rounded-full bg-zinc-300"></span>
                                <span class="h-2.5 w-2.5 rounded-full bg-zinc-300"></span>
                                <span class="ml-2 flex-1 truncate rounded border border-zinc-200 bg-white px-2 py-0.5 text-[10px] text-muted">{{ $page['preview_url'] }}</span>
                            </div>

                            <div class="space-y-3 p-3">
                                {{-- Prezentare --}}
                                <div x-show="type === 'presentation'" x-transition.opacity class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <div class="h-2.5 w-16 rounded bg-zinc-300"></div>
                                        <div class="flex gap-1.5"><div class="h-2 w-8 rounded bg-zinc-200"></div><div class="h-2 w-8 rounded bg-zinc-200"></div><div class="h-2 w-8 rounded bg-zinc-200"></div></div>
                                    </div>
                                    <div class="rounded-lg bg-zinc-900 p-4">
                                        <div class="h-3 w-2/3 rounded bg-white/80"></div>
                                        <div class="mt-2 h-2 w-1/2 rounded bg-white/40"></div>
                                        <div class="mt-3 h-5 w-20 rounded bg-white"></div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2"><div class="h-12 rounded-lg bg-zinc-100"></div><div class="h-12 rounded-lg bg-zinc-100"></div><div class="h-12 rounded-lg bg-zinc-100"></div></div>
                                </div>

                                {{-- Magazin (eCommerce) --}}
                                <div x-show="type === 'ecommerce'" x-cloak x-transition.opacity class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <div class="h-2.5 w-16 rounded bg-zinc-300"></div>
                                        <div class="flex items-center gap-1.5"><div class="h-2 w-12 rounded-full bg-zinc-100"></div><div class="h-5 w-5 rounded-full bg-zinc-200"></div></div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        @for ($k = 0; $k < 6; $k++)
                                            <div class="rounded-lg border border-zinc-100 p-1.5">
                                                <div class="h-8 rounded bg-zinc-100"></div>
                                                <div class="mt-1.5 h-1.5 w-3/4 rounded bg-zinc-200"></div>
                                                <div class="mt-1 h-1.5 w-1/2 rounded bg-zinc-900"></div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                {{-- Platformă (SaaS) --}}
                                <div x-show="type === 'saas'" x-cloak x-transition.opacity class="space-y-3">
                                    <div class="grid grid-cols-3 gap-2">
                                        @for ($k = 0; $k < 3; $k++)
                                            <div class="rounded-lg bg-zinc-100 p-2"><div class="h-1.5 w-1/2 rounded bg-zinc-300"></div><div class="mt-1.5 h-3 w-2/3 rounded bg-zinc-900"></div></div>
                                        @endfor
                                    </div>
                                    <div class="flex h-16 items-end gap-1.5 rounded-lg border border-zinc-100 p-2">
                                        <div class="h-[40%] w-full rounded-t bg-zinc-300"></div>
                                        <div class="h-[65%] w-full rounded-t bg-zinc-400"></div>
                                        <div class="h-[50%] w-full rounded-t bg-zinc-300"></div>
                                        <div class="h-[80%] w-full rounded-t bg-zinc-700"></div>
                                        <div class="h-[60%] w-full rounded-t bg-zinc-400"></div>
                                        <div class="h-[92%] w-full rounded-t bg-zinc-900"></div>
                                    </div>
                                    <div class="space-y-1.5">
                                        @for ($k = 0; $k < 3; $k++)
                                            <div class="flex items-center gap-2"><div class="h-5 w-5 rounded bg-zinc-200"></div><div class="h-2 flex-1 rounded bg-zinc-100"></div></div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- C: CTA --}}
                <div class="lg:col-start-1 lg:row-start-2">
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a href="{{ Localization::route('contact') }}" class="rounded-lg bg-zinc-900 px-6 py-3 text-center text-base font-semibold text-white transition hover:bg-black">{{ $page['price_cta'] }}</a>
                        <a href="{{ Localization::route('pricing') }}" class="rounded-lg border border-zinc-300 px-6 py-3 text-center text-base font-semibold text-ink transition hover:bg-white">{{ __('services.index.cta_secondary') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modele de colaborare / oferte --}}
    @if (! empty($page['offers']))
        <section class="bg-white py-16 lg:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $page['offers_eyebrow'] }}</p>
                    <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ $page['offers_title'] }}</h2>
                    <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ $page['offers_subtitle'] }}</p>
                </div>

                <div data-animate-group class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($page['offers'] as $offer)
                        <div @class([
                            'flex h-full flex-col rounded-3xl border p-6 transition hover:-translate-y-1',
                            'border-zinc-900 bg-zinc-900 text-white shadow-xl' => $offer['featured'] ?? false,
                            'border-zinc-200 bg-white hover:border-zinc-900 hover:shadow-lg' => ! ($offer['featured'] ?? false),
                        ])>
                            @if ($offer['featured'] ?? false)
                                <span class="mb-3 inline-flex self-start rounded-full bg-white px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-zinc-900">{{ __('services.show.recommended') }}</span>
                            @endif
                            <h3 @class(['text-lg font-bold', 'text-white' => $offer['featured'] ?? false, 'text-ink' => ! ($offer['featured'] ?? false)])>{{ $offer['name'] }}</h3>
                            <div class="mt-3 flex flex-wrap items-baseline gap-x-2">
                                <span @class(['text-2xl font-bold tracking-tight', 'text-white' => $offer['featured'] ?? false, 'text-ink' => ! ($offer['featured'] ?? false)])>{{ $offer['price'] }}</span>
                                <span @class(['text-xs', 'text-zinc-400' => $offer['featured'] ?? false, 'text-muted' => ! ($offer['featured'] ?? false)])>{{ $offer['unit'] }}</span>
                            </div>
                            @if (! empty($offer['note']))
                                <p @class([
                                    'mt-2 inline-flex items-center gap-1.5 text-xs font-medium',
                                    'text-zinc-300' => $offer['featured'] ?? false,
                                    'text-muted' => ! ($offer['featured'] ?? false),
                                ])>
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l2.5 2.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $offer['note'] }}
                                </p>
                            @endif
                            <p @class(['mt-4 flex-1 text-sm leading-relaxed', 'text-zinc-300' => $offer['featured'] ?? false, 'text-muted' => ! ($offer['featured'] ?? false)])>{{ $offer['desc'] }}</p>
                            <a href="{{ Localization::route('contact') }}" @class([
                                'mt-6 rounded-lg px-4 py-2.5 text-center text-sm font-semibold transition',
                                'bg-white text-zinc-900 hover:bg-zinc-200' => $offer['featured'] ?? false,
                                'bg-zinc-900 text-white hover:bg-black' => ! ($offer['featured'] ?? false),
                            ])>{{ $page['price_cta'] }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Avantaj exclusiv + comparație cost --}}
    @if (! empty($svc['highlight']))
        <section class="bg-white py-16 lg:py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative overflow-hidden rounded-3xl bg-zinc-900 p-8 text-white sm:p-12">
                    <div class="bg-dot-grid pointer-events-none absolute inset-0 opacity-[0.12]"></div>
                    <div class="relative">
                    <p class="text-sm font-semibold uppercase tracking-wider text-zinc-400">{{ $svc['highlight']['title'] }}</p>
                    <p class="mt-3 max-w-3xl text-xl font-medium">{{ $svc['highlight']['text'] }}</p>

                    <div class="mt-8 grid max-w-2xl grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-white/15 p-5">
                            <p class="text-xs uppercase tracking-wider text-zinc-500">{{ $page['cost_old_label'] }}</p>
                            <p class="mt-2 text-xl font-bold text-zinc-500 line-through">{{ $page['cost_old_value'] }}</p>
                        </div>
                        <div class="rounded-2xl bg-white p-5 text-zinc-900">
                            <p class="text-xs uppercase tracking-wider text-zinc-500">{{ $page['cost_new_label'] }}</p>
                            <p class="mt-2 text-xl font-bold">{{ $page['cost_new_value'] }}</p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="{{ Localization::route('contact') }}" class="inline-block rounded-lg bg-white px-6 py-3 text-sm font-semibold text-zinc-900 transition hover:bg-zinc-200">{{ $page['price_cta'] }}</a>
                        @if (! empty($page['min_term']))
                            <span class="inline-flex items-center gap-1.5 text-sm text-zinc-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l2.5 2.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ $page['min_term'] }}
                            </span>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Ce include abonamentul (tabs interactive) --}}
    @if (! empty($modules))
        @php
            $moduleIcons = [
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 3l8 4v5c0 5-3.5 7.5-8 9-4.5-1.5-8-4-8-9V7z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9 12l2 2 4-4" />',
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 17l6-6 4 4 8-8M21 7v6m0-6h-6" />',
            ];
        @endphp
        <section class="border-y border-zinc-200 bg-paper py-20 lg:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $page['modules_eyebrow'] }}</p>
                    <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ $page['modules_title'] }}</h2>
                    @if (! empty($page['modules_subtitle']))
                        <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ $page['modules_subtitle'] }}</p>
                    @endif
                </div>

                <div data-animate="fade-up" x-data="{ tab: 0 }" class="mx-auto mt-12 max-w-4xl">
                    {{-- Tab-uri --}}
                    <div class="flex flex-col gap-3 sm:flex-row">
                        @foreach ($modules as $i => $module)
                            <button
                                type="button"
                                @click="tab = {{ $i }}"
                                :class="tab === {{ $i }} ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-200 bg-white text-zinc-700 hover:border-zinc-400'"
                                class="flex flex-1 items-center gap-3 rounded-2xl border p-4 text-left transition"
                            >
                                <span :class="tab === {{ $i }} ? 'bg-white/10 text-white' : 'bg-zinc-100 text-zinc-900'" class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl transition">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $moduleIcons[$i] ?? '' !!}</svg>
                                </span>
                                <span class="font-semibold">{{ $module['title'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    {{-- Panou --}}
                    <div class="mt-6">
                        @foreach ($modules as $i => $module)
                            <div
                                x-show="tab === {{ $i }}"
                                x-cloak
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-3"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="rounded-3xl border border-zinc-200 bg-white p-6 sm:p-8"
                            >
                                <ul class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                    @foreach ($module['items'] as $item)
                                        <li class="flex items-start gap-3 text-sm text-zinc-700">
                                            <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-zinc-100 text-zinc-900">
                                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
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

    {{-- Notă: SEO inclus --}}
    @if (! empty($svc['note']))
        <section class="bg-paper pb-16">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-3 rounded-2xl border border-zinc-300 bg-white p-5 text-sm text-zinc-700 sm:flex-row sm:items-center sm:justify-between">
                    <span>{{ $svc['note'] }}</span>
                    <a href="{{ Localization::serviceUrl('seo-aeo-geo') }}" class="shrink-0 font-semibold text-ink hover:underline">{{ __('services.items.seo-aeo-geo.name') }} &rarr;</a>
                </div>
            </div>
        </section>
    @endif

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
