@props([
    'project' => [],
    'tall' => false,
])

@php
    use App\Support\Projects;

    $cat = $project['category'] ?? 'general';

    $gradients = [
        'seo' => 'from-zinc-900 to-zinc-700',
        'ads' => 'from-zinc-800 to-zinc-600',
        'content' => 'from-zinc-700 to-zinc-900',
        'branding' => 'from-zinc-900 to-zinc-600',
        'web' => 'from-zinc-800 to-zinc-950',
        'strategy' => 'from-zinc-600 to-zinc-800',
    ];
    $grad = $gradients[$cat] ?? 'from-zinc-900 to-zinc-700';
@endphp

<div {{ $attributes->merge(['class' => 'relative flex w-full items-center justify-center overflow-hidden rounded-2xl bg-gradient-to-br '.$grad.' '.($tall ? 'aspect-[16/10]' : 'aspect-[16/9]')]) }}>
    <div class="bg-dot-grid absolute inset-0 text-white opacity-10"></div>
    <span class="absolute left-4 top-4 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-white backdrop-blur">{{ __('portfolio.categories.'.$cat) }}</span>
    <span class="px-6 text-center text-3xl font-black tracking-tight text-white/85 sm:text-4xl">{{ $project['client'] ?? '' }}</span>
</div>
