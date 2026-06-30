<?php

use App\Support\Localization;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    /** @var array<int, string> */
    public array $selected = [];

    public int $months = 6;

    /**
     * @return array{monthly: int, setup: int, total: int, empty: bool}
     */
    #[Computed]
    public function estimate(): array
    {
        $pricing = config('site.pricing.services');
        $monthly = 0;
        $setup = 0;

        foreach ($this->selected as $key) {
            $monthly += $pricing[$key]['monthly'] ?? 0;
            $setup += $pricing[$key]['setup'] ?? 0;
        }

        return [
            'monthly' => $monthly,
            'setup' => $setup,
            'total' => $monthly * $this->months + $setup,
            'empty' => $monthly === 0 && $setup === 0,
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function services(): array
    {
        return \App\Support\Localization::services();
    }

    /**
     * Link către contact cu serviciile alese + amploarea transmise ca parametri,
     * pentru pre-completarea formularului de contact.
     */
    public function contactUrl(): string
    {
        $params = ['months' => $this->months];

        if (! empty($this->selected)) {
            $params['services'] = implode(',', $this->selected);
        }

        return Localization::route('contact').'?'.http_build_query($params);
    }
};
?>

@php
    $fmt = fn (int $value): string => number_format($value, 0, ',', '.').' €';
@endphp

<div class="overflow-hidden rounded-3xl border border-zinc-200 bg-white shadow-sm">
    <div class="grid grid-cols-1 lg:grid-cols-2">

        {{-- Configurare --}}
        <div class="border-b border-zinc-200 p-6 sm:p-8 lg:border-b-0 lg:border-r">
            <p class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('calculator.eyebrow') }}</p>
            <h3 class="mt-2 text-2xl font-bold tracking-tight text-ink">{{ __('calculator.title') }}</h3>
            <p class="mt-2 text-sm text-muted">{{ __('calculator.subtitle') }}</p>

            {{-- Servicii --}}
            <p class="mt-6 mb-3 text-sm font-medium text-ink">{{ __('calculator.services_label') }}</p>
            <div class="flex flex-wrap gap-2">
                @foreach ($this->services() as $key => $service)
                    <label
                        wire:key="calc-{{ $key }}"
                        class="cursor-pointer select-none rounded-full border px-4 py-2 text-sm font-medium transition"
                        :class="$wire.selected.includes('{{ $key }}') ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-300 text-zinc-700 hover:border-zinc-400'"
                    >
                        <input type="checkbox" wire:model.live="selected" value="{{ $key }}" class="sr-only">
                        {{ __('services.items.'.$key.'.name') }}
                    </label>
                @endforeach
            </div>

            {{-- Durata contractului --}}
            <p class="mt-6 mb-3 text-sm font-medium text-ink">{{ __('calculator.duration_label') }}</p>
            <div class="grid grid-cols-3 gap-2">
                @foreach ([3, 6, 12] as $option)
                    <label
                        wire:key="months-{{ $option }}"
                        class="cursor-pointer select-none rounded-xl border px-3 py-2 text-center text-sm font-medium transition"
                        :class="$wire.months === {{ $option }} ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-300 text-zinc-700 hover:border-zinc-400'"
                    >
                        <input type="radio" wire:model.live="months" value="{{ $option }}" class="sr-only">
                        {{ $option }} {{ __('calculator.months_unit') }}
                    </label>
                @endforeach
            </div>
        </div>

        {{-- Rezultat --}}
        <div class="flex flex-col justify-center bg-zinc-900 p-6 text-white sm:p-8">
            @if ($this->estimate['empty'])
                <p class="text-zinc-400">{{ __('calculator.empty_state') }}</p>
            @else
                @if ($this->estimate['monthly'] > 0)
                    <p class="text-sm text-zinc-400">{{ __('calculator.monthly_label') }}</p>
                    <p class="mt-1 text-3xl font-bold sm:text-4xl">{{ $fmt($this->estimate['monthly']) }}<span class="text-base font-medium text-zinc-400"> {{ __('pages.pricing.hero_calc_unit') }}</span></p>
                @endif

                @if ($this->estimate['setup'] > 0)
                    <p class="mt-6 text-sm text-zinc-400">{{ __('calculator.setup_label') }}</p>
                    <p class="mt-1 text-2xl font-bold sm:text-3xl">{{ $fmt($this->estimate['setup']) }}</p>
                @endif

                <div class="mt-6 border-t border-white/10 pt-5">
                    <p class="text-sm text-zinc-400">{{ __('calculator.total_label', ['months' => $this->months]) }}</p>
                    <p class="mt-1 text-3xl font-bold sm:text-4xl">{{ $fmt($this->estimate['total']) }}</p>
                </div>
            @endif

            <a href="{{ $this->contactUrl() }}" class="mt-8 inline-block rounded-lg bg-white px-6 py-3 text-center text-base font-semibold text-zinc-900 transition hover:bg-zinc-200">
                {{ __('calculator.cta') }}
            </a>
            <p class="mt-4 text-xs text-zinc-500">{{ __('calculator.disclaimer') }}</p>
        </div>
    </div>
</div>
