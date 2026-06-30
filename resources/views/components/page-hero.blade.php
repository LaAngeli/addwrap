@props([
    'eyebrow' => null,
    'title' => '',
    'subtitle' => null,
])

<section class="border-b border-zinc-200 bg-paper">
    <div class="mx-auto max-w-4xl px-4 py-16 text-center sm:px-6 lg:py-24">
        @if ($eyebrow)
            <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $eyebrow }}</p>
        @endif
        <h1 data-animate="fade-up" class="mt-3 text-4xl font-bold tracking-tight text-ink sm:text-5xl">{{ $title }}</h1>
        @if ($subtitle)
            <p data-animate="fade-up" class="mx-auto mt-5 max-w-2xl text-lg text-muted">{{ $subtitle }}</p>
        @endif
        {{ $slot }}
    </div>
</section>
