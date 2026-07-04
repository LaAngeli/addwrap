@use('App\Support\Turnstile')

@if (Turnstile::enabled())
    {{-- Doar widget-ul. Scriptul Cloudflare + înregistrarea Alpine „awTurnstile" se
         încarcă separat, la nivel de pagină (<x-turnstile-scripts />), ca să fie
         prezente din prima randare — altfel pe formularele multi-pas (project-starter)
         @push n-ar ajunge în @stack la un update Livewire parțial. Widget randat
         explicit în wire:ignore; token-ul rezolvat intră în proprietatea Livewire
         `turnstileToken`, verificat server-side în submit(). --}}
    <div wire:ignore x-data="awTurnstile" x-init="mount()" class="min-h-[65px]">
        <div x-ref="widget"></div>
    </div>
@endif
