@props([
    'code' => '',
    'eyebrow' => '',
    'title' => '',
    'subtitle' => '',
    'ctaHome' => null,
    'ctaContact' => null,
    'ctaContactRoute' => 'contact',
    'shortcuts' => false,
    'helpEyebrow' => '',
    'helpTitle' => '',
])

@php
    use App\Support\Localization;

    $shortcutLinks = [
        ['route' => 'services.index', 'label' => __('messages.nav.services')],
        ['route' => 'portfolio',      'label' => __('messages.nav.portfolio')],
        ['route' => 'blog',           'label' => __('messages.nav.blog')],
        ['route' => 'pricing',        'label' => __('messages.nav.pricing')],
        ['route' => 'about',          'label' => __('messages.nav.about')],
        ['route' => 'faq',            'label' => __('messages.nav.faq')],
    ];
@endphp

{{-- Hero centrat, înălțime generoasă --}}
<section class="relative flex min-h-[62vh] items-center overflow-hidden bg-paper sm:min-h-[68vh]">
    <div class="bg-dot-grid pointer-events-none absolute inset-0 -z-10 opacity-40 [mask-image:radial-gradient(ellipse_at_center,black,transparent_62%)]"></div>
    <div class="pointer-events-none absolute left-1/2 top-1/3 -z-10 h-72 w-72 -translate-x-1/2 rounded-full bg-zinc-100 blur-3xl sm:h-96 sm:w-96"></div>

    <div class="mx-auto w-full max-w-2xl px-4 py-16 text-center sm:px-6 lg:py-20">

        {{-- Vizual specific codului de eroare --}}
        @isset($visual)
            <div data-animate="scale-in" class="mb-10 flex justify-center sm:mb-12">{{ $visual }}</div>
        @endisset

        @if ($eyebrow)
            <p data-animate="fade-up" class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-white/80 px-4 py-1.5 text-sm font-medium text-muted backdrop-blur">
                <span class="relative flex h-2 w-2">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-orange opacity-60"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-orange"></span>
                </span>
                {{ $eyebrow }}
            </p>
        @endif

        <h1 data-animate="fade-up" data-animate-delay="0.08" class="mt-6 text-3xl font-bold tracking-tight text-ink text-balance sm:text-4xl lg:text-5xl">
            {{ $title }}
        </h1>

        @if ($subtitle)
            <p data-animate="fade-up" data-animate-delay="0.16" class="mx-auto mt-5 max-w-xl text-base text-muted text-pretty sm:text-lg">
                {{ $subtitle }}
            </p>
        @endif

        @if ($ctaHome || $ctaContact)
            <div data-animate="fade-up" data-animate-delay="0.24" class="mt-9 flex flex-col gap-3 sm:flex-row sm:justify-center">
                @if ($ctaHome)
                    <a href="{{ Localization::route('home') }}" class="w-full rounded-lg bg-orange px-6 py-3.5 text-base font-semibold text-white shadow-sm transition hover:bg-orange-deep hover:shadow-md sm:w-auto">
                        {{ $ctaHome }}
                    </a>
                @endif
                @if ($ctaContact)
                    <a href="{{ Localization::route($ctaContactRoute) }}" class="w-full rounded-lg border border-zinc-300 bg-white px-6 py-3.5 text-base font-semibold text-ink transition hover:border-zinc-900 sm:w-auto">
                        {{ $ctaContact }}
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>

{{-- Scurtături către secțiunile principale (opțional) --}}
@if ($shortcuts)
    <section class="border-t border-zinc-200 bg-paper py-12 lg:py-16">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            @if ($helpEyebrow)
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $helpEyebrow }}</p>
            @endif
            @if ($helpTitle)
                <h2 data-animate="fade-up" class="mt-2 text-xl font-bold tracking-tight text-ink sm:text-2xl">{{ $helpTitle }}</h2>
            @endif

            <div data-animate-group class="mt-8 flex flex-wrap justify-center gap-2.5">
                @foreach ($shortcutLinks as $sc)
                    <a
                        href="{{ Localization::route($sc['route']) }}"
                        class="group inline-flex items-center gap-2 rounded-full border border-zinc-300 bg-white px-4 py-2 text-sm font-medium text-ink transition hover:-translate-y-0.5 hover:border-zinc-900 hover:shadow-sm"
                    >
                        {{ $sc['label'] }}
                        <svg class="h-3.5 w-3.5 text-zinc-400 transition group-hover:translate-x-0.5 group-hover:text-ink" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif
