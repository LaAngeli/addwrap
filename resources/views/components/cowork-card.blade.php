@props(['data' => []])

@php
    $type = $data['type'] ?? 'simple';
    $dark = $data['dark'] ?? false;
@endphp

<div
    @class([
        'rounded-2xl border p-5 w-full',
        'bg-white shadow-md border-zinc-100' => ! $dark,
        'bg-teal border-zinc-800 text-white' => $dark,
    ])
    style="min-height: 160px;"
>
    @if ($type === 'pricing')
        <div class="mb-3 flex items-center gap-2">
            <div class="h-2 w-2 rounded-full {{ $dark ? 'bg-zinc-300' : 'bg-zinc-900' }}"></div>
            <div class="h-2 w-24 rounded {{ $dark ? 'bg-zinc-700' : 'bg-zinc-200' }}"></div>
        </div>
        <div class="mb-2 text-3xl font-bold {{ $dark ? 'text-white' : 'text-zinc-900' }}">2.490 €</div>
        <div class="mb-4 space-y-1.5">
            <div class="h-2 w-full rounded {{ $dark ? 'bg-zinc-700' : 'bg-zinc-200' }}"></div>
            <div class="h-2 w-4/5 rounded {{ $dark ? 'bg-zinc-700' : 'bg-zinc-200' }}"></div>
            <div class="h-2 w-3/4 rounded {{ $dark ? 'bg-zinc-700' : 'bg-zinc-200' }}"></div>
        </div>
        <div class="h-8 w-full rounded-lg {{ $dark ? 'bg-white' : 'bg-zinc-900' }}"></div>

    @elseif ($type === 'hero')
        <div class="mb-3 h-3 w-3/4 rounded {{ $dark ? 'bg-white' : 'bg-zinc-800' }}"></div>
        <div class="mb-4 h-3 w-1/2 rounded {{ $dark ? 'bg-zinc-500' : 'bg-zinc-800' }}"></div>
        <div class="mb-4 space-y-2">
            <div class="h-2 w-full rounded {{ $dark ? 'bg-zinc-700' : 'bg-zinc-200' }}"></div>
            <div class="h-2 w-5/6 rounded {{ $dark ? 'bg-zinc-700' : 'bg-zinc-200' }}"></div>
            <div class="h-2 w-4/5 rounded {{ $dark ? 'bg-zinc-700' : 'bg-zinc-200' }}"></div>
        </div>
        <div class="h-8 w-28 rounded-lg bg-zinc-900 {{ $dark ? 'bg-white' : '' }}"></div>

    @elseif ($type === 'dashboard')
        <div class="mb-4 flex items-center gap-2">
            <div class="h-2 w-2 rounded-full bg-zinc-400"></div>
            <div class="h-2 w-20 rounded bg-zinc-200"></div>
        </div>
        <div class="mb-3 grid grid-cols-3 gap-2">
            <div class="h-12 rounded-lg border border-zinc-100 bg-zinc-50"></div>
            <div class="h-12 rounded-lg border border-zinc-200 bg-zinc-100"></div>
            <div class="h-12 rounded-lg border border-zinc-100 bg-zinc-50"></div>
        </div>
        <div class="space-y-1.5">
            <div class="h-2 w-full rounded bg-zinc-200"></div>
            <div class="h-2 w-4/5 rounded bg-zinc-200"></div>
        </div>

    @elseif ($type === 'data')
        <div class="mb-2 text-sm font-semibold text-zinc-300">Date care îți cresc</div>
        <div class="mb-4 text-xl font-bold text-white">afacerea online</div>
        <div class="space-y-2">
            <div class="h-2 w-full rounded bg-zinc-700"></div>
            <div class="h-2 w-4/5 rounded bg-zinc-700"></div>
            <div class="h-2 w-3/4 rounded bg-zinc-700"></div>
        </div>
        <div class="mt-4 h-7 w-24 rounded bg-white"></div>

    @elseif ($type === 'mission')
        <div class="mb-1 text-xs text-zinc-400">Strategie, creație</div>
        <div class="mb-4 text-lg font-bold text-white">și performanță</div>
        <div class="space-y-2">
            <div class="h-2 w-full rounded bg-zinc-700"></div>
            <div class="h-2 w-5/6 rounded bg-zinc-700"></div>
            <div class="h-2 w-3/4 rounded bg-zinc-700"></div>
            <div class="h-2 w-full rounded bg-zinc-700"></div>
        </div>

    @elseif ($type === 'testimonial')
        <div class="mb-3 flex gap-1">
            @for ($i = 0; $i < 5; $i++)
                <div class="h-3 w-3 rounded-sm bg-zinc-900"></div>
            @endfor
        </div>
        <div class="mb-3 space-y-1.5">
            <div class="h-2 w-full rounded bg-zinc-300"></div>
            <div class="h-2 w-5/6 rounded bg-zinc-300"></div>
            <div class="h-2 w-4/5 rounded bg-zinc-300"></div>
        </div>
        <div class="mt-4 flex items-center gap-2">
            <div class="h-8 w-8 rounded-full bg-zinc-200"></div>
            <div>
                <div class="h-2 w-20 rounded bg-zinc-400"></div>
                <div class="mt-1 h-1.5 w-14 rounded bg-zinc-200"></div>
            </div>
        </div>

    @elseif ($type === 'thumbnail')
        <div class="mb-3 h-24 overflow-hidden rounded-xl bg-gradient-to-br from-zinc-200 to-zinc-300">
            <div class="h-full w-full bg-gradient-to-br from-white/40 to-transparent"></div>
        </div>
        <div class="mb-2 h-2 w-3/4 rounded bg-zinc-800"></div>
        <div class="h-2 w-full rounded bg-zinc-200"></div>

    @elseif ($type === 'badge')
        <div class="mb-3 flex items-center gap-2">
            <div class="h-5 w-16 rounded-full border border-zinc-200 bg-zinc-100"></div>
            <div class="h-5 w-14 rounded-full border border-zinc-200 bg-zinc-100"></div>
        </div>
        <div class="mb-3 h-3 w-2/3 rounded bg-zinc-800"></div>
        <div class="space-y-1.5">
            <div class="h-2 w-full rounded bg-zinc-200"></div>
            <div class="h-2 w-4/5 rounded bg-zinc-200"></div>
        </div>
        <div class="mt-3 h-8 w-24 rounded-lg bg-zinc-900"></div>

    @elseif ($type === 'form')
        <div class="mb-4 h-2 w-1/2 rounded bg-zinc-800"></div>
        <div class="space-y-3">
            <div class="h-8 w-full rounded-lg border border-zinc-200 bg-zinc-50"></div>
            <div class="h-8 w-full rounded-lg border border-zinc-200 bg-zinc-50"></div>
            <div class="h-16 w-full rounded-lg border border-zinc-200 bg-zinc-50"></div>
        </div>
        <div class="mt-3 h-8 w-full rounded-lg bg-zinc-900"></div>

    @elseif ($type === 'feature')
        <div class="mb-3 inline-flex h-9 w-9 items-center justify-center rounded-xl {{ $dark ? 'bg-zinc-800' : 'bg-zinc-100' }}">
            <div class="h-4 w-4 rounded {{ $dark ? 'bg-white' : 'bg-zinc-900' }}"></div>
        </div>
        <div class="mb-2 h-3 w-2/3 rounded {{ $dark ? 'bg-white' : 'bg-zinc-800' }}"></div>
        <div class="space-y-1.5">
            <div class="h-2 w-full rounded {{ $dark ? 'bg-zinc-700' : 'bg-zinc-200' }}"></div>
            <div class="h-2 w-5/6 rounded {{ $dark ? 'bg-zinc-700' : 'bg-zinc-200' }}"></div>
        </div>

    @else
        {{-- simple --}}
        <div class="mb-3 flex items-center gap-2">
            <div class="h-2 w-2 rounded-full bg-zinc-400"></div>
            <div class="h-2 w-20 rounded bg-zinc-200"></div>
        </div>
        <div class="space-y-2">
            <div class="h-3 w-3/4 rounded bg-zinc-700"></div>
            <div class="h-2 w-full rounded bg-zinc-200"></div>
            <div class="h-2 w-5/6 rounded bg-zinc-200"></div>
            <div class="h-2 w-4/5 rounded bg-zinc-200"></div>
        </div>
    @endif
</div>
