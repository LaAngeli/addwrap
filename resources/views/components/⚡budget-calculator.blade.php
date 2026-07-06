<?php

use App\Support\Localization;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    /** @var array<int, string> */
    public array $monthly = [];

    /** @var array<int, string> */
    public array $onetime = [];

    public int $months = 6;

    /**
     * @return array{monthly: int, monthly_from: bool, onetime: int, onetime_from: bool, contract: int, contract_from: bool, empty: bool}
     */
    #[Computed]
    public function estimate(): array
    {
        $cfg = config('site.pricing.calculator');

        $monthlySum = 0;
        $monthlyFrom = false;
        foreach ($this->monthly as $key) {
            if (isset($cfg['monthly'][$key])) {
                $monthlySum += (int) $cfg['monthly'][$key]['price'];
                $monthlyFrom = $monthlyFrom || (bool) $cfg['monthly'][$key]['from'];
            }
        }

        $onetimeSum = 0;
        $onetimeFrom = false;
        foreach ($this->onetime as $key) {
            if (isset($cfg['onetime'][$key])) {
                $onetimeSum += (int) $cfg['onetime'][$key]['price'];
                $onetimeFrom = $onetimeFrom || (bool) $cfg['onetime'][$key]['from'];
            }
        }

        return [
            'monthly' => $monthlySum,
            'monthly_from' => $monthlyFrom,
            'onetime' => $onetimeSum,
            'onetime_from' => $onetimeFrom,
            'contract' => $monthlySum * $this->months + $onetimeSum,
            'contract_from' => $monthlyFrom || $onetimeFrom,
            'empty' => $monthlySum === 0 && $onetimeSum === 0,
        ];
    }

    /**
     * Link către contact cu serviciile alese, mapate la cheile reale de serviciu
     * (item-urile atomice ale calculatorului → serviciul-părinte pentru pre-completare).
     */
    public function contactUrl(): string
    {
        $map = [
            'web-maintenance' => 'web-development',
            'web-creation' => 'web-development',
            'analytics-setup' => 'web-development',
        ];

        $valid = array_keys(config('site.services'));

        $keys = collect(array_merge($this->monthly, $this->onetime))
            ->map(fn (string $k): string => $map[$k] ?? $k)
            ->filter(fn (string $k): bool => in_array($k, $valid, true))
            ->unique()
            ->values()
            ->all();

        $params = ['months' => $this->months];

        if (! empty($keys)) {
            $params['services'] = implode(',', $keys);
        }

        return Localization::route('contact').'?'.http_build_query($params);
    }
};
?>

@php
    $fmt = fn (int $value): string => number_format($value, 0, ',', '.');
    $monthlyItems = config('site.pricing.calculator.monthly');
    $onetimeItems = config('site.pricing.calculator.onetime');
@endphp

<div class="overflow-hidden rounded-3xl border border-zinc-200 bg-white shadow-sm">
    <div class="grid grid-cols-1 lg:grid-cols-2">

        {{-- Configurare: două grupuri de selecție, plata lunară separată de one-time --}}
        <div class="border-b border-zinc-200 p-6 sm:p-8 lg:border-b-0 lg:border-r">

            {{-- Grup: abonament lunar --}}
            <div class="flex items-baseline justify-between gap-3">
                <p class="text-sm font-semibold text-ink">{{ __('calculator.group_monthly') }}</p>
                <span class="text-xs text-muted">{{ __('calculator.group_monthly_hint') }}</span>
            </div>
            <div class="mt-3 space-y-2.5">
                @foreach ($monthlyItems as $key => $it)
                    <label
                        wire:key="calc-m-{{ $key }}"
                        class="flex cursor-pointer items-center justify-between gap-3 rounded-xl border p-3 transition"
                        :class="$wire.monthly.includes('{{ $key }}') ? 'border-zinc-900 bg-zinc-50' : 'border-zinc-200 hover:border-zinc-400'"
                    >
                        <span class="flex items-center gap-3">
                            <span :class="$wire.monthly.includes('{{ $key }}') ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-300 text-transparent'" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border transition">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </span>
                            <span class="text-sm font-semibold text-ink">{{ __('calculator.items.'.$key) }}</span>
                        </span>
                        <span class="shrink-0 text-right text-sm font-semibold text-ink">
                            @if ($it['from'])<span class="mr-0.5 text-[10px] font-medium uppercase tracking-wide text-muted">{{ __('calculator.from_prefix') }}</span> @endif{{ $fmt($it['price']) }} €<span class="text-xs font-medium text-muted">{{ __('calculator.unit_month') }}</span>
                        </span>
                        <input type="checkbox" wire:model.live="monthly" value="{{ $key }}" class="sr-only">
                    </label>
                @endforeach
            </div>

            {{-- Grup: proiecte one-time --}}
            <div class="mt-6 flex items-baseline justify-between gap-3">
                <p class="text-sm font-semibold text-ink">{{ __('calculator.group_onetime') }}</p>
                <span class="text-xs text-muted">{{ __('calculator.group_onetime_hint') }}</span>
            </div>
            <div class="mt-3 space-y-2.5">
                @foreach ($onetimeItems as $key => $it)
                    <label
                        wire:key="calc-o-{{ $key }}"
                        class="flex cursor-pointer items-center justify-between gap-3 rounded-xl border p-3 transition"
                        :class="$wire.onetime.includes('{{ $key }}') ? 'border-zinc-900 bg-zinc-50' : 'border-zinc-200 hover:border-zinc-400'"
                    >
                        <span class="flex items-center gap-3">
                            <span :class="$wire.onetime.includes('{{ $key }}') ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-300 text-transparent'" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border transition">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </span>
                            <span class="text-sm font-semibold text-ink">{{ __('calculator.items.'.$key) }}</span>
                        </span>
                        <span class="shrink-0 text-right text-sm font-semibold text-ink">
                            @if ($it['from'])<span class="mr-0.5 text-[10px] font-medium uppercase tracking-wide text-muted">{{ __('calculator.from_prefix') }}</span> @endif{{ $fmt($it['price']) }} €
                        </span>
                        <input type="checkbox" wire:model.live="onetime" value="{{ $key }}" class="sr-only">
                    </label>
                @endforeach
            </div>

            {{-- Durata contractului — relevantă doar când există abonament lunar --}}
            @if ($this->estimate['monthly'] > 0)
                <p class="mt-6 mb-3 text-sm font-medium text-ink">{{ __('calculator.duration_label') }}</p>
                <div class="grid grid-cols-3 gap-2">
                    @foreach ([3, 6, 12] as $option)
                        <label
                            wire:key="calc-months-{{ $option }}"
                            class="cursor-pointer select-none rounded-xl border px-3 py-2 text-center text-sm font-medium transition"
                            :class="$wire.months === {{ $option }} ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-300 text-zinc-700 hover:border-zinc-400'"
                        >
                            <input type="radio" wire:model.live="months" value="{{ $option }}" class="sr-only">
                            {{ $option }} {{ __('calculator.months_unit') }}
                        </label>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Rezultat: abonament lunar și investiție inițială calculate separat --}}
        <div class="flex flex-col justify-center bg-zinc-900 p-6 text-white sm:p-8">
            @if ($this->estimate['empty'])
                <p class="text-zinc-400">{{ __('calculator.empty_state') }}</p>
            @else
                @if ($this->estimate['monthly'] > 0)
                    <p class="text-sm text-zinc-400">{{ __('calculator.monthly_total_label') }}</p>
                    <p class="mt-1 text-3xl font-bold sm:text-4xl">
                        @if ($this->estimate['monthly_from'])<span class="text-base font-medium text-zinc-400">{{ __('calculator.from_prefix') }} </span>@endif{{ $fmt($this->estimate['monthly']) }} €<span class="text-base font-medium text-zinc-400">{{ __('calculator.unit_month') }}</span>
                    </p>
                @endif

                @if ($this->estimate['onetime'] > 0)
                    <p class="mt-6 text-sm text-zinc-400">{{ __('calculator.onetime_total_label') }} <span class="text-zinc-500">· {{ __('calculator.onetime_note') }}</span></p>
                    <p class="mt-1 text-2xl font-bold sm:text-3xl">
                        @if ($this->estimate['onetime_from'])<span class="text-sm font-medium text-zinc-400">{{ __('calculator.from_prefix') }} </span>@endif{{ $fmt($this->estimate['onetime']) }} €
                    </p>
                @endif

                @if ($this->estimate['monthly'] > 0)
                    <div class="mt-6 border-t border-white/10 pt-5">
                        <p class="text-sm text-zinc-400">{{ __('calculator.contract_label', ['months' => $this->months]) }}</p>
                        <p class="mt-1 text-3xl font-bold sm:text-4xl">
                            @if ($this->estimate['contract_from'])<span class="text-base font-medium text-zinc-400">{{ __('calculator.from_prefix') }} </span>@endif{{ $fmt($this->estimate['contract']) }} €
                        </p>
                        <p class="mt-1 text-xs text-zinc-500">{{ __('calculator.contract_hint', ['months' => $this->months]) }}</p>
                    </div>
                @endif
            @endif

            <a href="{{ $this->contactUrl() }}" class="mt-8 inline-block rounded-lg bg-white px-6 py-3 text-center text-base font-semibold text-zinc-900 transition hover:bg-zinc-200">
                {{ __('calculator.cta') }}
            </a>
            <p class="mt-4 text-xs text-zinc-500">{{ __('calculator.disclaimer') }}</p>
        </div>
    </div>
</div>
