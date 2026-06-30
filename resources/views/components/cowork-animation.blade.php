@props([
    'eyebrow' => null,
    'title' => '',
    'subtitle' => null,
])

@php
    // Carduri pe coloană, identic cu referința Tailwind (8 / 12 / 14 / 6)
    $columns = [8, 12, 14, 6];
@endphp

<section class="overflow-hidden bg-white py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Heading deasupra (nu peste plan, ca să rămână mereu lizibil) --}}
        <div class="mx-auto max-w-2xl text-center">
            @if ($eyebrow)
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ $eyebrow }}</p>
            @endif
            <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-5xl text-balance">{{ $title }}</h2>
            @if ($subtitle)
                <p data-animate="fade-up" class="mx-auto mt-5 max-w-xl text-lg text-muted">{{ $subtitle }}</p>
            @endif

            @if ($slot->isNotEmpty())
                <div data-animate="fade-up" class="mt-8 flex flex-wrap items-center justify-center gap-3">
                    {{ $slot }}
                </div>
            @endif
        </div>

        {{-- Tile cu planul izometric (decorativ) --}}
        <div data-animate="scale-in" class="isometric-tile mt-14 lg:mt-20" aria-hidden="true">
            <div class="isometric-stage">
                <div class="isometric-grid">
                    @foreach ($columns as $count)
                        <div class="isometric-col">
                            @for ($i = 0; $i < $count; $i++)
                                @php $dark = ($i % 4) === 2; @endphp
                                <div class="isometric-card {{ $dark ? 'isometric-card--dark' : '' }}">
                                    <div class="h-[34%] border-b {{ $dark ? 'border-white/10 bg-white/10' : 'border-zinc-200 bg-zinc-100' }}"></div>
                                    <div class="space-y-2 p-3">
                                        <div class="h-2 w-2/3 rounded {{ $dark ? 'bg-white/25' : 'bg-zinc-200' }}"></div>
                                        <div class="h-2 w-1/2 rounded {{ $dark ? 'bg-white/15' : 'bg-zinc-200' }}"></div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Vignette subtilă pe margini pentru un finish curat --}}
            <div class="pointer-events-none absolute inset-0 rounded-3xl shadow-[inset_0_0_80px_20px_var(--color-paper)]"></div>
        </div>
    </div>
</section>
