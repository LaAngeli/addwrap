@props([
    'left' => '4',
    'right' => '4',
    'digits' => null,
    'stacked' => false,
])

{{--
    Glyph-ul codului de eroare, cu parallax subtil după cursor pe desktop
    (pe mobil și pe reduced-motion rămâne static).

    Două variante:
    - inline (implicit): „cifră · emblem · cifră" — emblemul ține locul „0"-ului
      central (404, 403, 500, 503).
    - stacked: emblemul deasupra, codul complet dedesubt (419, 429 — nu au „0").
--}}
<div
    x-data="{
        t: '',
        ok() {
            return window.matchMedia('(hover: hover) and (pointer: fine) and (prefers-reduced-motion: no-preference)').matches;
        },
        move(e) {
            if (! this.ok()) return;
            const r = this.$el.getBoundingClientRect();
            const px = (e.clientX - r.left) / r.width - 0.5;
            const py = (e.clientY - r.top) / r.height - 0.5;
            this.t = 'perspective(900px) rotateY(' + (px * 9).toFixed(2) + 'deg) rotateX(' + (-py * 9).toFixed(2) + 'deg)';
        },
        reset() { this.t = ''; }
    }"
    @pointermove="move($event)"
    @pointerleave="reset()"
    :style="t ? 'transform: ' + t : ''"
    @class([
        'transition-transform duration-200 ease-out [transform-style:preserve-3d]',
        'flex flex-col items-center gap-5' => $stacked,
        'flex items-center justify-center gap-3 sm:gap-5' => ! $stacked,
    ])
>
    @if ($stacked)
        <span class="relative inline-flex h-24 w-24 items-center justify-center sm:h-32 sm:w-32 lg:h-36 lg:w-36">
            {{ $slot }}
        </span>
        <span class="select-none text-[4.5rem] font-black leading-none tracking-tighter text-ink sm:text-[6rem] lg:text-[7rem]" aria-hidden="true">{{ $digits }}</span>
    @else
        <span class="select-none text-[5.5rem] font-black leading-none tracking-tighter text-ink sm:text-[8rem] lg:text-[10rem]" aria-hidden="true">{{ $left }}</span>

        <span class="relative inline-flex h-[3.8rem] w-[3.8rem] shrink-0 items-center justify-center sm:h-[5.5rem] sm:w-[5.5rem] lg:h-[7rem] lg:w-[7rem]">
            {{ $slot }}
        </span>

        <span class="select-none text-[5.5rem] font-black leading-none tracking-tighter text-ink sm:text-[8rem] lg:text-[10rem]" aria-hidden="true">{{ $right }}</span>
    @endif
</div>
