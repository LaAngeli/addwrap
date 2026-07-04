@props([
    'faq' => [],
    'title' => null,
])

@if (! empty($faq))
    <section class="border-t border-zinc-200 bg-white py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight text-ink sm:text-3xl">
                {{ $title ?? __('messages.nav.faq') }}
            </h2>

            <div class="mt-8 divide-y divide-zinc-200 border-t border-zinc-200" x-data="{ open: 0 }">
                @foreach ($faq as $i => $item)
                    <div class="py-2" wire:key="svc-faq-{{ $i }}">
                        <button
                            type="button"
                            @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                            class="flex w-full items-center justify-between gap-4 py-4 text-left"
                            :aria-expanded="open === {{ $i }}"
                        >
                            <span class="text-lg font-medium text-ink">{{ $item['q'] }}</span>
                            <svg class="h-5 w-5 shrink-0 text-zinc-900 transition" :class="open === {{ $i }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open === {{ $i }}" x-collapse x-cloak>
                            <p class="pb-4 leading-relaxed text-muted">{{ $item['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
