@props([
    'class' => '',
])

@php
    /** @var \App\Support\Seo $seo */
    $seo = app(\App\Support\Seo::class);
    $crumbs = $seo->getBreadcrumbs();
    $lastIndex = count($crumbs) - 1;
@endphp

@if ($lastIndex >= 0)
    <nav aria-label="{{ __('messages.common.breadcrumb') }}" class="text-sm text-muted {{ $class }}">
        <ol class="flex flex-wrap items-center gap-1.5">
            @foreach ($crumbs as $i => $crumb)
                <li class="flex items-center gap-1.5">
                    @if ($i < $lastIndex)
                        <a href="{{ $crumb['url'] }}" class="transition hover:text-ink hover:underline">{{ $crumb['name'] }}</a>
                        <svg class="h-3 w-3 shrink-0 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    @else
                        <span class="font-medium text-ink" aria-current="page">{{ $crumb['name'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
