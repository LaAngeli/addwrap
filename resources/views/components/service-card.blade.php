@props([
    'serviceKey' => '',
])

@php
    use App\Support\Localization;

    $icon = config('site.services.'.$serviceKey.'.icon', 'simple');
@endphp

<a
    href="{{ Localization::serviceUrl($serviceKey) }}"
    class="group flex flex-col rounded-2xl border border-zinc-200 bg-white p-6 transition hover:-translate-y-1 hover:border-zinc-900 hover:shadow-xl"
>
    <span class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-zinc-900 text-white transition group-hover:scale-105">
        <x-service-icon :name="$icon" class="h-6 w-6" />
    </span>
    <h3 class="text-lg font-semibold text-ink">{{ __('services.items.'.$serviceKey.'.name') }}</h3>
    <p class="mt-2 flex-1 text-sm leading-relaxed text-muted">{{ __('services.items.'.$serviceKey.'.excerpt') }}</p>
    <span class="mt-5 inline-flex items-center gap-1 text-sm font-medium text-ink">
        {{ __('messages.cta.learn_more') }}
        <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
    </span>
</a>
