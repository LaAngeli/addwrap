@props([
    'title' => '',
    'text' => null,
    'button' => '',
    'href' => '#',
])

<section class="relative overflow-hidden bg-zinc-900">
    <div class="bg-dot-grid pointer-events-none absolute inset-0 text-white opacity-[0.12]"></div>

    {{-- Glow de brand (portocaliu) pe fundal ink --}}
    <div class="pointer-events-none absolute -left-24 -top-24 h-72 w-72 rounded-full bg-orange opacity-20 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-28 -right-16 h-80 w-80 rounded-full bg-zinc-700 opacity-25 blur-3xl"></div>

    <div class="relative mx-auto max-w-4xl px-4 py-16 text-center sm:px-6 lg:py-20">
        <h2 data-animate="fade-up" class="text-3xl font-bold tracking-tight text-white sm:text-4xl text-balance">{{ $title }}</h2>
        @if ($text)
            <p data-animate="fade-up" class="mx-auto mt-4 max-w-xl text-lg text-zinc-400">{{ $text }}</p>
        @endif
        <div data-animate="fade-up" class="mt-8">
            <a href="{{ $href }}" class="inline-block rounded-lg bg-orange px-6 py-3 text-base font-semibold text-white shadow-sm transition hover:bg-orange-deep">{{ $button }}</a>
        </div>
    </div>
</section>
