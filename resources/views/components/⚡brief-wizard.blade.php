<?php

use App\Support\Localization;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public int $step = 1;

    public string $goal = '';

    public string $stage = '';

    private const RECOMMENDATIONS = [
        'brand' => ['brandbook', 'content-strategy'],
        'sales' => ['google-ads', 'meta-ads'],
        'visibility' => ['seo-aeo-geo', 'content-strategy'],
        'website' => ['web-development', 'brandbook'],
    ];

    public function selectGoal(string $goal): void
    {
        $this->goal = $goal;
        $this->step = 2;
    }

    public function selectStage(string $stage): void
    {
        $this->stage = $stage;
        $this->step = 3;
    }

    public function back(): void
    {
        $this->step = max(1, $this->step - 1);
    }

    public function restart(): void
    {
        $this->reset(['goal', 'stage']);
        $this->step = 1;
    }

    /**
     * @return array<int, string>
     */
    #[Computed]
    public function recommended(): array
    {
        $services = self::RECOMMENDATIONS[$this->goal] ?? [];

        if ($this->stage === 'idea' && ! in_array('web-development', $services, true)) {
            $services[] = 'web-development';
        }

        return array_slice(array_unique($services), 0, 3);
    }
};
?>

<div class="overflow-hidden rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm sm:p-8">
    <div class="flex items-center justify-between">
        <p class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('quiz.eyebrow') }}</p>
        <p class="text-sm text-muted">{{ __('quiz.step', ['current' => min($step, 3), 'total' => 3]) }}</p>
    </div>

    {{-- Bara de progres --}}
    <div class="mt-3 h-1.5 w-full overflow-hidden rounded-full bg-zinc-100">
        <div class="h-full rounded-full bg-deep transition-all" style="width: {{ (min($step, 3) / 3) * 100 }}%"></div>
    </div>

    <div class="mt-6" wire:key="quiz-step-{{ $step }}">
        @if ($step === 1)
            <h3 class="text-xl font-bold text-ink">{{ __('quiz.q_goal') }}</h3>
            <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">
                @foreach (['brand', 'sales', 'visibility', 'website'] as $option)
                    <button
                        type="button"
                        wire:key="goal-{{ $option }}"
                        wire:click="selectGoal('{{ $option }}')"
                        class="rounded-xl border border-zinc-300 px-4 py-4 text-left text-sm font-medium text-zinc-800 transition hover:border-zinc-900 hover:bg-zinc-50"
                    >
                        {{ __('quiz.goals.'.$option) }}
                    </button>
                @endforeach
            </div>

        @elseif ($step === 2)
            <h3 class="text-xl font-bold text-ink">{{ __('quiz.q_stage') }}</h3>
            <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-3">
                @foreach (['idea', 'growing', 'established'] as $option)
                    <button
                        type="button"
                        wire:key="stage-{{ $option }}"
                        wire:click="selectStage('{{ $option }}')"
                        class="rounded-xl border border-zinc-300 px-4 py-4 text-center text-sm font-medium text-zinc-800 transition hover:border-zinc-900 hover:bg-zinc-50"
                    >
                        {{ __('quiz.stages.'.$option) }}
                    </button>
                @endforeach
            </div>
            <button type="button" wire:click="back" class="mt-5 text-sm font-medium text-muted hover:text-ink">&larr; {{ __('quiz.back') }}</button>

        @else
            <h3 class="text-xl font-bold text-ink">{{ __('quiz.result_title') }}</h3>
            <p class="mt-2 text-sm text-muted">{{ __('quiz.result_text') }}</p>

            <div class="mt-5 space-y-3">
                @foreach ($this->recommended() as $key)
                    <a
                        href="{{ \App\Support\Localization::serviceUrl($key) }}"
                        wire:key="rec-{{ $key }}"
                        class="flex items-center justify-between rounded-xl border border-zinc-200 px-4 py-3 transition hover:border-zinc-900 hover:bg-zinc-50"
                    >
                        <span class="font-medium text-ink">{{ __('services.items.'.$key.'.name') }}</span>
                        <span class="text-zinc-400">&rarr;</span>
                    </a>
                @endforeach
            </div>

            <div class="mt-6 flex flex-wrap items-center gap-3">
                <a href="{{ \App\Support\Localization::route('contact') }}" class="rounded-lg bg-orange px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-orange-deep">{{ __('quiz.cta') }}</a>
                <button type="button" wire:click="restart" class="text-sm font-medium text-muted hover:text-ink">{{ __('quiz.restart') }}</button>
            </div>
        @endif
    </div>
</div>
