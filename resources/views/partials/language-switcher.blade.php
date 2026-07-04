@php
    use App\Support\Localization;

    $current = app()->getLocale();
    $other = collect(Localization::all())->first(fn ($l) => $l !== $current) ?? $current;
    $otherUrl = Localization::switchUrl($other);
@endphp

{{-- Comutator de limbă: e un LINK care navighează la cealaltă versiune de limbă
     (nu un role="switch" — acela e pentru toggle on/off pe loc, ar deruta agenții AI
     și cere aria-checked). Etichetele RO/EN sunt pur vizuale (aria-hidden), iar numele
     accesibil descrie acțiunea; hreflang indică limba destinației. --}}
<a
    href="{{ $otherUrl }}"
    hreflang="{{ $other }}"
    x-data="{ ro: @js($current === 'ro') }"
    @click.prevent="ro = !ro; setTimeout(() => { window.location.href = $el.href }, 280)"
    aria-label="{{ __('messages.common.switch_language') }}"
    title="{{ strtoupper($other) }}"
    class="relative inline-flex h-8 w-16 shrink-0 items-center rounded-full border border-zinc-300 bg-zinc-100 p-1 text-[11px] font-bold leading-none select-none transition hover:border-zinc-400"
>
    {{-- Knob care alunecă --}}
    <span
        x-cloak
        aria-hidden="true"
        class="absolute inset-y-1 left-1 w-[1.75rem] rounded-full bg-white shadow-sm transition-transform duration-300 ease-out"
        :class="ro ? 'translate-x-0' : 'translate-x-full'"
    ></span>

    <span aria-hidden="true" class="relative z-10 w-1/2 text-center transition-colors duration-300" :class="ro ? 'text-ink' : 'text-zinc-400'">RO</span>
    <span aria-hidden="true" class="relative z-10 w-1/2 text-center transition-colors duration-300" :class="ro ? 'text-zinc-400' : 'text-ink'">EN</span>
</a>
