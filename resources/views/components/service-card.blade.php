@props([
    'serviceKey' => '',
])

@php
    use App\Support\Localization;

    $icon = config('site.services.'.$serviceKey.'.icon', 'simple');
@endphp

<a
    href="{{ Localization::serviceUrl($serviceKey) }}"
    class="group flex flex-col rounded-2xl border border-zinc-200 bg-white p-5 transition hover:-translate-y-1 card-hover-neon sm:p-6"
>
    <span class="mb-4 inline-flex h-11 w-11 items-center justify-center rounded-xl bg-zinc-900 text-white transition group-hover:scale-105 sm:mb-5 sm:h-12 sm:w-12">
        <x-service-icon :name="$icon" class="h-5 w-5 sm:h-6 sm:w-6" />
    </span>
    <h3 class="text-base font-semibold text-ink sm:text-lg">{{ __('services.items.'.$serviceKey.'.name') }}</h3>
    <p class="mt-2 line-clamp-3 flex-1 text-sm leading-relaxed text-muted sm:line-clamp-none">{{ __('services.items.'.$serviceKey.'.excerpt') }}</p>
    <span class="mt-4 inline-flex items-center gap-1 text-sm font-medium text-ink sm:mt-5">
        {{ __('messages.cta.learn_more') }}
        <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
    </span>
</a>
