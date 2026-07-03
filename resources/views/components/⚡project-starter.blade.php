<?php

use App\Mail\ContactConfirmationMail;
use App\Mail\ContactFormMail;
use App\Support\Localization;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public int $step = 1;

    public string $goal = '';

    /** @var array<int, string> */
    public array $selected = [];

    public string $budget = '';

    public string $timeline = '';

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public bool $consent = false;

    public string $website = '';

    public function selectGoal(string $goal): void
    {
        $this->goal = $goal;
        $this->step = 2;
    }

    public function next(): void
    {
        // Nu permite avansul fără selecție la pasul curent.
        if ($this->step === 2 && empty($this->selected)) {
            return;
        }

        if ($this->step === 3 && ($this->budget === '' || $this->timeline === '')) {
            return;
        }

        $this->step = min(4, $this->step + 1);
    }

    public function back(): void
    {
        $this->step = max(1, $this->step - 1);
    }

    /**
     * @return array{monthly: int, setup: int, empty: bool}
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

        return ['monthly' => $monthly, 'setup' => $setup, 'empty' => $monthly === 0 && $setup === 0];
    }

    public function submit()
    {
        if ($this->website !== '') {
            $this->addError('form', __('contact.spam_detected'));

            return null;
        }

        $key = 'project-starter:'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('form', __('contact.rate_limited'));

            return null;
        }

        $this->validate([
            'name' => ['required', 'string', 'min:2', 'max:120', 'regex:/^[\p{L}\p{M}\s.\'-]+$/u'],
            'email' => ['required', 'string', 'email:rfc,strict', 'max:180'],
            'phone' => ['required', 'string', 'regex:/^\+?[0-9\s().-]{7,20}$/'],
            'consent' => ['accepted'],
        ], [
            'name.regex' => __('contact.errors.name_invalid'),
            'phone.regex' => __('contact.errors.phone_invalid'),
        ], [
            'name' => __('contact.fields.name'),
            'email' => __('contact.fields.email'),
            'phone' => __('contact.fields.phone'),
            'consent' => __('contact.fields.consent'),
        ]);

        RateLimiter::hit($key, 60);

        $serviceNames = array_map(fn (string $key) => __('services.items.'.$key.'.name'), $this->selected);

        $lines = [
            __('starter.q_goal').': '.($this->goal ? __('starter.goals.'.$this->goal) : '-'),
            __('starter.summary_services').': '.(count($serviceNames) ? implode(', ', $serviceNames) : '-'),
            __('starter.q_budget').': '.($this->budget ? __('starter.budgets.'.$this->budget) : '-'),
            __('starter.q_timeline').': '.($this->timeline ? __('starter.timelines.'.$this->timeline) : '-'),
        ];

        if (! $this->estimate['empty']) {
            $lines[] = __('starter.summary_estimate').': ~'.number_format($this->estimate['monthly'], 0, ',', '.').' €/lună, setup ~'.number_format($this->estimate['setup'], 0, ',', '.').' €';
        }

        $payload = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'service' => '',
            'message' => implode("\n", $lines),
        ];

        $locale = Localization::current();

        // Email business — prioritar.
        Mail::to(config('site.company.email'))->send(new ContactFormMail($payload));

        // Confirmare către expeditor în limba navigării — best-effort.
        try {
            Mail::to($this->email)
                ->locale($locale)
                ->send(new ContactConfirmationMail($payload));
        } catch (\Throwable $e) {
            Log::warning('Project starter confirmation email failed', [
                'email' => $this->email,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->to(Localization::route('thank_you'));
    }
};
?>

@php
    $fmt = fn (int $value): string => number_format($value, 0, ',', '.').' €';
@endphp

<div class="overflow-hidden rounded-3xl border border-zinc-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-zinc-200 px-6 py-4 sm:px-8">
        <p class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('starter.eyebrow') }}</p>
        <p class="text-sm text-muted">{{ __('quiz.step', ['current' => $step, 'total' => 4]) }}</p>
    </div>

    <div class="h-1.5 w-full bg-zinc-100">
        <div class="h-full bg-zinc-900 transition-all" style="width: {{ ($step / 4) * 100 }}%"></div>
    </div>

    <div class="p-6 sm:p-8" wire:key="starter-step-{{ $step }}">

        @if ($step === 1)
            <h3 class="text-xl font-bold text-ink sm:text-2xl">{{ __('starter.q_goal') }}</h3>
            <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">
                @foreach (['brand', 'sales', 'visibility', 'website'] as $option)
                    <button type="button" wire:key="sg-{{ $option }}" wire:click="selectGoal('{{ $option }}')"
                        class="rounded-xl border border-zinc-300 px-4 py-4 text-left text-sm font-medium text-zinc-800 transition hover:border-zinc-900 hover:bg-zinc-50">
                        {{ __('starter.goals.'.$option) }}
                    </button>
                @endforeach
            </div>

        @elseif ($step === 2)
            <h3 class="text-xl font-bold text-ink sm:text-2xl">{{ __('starter.q_services') }}</h3>
            <div class="mt-5 flex flex-wrap gap-2">
                @foreach (\App\Support\Localization::services() as $key => $service)
                    <label wire:key="ss-{{ $key }}"
                        class="cursor-pointer select-none rounded-full border px-4 py-2 text-sm font-medium transition"
                        :class="$wire.selected.includes('{{ $key }}') ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-300 text-zinc-700 hover:border-zinc-400'">
                        <input type="checkbox" wire:model.live="selected" value="{{ $key }}" class="sr-only">
                        {{ __('services.items.'.$key.'.name') }}
                    </label>
                @endforeach
            </div>

            @if (! $this->estimate['empty'])
                <div class="mt-6 rounded-2xl bg-zinc-900 p-5 text-white">
                    <p class="text-sm text-zinc-400">{{ __('starter.your_estimate') }}</p>
                    <div class="mt-2 flex flex-wrap gap-6">
                        @if ($this->estimate['monthly'] > 0)
                            <div><span class="text-2xl font-bold">{{ $fmt($this->estimate['monthly']) }}</span> <span class="text-zinc-400">{{ __('starter.per_month') }}</span></div>
                        @endif
                        @if ($this->estimate['setup'] > 0)
                            <div><span class="text-2xl font-bold">{{ $fmt($this->estimate['setup']) }}</span> <span class="text-zinc-400">{{ __('starter.setup') }}</span></div>
                        @endif
                    </div>
                </div>
            @endif

            <div class="mt-6 flex items-center justify-between gap-3">
                <button type="button" wire:click="back" class="text-sm font-medium text-muted hover:text-ink">&larr; {{ __('quiz.back') }}</button>
                <div class="flex items-center gap-3">
                    <span x-show="$wire.selected.length === 0" class="hidden text-xs text-muted sm:inline">{{ __('starter.choose_hint') }}</span>
                    <button type="button" wire:click="next" :disabled="$wire.selected.length === 0" :class="$wire.selected.length === 0 ? 'opacity-50' : 'hover:bg-black'" class="rounded-lg bg-zinc-900 px-5 py-2.5 text-sm font-semibold text-white transition">{{ __('starter.next') }}</button>
                </div>
            </div>

        @elseif ($step === 3)
            <h3 class="text-xl font-bold text-ink sm:text-2xl">{{ __('starter.q_budget') }}</h3>
            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">
                @foreach (['under_500', '500_1500', '1500_3000', 'over_3000'] as $option)
                    <label wire:key="b-{{ $option }}"
                        class="cursor-pointer select-none rounded-xl border px-4 py-3 text-sm font-medium transition"
                        :class="$wire.budget === '{{ $option }}' ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-300 text-zinc-700 hover:border-zinc-400'">
                        <input type="radio" wire:model.live="budget" value="{{ $option }}" class="sr-only">
                        {{ __('starter.budgets.'.$option) }}
                    </label>
                @endforeach
            </div>

            <h3 class="mt-8 text-xl font-bold text-ink sm:text-2xl">{{ __('starter.q_timeline') }}</h3>
            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-3">
                @foreach (['asap', 'months', 'flexible'] as $option)
                    <label wire:key="t-{{ $option }}"
                        class="cursor-pointer select-none rounded-xl border px-4 py-3 text-center text-sm font-medium transition"
                        :class="$wire.timeline === '{{ $option }}' ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-300 text-zinc-700 hover:border-zinc-400'">
                        <input type="radio" wire:model.live="timeline" value="{{ $option }}" class="sr-only">
                        {{ __('starter.timelines.'.$option) }}
                    </label>
                @endforeach
            </div>

            <div class="mt-6 flex items-center justify-between gap-3">
                <button type="button" wire:click="back" class="text-sm font-medium text-muted hover:text-ink">&larr; {{ __('quiz.back') }}</button>
                <div class="flex items-center gap-3">
                    <span x-show="! $wire.budget || ! $wire.timeline" class="hidden text-xs text-muted sm:inline">{{ __('starter.choose_hint') }}</span>
                    <button type="button" wire:click="next" :disabled="! $wire.budget || ! $wire.timeline" :class="(! $wire.budget || ! $wire.timeline) ? 'opacity-50' : 'hover:bg-black'" class="rounded-lg bg-zinc-900 px-5 py-2.5 text-sm font-semibold text-white transition">{{ __('starter.next') }}</button>
                </div>
            </div>

        @else
            <h3 class="text-xl font-bold text-ink sm:text-2xl">{{ __('starter.contact_title') }}</h3>
            <p class="mt-2 text-sm text-muted">{{ __('starter.contact_text') }}</p>

            <form wire:submit="submit" class="mt-5 space-y-4" novalidate>
                <div class="hidden" aria-hidden="true">
                    <label>Website<input type="text" wire:model="website" tabindex="-1" autocomplete="off"></label>
                </div>

                @error('form')
                    <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ $message }}</div>
                @enderror

                <div>
                    <label for="ps-name" class="block text-sm font-medium text-ink">{{ __('contact.fields.name') }}</label>
                    <input type="text" id="ps-name" wire:model="name" autocomplete="name" maxlength="120" class="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-900 focus:ring-2 focus:ring-zinc-200 focus:outline-none">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="ps-email" class="block text-sm font-medium text-ink">{{ __('contact.fields.email') }}</label>
                        <input type="email" id="ps-email" wire:model="email" autocomplete="email" inputmode="email" maxlength="180" class="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-900 focus:ring-2 focus:ring-zinc-200 focus:outline-none">
                        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="ps-phone" class="block text-sm font-medium text-ink">{{ __('contact.fields.phone') }}</label>
                        <input type="tel" id="ps-phone" wire:model="phone" autocomplete="tel" inputmode="tel" maxlength="30" placeholder="{{ __('contact.placeholders.phone') }}" class="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-900 focus:ring-2 focus:ring-zinc-200 focus:outline-none">
                        @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div>
                    <label class="flex items-start gap-3 text-sm text-zinc-700">
                        <input type="checkbox" wire:model="consent" class="mt-0.5 h-4 w-4 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-500">
                        <span>{!! __('contact.consent_label', ['privacy' => '<a href="'.\App\Support\Localization::route('privacy').'" class="text-zinc-900 underline hover:text-black">'.__('contact.consent_link').'</a>']) !!}</span>
                    </label>
                    @error('consent') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between pt-2">
                    <button type="button" wire:click="back" class="text-sm font-medium text-muted hover:text-ink">&larr; {{ __('quiz.back') }}</button>
                    <button type="submit" wire:loading.attr="disabled" wire:target="submit" class="rounded-lg bg-orange px-6 py-3 text-base font-semibold text-white transition hover:bg-orange-deep disabled:opacity-60">
                        <span wire:loading.remove wire:target="submit">{{ __('starter.submit') }}</span>
                        <span wire:loading wire:target="submit">{{ __('contact.sending') }}</span>
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
