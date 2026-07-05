@props([
    'group' => 'terms', // terms | privacy | cookies
])

@php
    $sections = __('legal.'.$group.'.sections');

    // Datele firmei din config — completate o singură dată în config/site.php
    $legal = config('site.company.legal', []);
    $replace = [
        ':company_name' => $legal['name'] ?? config('site.company.name'),
        ':company_cui' => $legal['cui'] ?? '',
        ':company_reg' => $legal['reg_com'] ?? '',
        ':company_address' => $legal['address'] ?? '',
        ':company_email' => config('site.company.email'),
    ];
@endphp

<x-page-hero :title="__('legal.'.$group.'.title')" />

<section class="bg-paper py-16 lg:py-20">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <p class="text-sm text-muted">{{ __('legal.updated') }}: {{ date('d.m.Y') }}</p>

        <p class="mt-6 text-lg leading-relaxed text-zinc-700">{{ strtr(__('legal.'.$group.'.intro'), $replace) }}</p>

        @if (is_array($sections))
            {{-- Cuprins --}}
            <nav class="mt-10 rounded-2xl border border-zinc-200 bg-paper p-6">
                <p class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('legal.toc') }}</p>
                <ol class="mt-3 space-y-1.5 text-sm">
                    @foreach ($sections as $i => $section)
                        <li><a href="#sec-{{ $group }}-{{ $i }}" class="text-zinc-700 transition hover:text-ink hover:underline">{{ $section['heading'] }}</a></li>
                    @endforeach
                </ol>
            </nav>

            <div class="mt-10 space-y-10">
                @foreach ($sections as $i => $section)
                    <div id="sec-{{ $group }}-{{ $i }}" class="scroll-mt-28">
                        <h2 class="text-xl font-semibold text-ink">{{ $section['heading'] }}</h2>

                        @if (! empty($section['content']))
                            @foreach ($section['content'] as $block)
                                @if (! empty($block['ul']))
                                    <ul class="mt-4 space-y-2.5">
                                        @foreach ($block['ul'] as $li)
                                            <li class="flex items-start gap-3 leading-relaxed text-muted">
                                                <span class="mt-2 inline-block h-1.5 w-1.5 shrink-0 rounded-full bg-zinc-400"></span>
                                                <span>{{ strtr($li, $replace) }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="mt-4 leading-relaxed text-muted">{{ strtr($block['p'] ?? '', $replace) }}</p>
                                @endif
                            @endforeach
                        @else
                            <p class="mt-2 leading-relaxed text-muted">{{ strtr($section['text'] ?? '', $replace) }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
