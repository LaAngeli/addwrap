@props([
    'project' => [],
    'slug' => '',
])

@php
    use App\Support\Projects;
    use App\Support\Localization;

    $c = Projects::content($project);
    $metric = $c['metrics'][0] ?? null;
@endphp

<a href="{{ Localization::route('portfolio.show', ['slug' => $slug]) }}" class="group flex flex-col">
    <x-project-cover :project="$project" class="transition group-hover:opacity-95" />

    <div class="mt-5 flex flex-wrap items-center gap-2 text-xs text-muted">
        <span class="font-semibold uppercase tracking-wider text-ink">{{ __('portfolio.categories.'.($project['category'] ?? 'general')) }}</span>
        <span aria-hidden="true">·</span>
        <span>{{ $project['client'] ?? '' }}</span>
        <span aria-hidden="true">·</span>
        <span>{{ $project['year'] ?? '' }}</span>
    </div>

    <h3 class="mt-2 text-xl font-bold tracking-tight text-ink transition group-hover:text-zinc-600">{{ $c['title'] ?? '' }}</h3>

    @if ($metric)
        <div class="mt-4 flex items-baseline gap-2">
            <span class="text-2xl font-bold tracking-tight text-ink">{{ $metric['value'] }}</span>
            <span class="text-sm text-muted">{{ $metric['label'] }}</span>
        </div>
    @endif

    <span class="mt-4 inline-flex items-center gap-1 text-sm font-medium text-ink">
        {{ __('portfolio.view_case') }}
        <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
    </span>
</a>
