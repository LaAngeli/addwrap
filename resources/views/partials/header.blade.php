@php
    use App\Support\Localization;
    $services = Localization::services();
@endphp

<header
    x-data="{ mobileOpen: false }"
    class="sticky top-0 z-40 w-full border-b border-slate-200 bg-paper/90 backdrop-blur"
>
    <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8" aria-label="{{ __('messages.common.menu') }}">

        {{-- Logo --}}
        <a href="{{ Localization::route('home') }}" class="flex items-center text-ink" aria-label="{{ config('site.company.name') }}">
            {{-- Desktop: lockup complet (marcă + wordmark) --}}
            <img src="{{ asset('images/logo/addwrap-lockup.png') }}" alt="{{ config('site.company.name') }}" width="1100" height="203" class="hidden h-10 w-auto lg:block" />
            {{-- Mobil: doar marca --}}
            <x-logo markOnly class="lg:hidden" />
        </a>

        {{-- Navigare desktop --}}
        <div class="hidden items-center gap-1 lg:flex">
            <a href="{{ Localization::route('home') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100 hover:text-ink">
                {{ __('messages.nav.home') }}
            </a>

            {{-- Dropdown servicii --}}
            <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                <a
                    href="{{ Localization::route('services.index') }}"
                    @click="open = false"
                    class="flex items-center gap-1 rounded-lg px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100 hover:text-ink"
                    aria-haspopup="true"
                    :aria-expanded="open"
                >
                    {{ __('messages.nav.services') }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </a>

                <div
                    x-show="open"
                    x-transition.opacity
                    x-cloak
                    class="absolute left-0 top-full w-72 pt-2"
                >
                    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white p-2 shadow-lg">
                        @foreach ($services as $key => $service)
                            <a
                                href="{{ Localization::serviceUrl($key) }}"
                                class="block rounded-lg px-3 py-2 text-sm text-slate-700 transition hover:bg-slate-50 hover:text-brand-700"
                            >
                                <span class="font-medium">{{ __('services.items.'.$key.'.name') }}</span>
                                <span class="block text-xs text-muted">{{ __('services.items.'.$key.'.tagline') }}</span>
                            </a>
                        @endforeach
                        <a href="{{ Localization::route('services.index') }}" class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium text-brand-700 transition hover:bg-brand-50">
                            {{ __('messages.cta.all_services') }} &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ Localization::route('about') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100 hover:text-ink">{{ __('messages.nav.about') }}</a>
            <a href="{{ Localization::route('portfolio') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100 hover:text-ink">{{ __('messages.nav.portfolio') }}</a>
            <a href="{{ Localization::route('blog') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100 hover:text-ink">{{ __('messages.nav.blog') }}</a>
            <a href="{{ Localization::route('pricing') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100 hover:text-ink">{{ __('messages.nav.pricing') }}</a>
        </div>

        {{-- Acțiuni dreapta --}}
        <div class="hidden items-center gap-3 lg:flex">
            @include('partials.language-switcher')
            <a href="{{ Localization::route('contact') }}" class="rounded-lg bg-orange px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-deep">
                {{ __('messages.nav.contact') }}
            </a>
        </div>

        {{-- Buton meniu mobil (hamburger animat) --}}
        <button
            type="button"
            @click="mobileOpen = !mobileOpen"
            class="group inline-flex h-11 w-11 items-center justify-center rounded-lg text-slate-700 transition hover:bg-slate-100 active:scale-90 lg:hidden"
            :aria-expanded="mobileOpen"
            aria-controls="mobile-menu"
        >
            <span class="sr-only">{{ __('messages.common.open_menu') }}</span>
            <span class="flex h-4 w-6 flex-col justify-between" aria-hidden="true">
                <span class="h-0.5 w-full rounded-full bg-current transition-all duration-300 group-hover:w-4"></span>
                <span class="h-0.5 w-4 rounded-full bg-current transition-all duration-300 group-hover:w-6"></span>
                <span class="h-0.5 w-full rounded-full bg-current transition-all duration-300 group-hover:w-3"></span>
            </span>
        </button>
    </nav>

    {{-- Meniu mobil — overlay full-screen, modern & interactiv --}}
    @php
        $mainLinks = [
            ['route' => 'about', 'pattern' => '*.about', 'label' => __('messages.nav.about')],
            ['route' => 'portfolio', 'pattern' => '*.portfolio*', 'label' => __('messages.nav.portfolio')],
            ['route' => 'blog', 'pattern' => '*.blog*', 'label' => __('messages.nav.blog')],
            ['route' => 'pricing', 'pattern' => '*.pricing', 'label' => __('messages.nav.pricing')],
        ];
    @endphp
    <template x-teleport="body">
    <div
        x-show="mobileOpen"
        x-cloak
        @keydown.escape.window="mobileOpen = false"
        x-effect="document.body.style.overflow = mobileOpen ? 'hidden' : ''"
        class="fixed inset-0 z-50 lg:hidden"
        role="dialog"
        aria-modal="true"
        aria-label="{{ __('messages.common.menu') }}"
    >
        <div
            x-show="mobileOpen"
            x-transition:enter="transition transform ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition transform ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="absolute inset-0 flex flex-col bg-paper"
            x-data="{ servicesOpen: {{ request()->routeIs('*.services.*') ? 'true' : 'false' }} }"
        >
            {{-- Bara de sus: limbă (stânga) · logo (centru) · închidere (dreapta) --}}
            <div class="relative flex h-16 shrink-0 items-center justify-center border-b border-zinc-200 px-4">
                <div class="absolute left-4 top-1/2 -translate-y-1/2">
                    @include('partials.language-switcher')
                </div>
                <a href="{{ Localization::route('home') }}" @click="mobileOpen = false" class="flex items-center text-ink" aria-label="{{ config('site.company.name') }}">
                    <img src="{{ asset('images/logo/addwrap-lockup.png') }}" alt="{{ config('site.company.name') }}" width="1100" height="203" class="h-8 w-auto" />
                </a>
                <button type="button" @click="mobileOpen = false" class="group absolute right-4 top-1/2 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-xl text-zinc-700 transition hover:bg-zinc-100 active:scale-90" aria-label="{{ __('messages.common.menu') }}">
                    <svg class="h-6 w-6 transition-transform duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            {{-- Linkuri (scrollabile) --}}
            <nav class="flex flex-1 flex-col overflow-y-auto px-4 py-5">
                <div class="space-y-1">

                {{-- Home --}}
                <a href="{{ Localization::route('home') }}" @click="mobileOpen = false" @class([
                    'group flex items-center justify-between rounded-xl px-4 py-3.5 text-lg font-semibold transition',
                    'bg-teal text-white' => request()->routeIs('*.home'),
                    'text-ink hover:bg-zinc-50' => ! request()->routeIs('*.home'),
                ])>
                    {{ __('messages.nav.home') }}
                    <svg class="h-5 w-5 opacity-30 transition group-hover:translate-x-0.5 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>

                {{-- Servicii (acordeon) --}}
                <div>
                    <button type="button" @click="servicesOpen = !servicesOpen" :aria-expanded="servicesOpen" @class([
                        'flex w-full items-center justify-between rounded-xl px-4 py-3.5 text-lg font-semibold transition',
                        'text-ink' => request()->routeIs('*.services.*'),
                        'text-ink hover:bg-zinc-50' => ! request()->routeIs('*.services.*'),
                    ])>
                        <span class="flex items-center gap-2">
                            {{ __('messages.nav.services') }}
                            @if (request()->routeIs('*.services.*'))
                                <span class="inline-block h-1.5 w-1.5 rounded-full bg-orange"></span>
                            @endif
                        </span>
                        <svg class="h-5 w-5 text-zinc-400 transition-transform duration-300" :class="servicesOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>

                    <div x-show="servicesOpen" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                    >
                        <div class="mt-1 space-y-1 pb-1 pl-2">
                            @foreach ($services as $key => $service)
                                @php $svcActive = request()->url() === Localization::serviceUrl($key); @endphp
                                <a href="{{ Localization::serviceUrl($key) }}" @click="mobileOpen = false" @class([
                                    'flex items-center gap-3 rounded-xl px-3 py-2.5 transition',
                                    'bg-teal text-white' => $svcActive,
                                    'text-zinc-700 hover:bg-zinc-50' => ! $svcActive,
                                ])>
                                    <span @class([
                                        'inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg',
                                        'bg-white/10 text-white' => $svcActive,
                                        'bg-zinc-100 text-zinc-700' => ! $svcActive,
                                    ])>
                                        <x-service-icon :name="config('site.services.'.$key.'.icon', 'simple')" class="h-5 w-5" />
                                    </span>
                                    <span class="min-w-0">
                                        <span class="block text-sm font-semibold">{{ __('services.items.'.$key.'.name') }}</span>
                                        <span @class(['block truncate text-xs', 'text-zinc-400' => $svcActive, 'text-muted' => ! $svcActive])>{{ __('services.items.'.$key.'.tagline') }}</span>
                                    </span>
                                </a>
                            @endforeach
                            <a href="{{ Localization::route('services.index') }}" @click="mobileOpen = false" class="flex items-center justify-between rounded-xl px-3 py-2.5 text-sm font-semibold text-orange transition hover:bg-zinc-50">
                                {{ __('messages.cta.all_services') }}
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Restul paginilor --}}
                @foreach ($mainLinks as $link)
                    <a href="{{ Localization::route($link['route']) }}" @click="mobileOpen = false" @class([
                        'group flex items-center justify-between rounded-xl px-4 py-3.5 text-lg font-semibold transition',
                        'bg-teal text-white' => request()->routeIs($link['pattern']),
                        'text-ink hover:bg-zinc-50' => ! request()->routeIs($link['pattern']),
                    ])>
                        {{ $link['label'] }}
                        <svg class="h-5 w-5 opacity-30 transition group-hover:translate-x-0.5 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                @endforeach
                </div>

                {{-- Ilustrație de brand: ecosistem orbital animat — umple uniform spațiul --}}
                @php
                    $orbitPos = ['left-[50%] top-[12%]', 'left-[83%] top-[31%]', 'left-[83%] top-[69%]', 'left-[50%] top-[88%]', 'left-[17%] top-[69%]', 'left-[17%] top-[31%]'];
                    $orbitLines = [[50, 12], [83, 31], [83, 69], [50, 88], [17, 69], [17, 31]];
                @endphp
                <div class="relative mt-6 flex flex-1 flex-col items-center justify-center overflow-hidden rounded-2xl border border-zinc-100 bg-zinc-50/60 px-4 py-6">
                    <div class="bg-dot-grid pointer-events-none absolute inset-0 text-zinc-300 opacity-50"></div>
                    <div class="pointer-events-none absolute -top-8 right-0 h-44 w-44 rounded-full bg-orange/10 blur-3xl"></div>

                    <div class="relative w-full max-w-[244px]">
                        <div class="relative aspect-square">
                            {{-- Linii + inel punctat rotativ --}}
                            <svg viewBox="0 0 100 100" class="absolute inset-0 h-full w-full" fill="none" aria-hidden="true">
                                @foreach ($orbitLines as [$lx, $ly])
                                    <line x1="{{ $lx }}" y1="{{ $ly }}" x2="50" y2="50" stroke="#e4e4e7" stroke-width="0.7" />
                                @endforeach
                                <circle cx="50" cy="50" r="38" stroke="#d4d4d8" stroke-width="0.6" stroke-dasharray="1.6 3" class="aw-orbit-ring" />
                            </svg>

                            {{-- Puls portocaliu radiind din centru --}}
                            <span class="aw-pulse pointer-events-none absolute left-1/2 top-1/2 h-14 w-14 -translate-x-1/2 -translate-y-1/2 rounded-full bg-orange/25"></span>

                            {{-- Noduri servicii --}}
                            @foreach (Localization::services() as $key => $service)
                                <div class="absolute {{ $orbitPos[$loop->index] ?? '' }} -translate-x-1/2 -translate-y-1/2">
                                    <span class="flex h-9 w-9 items-center justify-center rounded-xl border border-zinc-200 bg-white text-zinc-700 shadow-sm">
                                        <x-service-icon :name="config('site.services.'.$key.'.icon', 'simple')" class="h-4 w-4" />
                                    </span>
                                </div>
                            @endforeach

                            {{-- Marca centrală --}}
                            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                                <span class="flex h-14 w-14 items-center justify-center rounded-full bg-teal shadow-lg ring-4 ring-white">
                                    <x-brand-glyph class="h-4 w-auto text-white" />
                                </span>
                            </div>
                        </div>

                        <p class="mt-4 text-center text-sm font-semibold uppercase tracking-wider text-ink">{{ __('pages.about.story_roof_label') }}</p>
                        <p class="mt-1 text-center text-xs text-muted">{{ __('pages.about.story_roof_caption') }}</p>
                    </div>
                </div>
            </nav>

            {{-- Subsol fix: Contact --}}
            <div class="shrink-0 border-t border-zinc-200 px-4 py-4">
                <a href="{{ Localization::route('contact') }}" @click="mobileOpen = false" class="flex items-center justify-center gap-2 rounded-xl bg-orange px-4 py-3.5 text-base font-semibold text-white transition hover:bg-orange-deep">
                    {{ __('messages.nav.contact') }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>
        </div>
    </div>
    </template>
</header>
