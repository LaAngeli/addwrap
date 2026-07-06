@props(['current' => ''])

@php
    use App\Support\Localization;

    $combos = __('service_combos.'.$current);
    $combos = is_array($combos) ? $combos : [];
    $currentIcon = config('site.services.'.$current.'.icon', 'simple');
@endphp

@if (! empty($combos))
    <section class="border-t border-zinc-200 bg-paper py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-animate="fade-up" class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('services.show.combine_eyebrow') }}</p>
                <h2 data-animate="fade-up" class="mt-3 text-3xl font-bold tracking-tight text-ink sm:text-4xl text-balance">{{ __('services.show.combine_title') }}</h2>
                <p data-animate="fade-up" class="mt-4 text-lg text-muted">{{ __('services.show.combine_subtitle') }}</p>
            </div>

            <div data-animate-group class="mt-8 grid grid-cols-3 gap-2 sm:mt-12 sm:gap-4 lg:gap-6">
                @foreach ($combos as $combo)
                    @php $otherIcon = config('site.services.'.$combo['key'].'.icon', 'simple'); @endphp
                    <a
                        href="{{ Localization::serviceUrl($combo['key']) }}"
                        class="group flex flex-col items-center rounded-2xl border border-zinc-200 bg-white p-3 text-center transition hover:-translate-y-1 card-hover-neon sm:items-start sm:rounded-3xl sm:p-6 sm:text-left"
                    >
                        {{-- Mobil: o singură pictogramă compactă (serviciul complementar) --}}
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-teal text-white transition group-hover:scale-105 sm:hidden">
                            <x-service-icon :name="$otherIcon" class="h-5 w-5" />
                        </span>

                        {{-- sm+: perechea serviciu curent → complementar --}}
                        <div class="hidden items-center gap-2 sm:flex">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-zinc-200 bg-zinc-50 text-zinc-500">
                                <x-service-icon :name="$currentIcon" class="h-5 w-5" />
                            </span>
                            <svg class="h-4 w-4 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14" /></svg>
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-teal text-white transition group-hover:scale-105">
                                <x-service-icon :name="$otherIcon" class="h-5 w-5" />
                            </span>
                        </div>

                        <h3 class="mt-2 text-xs font-semibold leading-tight text-ink sm:mt-5 sm:text-lg sm:leading-normal">{{ __('services.items.'.$combo['key'].'.name') }}</h3>
                        <p class="mt-2 hidden flex-1 text-sm leading-relaxed text-muted sm:block">{{ $combo['reason'] }}</p>

                        <span class="mt-5 hidden items-center gap-1 text-sm font-semibold text-ink sm:inline-flex">
                            {{ __('messages.cta.learn_more') }}
                            <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                        </span>
                    </a>
                @endforeach
            </div>

            <div data-animate="fade-up" class="mt-10 text-center">
                <a href="{{ Localization::route('services.index') }}" class="inline-flex items-center gap-1 text-base font-semibold text-ink hover:underline">
                    {{ __('messages.cta.all_services') }}
                    <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </section>
@endif
