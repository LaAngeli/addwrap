@props([
    'project' => [],
    'tall' => false,
])

@php
    use App\Support\Projects;

    $content = Projects::content($project);
    $icon = $project['icon'] ?? 'default';
    $tag = $content['tag'] ?? __('portfolio.categories.'.($project['category'] ?? 'general'));
    $keywords = $content['keywords'] ?? null;
@endphp

{{--
| Copertă „specimen de domeniu": fiecare client e reprezentat prin instrumentul
| propriu (grilă optometrică, traseu EEG, circuit, sigiliu de calitate etc.),
| desenat line-art alb + accent portocaliu. Logo-ul real apare în hero, deci aici
| folosim domeniul, nu marca.
--}}
<div {{ $attributes->merge(['class' => 'group/cover relative flex w-full flex-col overflow-hidden rounded-2xl bg-gradient-to-br from-zinc-900 to-zinc-800 '.($tall ? 'aspect-[16/10]' : 'aspect-[16/9]')]) }}>
    <div class="bg-dot-grid pointer-events-none absolute inset-0 text-white opacity-[0.06]"></div>
    <div class="pointer-events-none absolute -right-16 -top-20 h-52 w-52 rounded-full bg-orange/20 blur-3xl transition-opacity duration-500 group-hover/cover:opacity-80"></div>

    {{-- Antet: eticheta de nișă --}}
    <div class="relative flex items-center justify-between px-5 pt-4 sm:px-6">
        <span class="text-[11px] font-semibold uppercase tracking-[0.2em] text-white/70">{{ $tag }}</span>
        <span class="h-1.5 w-1.5 rounded-full bg-orange"></span>
    </div>

    {{-- Ilustrația domeniului --}}
    <div class="relative flex flex-1 items-center justify-center px-6 py-2">
        <svg class="h-full max-h-40 w-full text-white/70 transition-transform duration-700 group-hover/cover:scale-[1.04]" viewBox="0 0 300 170" fill="none" aria-hidden="true" preserveAspectRatio="xMidYMid meet">
            @switch($icon)
                @case('optics')
                    {{-- Grilă optometrică (Snellen) + linie de bază --}}
                    <text x="150" y="42" text-anchor="middle" font-family="ui-sans-serif, system-ui, sans-serif" font-size="34" font-weight="800" fill="currentColor">E</text>
                    <text x="150" y="74" text-anchor="middle" font-family="ui-sans-serif, system-ui, sans-serif" font-size="22" font-weight="700" letter-spacing="7" fill="currentColor">F P</text>
                    <text x="150" y="99" text-anchor="middle" font-family="ui-sans-serif, system-ui, sans-serif" font-size="15" font-weight="700" letter-spacing="5" fill="currentColor">T O Z</text>
                    <text x="150" y="118" text-anchor="middle" font-family="ui-sans-serif, system-ui, sans-serif" font-size="10" font-weight="700" letter-spacing="4" fill="#f26c00">L P E D</text>
                    <text x="150" y="132" text-anchor="middle" font-family="ui-sans-serif, system-ui, sans-serif" font-size="7" font-weight="700" letter-spacing="3" fill="currentColor" opacity="0.45">P E C F D</text>
                    <line x1="112" y1="150" x2="188" y2="150" stroke="currentColor" stroke-opacity="0.3" stroke-width="1.5" stroke-linecap="round" />
                    @break

                @case('neuro')
                    {{-- Trasee EEG (unul evidențiat) --}}
                    <path d="M26 44 h20 l6 -13 6 22 6 -18 5 9 h20 l6 -9 6 15 6 -11 5 5 h22 l6 -8 6 11 5 -7 h72" stroke="currentColor" stroke-opacity="0.45" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" />
                    <path d="M26 80 h16 l5 -17 6 28 6 -22 5 11 h16 l6 -13 6 20 5 -15 6 7 h18 l6 -9 6 13 5 -8 h74" stroke="#f26c00" stroke-width="2.6" stroke-linejoin="round" stroke-linecap="round" />
                    <path d="M26 116 h22 l6 -9 5 15 6 -11 6 5 h20 l5 -11 6 16 6 -13 5 7 h22 l6 -7 6 9 h60" stroke="currentColor" stroke-opacity="0.4" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" />
                    <path d="M26 148 h26 l6 -5 5 9 6 -7 6 3 h24 l6 -7 5 11 6 -7 h80" stroke="currentColor" stroke-opacity="0.28" stroke-width="1.8" stroke-linejoin="round" stroke-linecap="round" />
                    <circle cx="26" cy="44" r="3" fill="currentColor" opacity="0.6" /><circle cx="26" cy="80" r="3.4" fill="#f26c00" /><circle cx="26" cy="116" r="3" fill="currentColor" opacity="0.6" /><circle cx="26" cy="148" r="3" fill="currentColor" opacity="0.6" />
                    @break

                @case('finance')
                    {{-- Bare crescătoare + linie de trend --}}
                    <path d="M46 28 V142 H272" stroke="currentColor" stroke-opacity="0.3" stroke-width="1.5" stroke-linecap="round" />
                    <rect x="70" y="106" width="22" height="36" rx="2" fill="currentColor" fill-opacity="0.16" />
                    <rect x="108" y="90" width="22" height="52" rx="2" fill="currentColor" fill-opacity="0.2" />
                    <rect x="146" y="72" width="22" height="70" rx="2" fill="currentColor" fill-opacity="0.24" />
                    <rect x="184" y="56" width="22" height="86" rx="2" fill="currentColor" fill-opacity="0.28" />
                    <rect x="222" y="40" width="22" height="102" rx="2" fill="currentColor" fill-opacity="0.32" />
                    <path d="M81 110 L119 92 L157 74 L195 58 L233 42" stroke="#f26c00" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="233" cy="42" r="4.5" fill="#f26c00" />
                    @break

                @case('retail')
                    {{-- Sacoșă de retail + etichetă de preț --}}
                    <path d="M96 66 h108 l-9 78 a7 7 0 0 1 -7 6 H112 a7 7 0 0 1 -7 -6 z" stroke="currentColor" stroke-opacity="0.55" stroke-width="2" stroke-linejoin="round" fill="currentColor" fill-opacity="0.05" />
                    <path d="M126 66 v-7 a24 24 0 0 1 48 0 v7" stroke="currentColor" stroke-opacity="0.55" stroke-width="2" fill="none" stroke-linecap="round" />
                    <line x1="99" y1="94" x2="201" y2="94" stroke="#f26c00" stroke-width="3" />
                    <g transform="rotate(14 220 58)">
                        <rect x="204" y="46" width="34" height="22" rx="3" stroke="#f26c00" stroke-width="2" fill="none" />
                        <circle cx="211" cy="54" r="2.6" fill="#f26c00" />
                    </g>
                    @break

                @case('electric')
                    {{-- Schemă de circuit + fulger --}}
                    <path d="M34 62 H84" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" />
                    <path d="M84 62 l7 -9 9 18 9 -18 9 18 7 -9 H144" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" stroke-linejoin="round" />
                    <path d="M144 62 H182 V104" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" />
                    <circle cx="182" cy="120" r="16" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" fill="none" />
                    <path d="M175 127 l14 -16 M182 128 v-16" stroke="currentColor" stroke-opacity="0.4" stroke-width="1.6" stroke-linecap="round" />
                    <path d="M182 136 V150 H60 V62" stroke="currentColor" stroke-opacity="0.32" stroke-width="2" stroke-linecap="round" />
                    <circle cx="34" cy="62" r="3.5" fill="currentColor" opacity="0.6" /><circle cx="182" cy="62" r="3.5" fill="currentColor" opacity="0.6" />
                    <path d="M244 36 l-18 34 h13 l-7 38 22 -46 h-13 l11 -26 z" fill="#f26c00" />
                    @break

                @case('quality')
                    {{-- Sigiliu de certificare + bifă + mini control-chart --}}
                    <circle cx="112" cy="88" r="44" stroke="currentColor" stroke-opacity="0.4" stroke-width="4" stroke-dasharray="2 7" fill="none" />
                    <circle cx="112" cy="88" r="34" stroke="currentColor" stroke-opacity="0.35" stroke-width="1.6" fill="none" />
                    <path d="M96 88 l11 12 22 -26" stroke="#f26c00" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M98 128 l-8 26 22 -12 22 12 -8 -26" stroke="currentColor" stroke-opacity="0.35" stroke-width="2" fill="none" stroke-linejoin="round" />
                    <path d="M178 66 H272 M178 108 H272" stroke="currentColor" stroke-opacity="0.2" stroke-width="1.2" stroke-dasharray="3 4" />
                    <path d="M178 90 l18 -9 19 13 18 -15 19 9 18 -6" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    @break

                @case('integration')
                    {{-- Rețea de module cu hub central --}}
                    <path d="M74 58 L150 90 M226 58 L150 90 M74 128 L150 90 M226 128 L150 90" stroke="currentColor" stroke-opacity="0.3" stroke-width="1.5" />
                    <rect x="48" y="44" width="52" height="28" rx="5" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" fill="currentColor" fill-opacity="0.05" />
                    <rect x="200" y="44" width="52" height="28" rx="5" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" fill="currentColor" fill-opacity="0.05" />
                    <rect x="48" y="114" width="52" height="28" rx="5" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" fill="currentColor" fill-opacity="0.05" />
                    <rect x="200" y="114" width="52" height="28" rx="5" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" fill="currentColor" fill-opacity="0.05" />
                    <circle cx="150" cy="90" r="17" fill="#f26c00" />
                    <path d="M143 90 h14 M150 83 v14" stroke="#fff" stroke-width="2.2" stroke-linecap="round" />
                    @break

                @case('education')
                    {{-- Carte deschisă + mugur în creștere --}}
                    <path d="M62 132 C92 120 132 120 150 130 C168 120 208 120 238 132 L238 140 C208 128 168 128 150 138 C132 128 92 128 62 140 Z" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" fill="currentColor" fill-opacity="0.05" stroke-linejoin="round" />
                    <path d="M150 130 V138" stroke="currentColor" stroke-opacity="0.4" stroke-width="1.5" />
                    <path d="M150 130 C150 104 150 82 150 60" stroke="currentColor" stroke-opacity="0.55" stroke-width="2.5" stroke-linecap="round" />
                    <path d="M150 98 C131 94 118 79 120 62 C139 64 152 79 150 98 Z" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" fill="currentColor" fill-opacity="0.05" stroke-linejoin="round" />
                    <path d="M150 84 C169 80 183 65 181 48 C162 50 148 65 150 84 Z" stroke="#f26c00" stroke-width="2.4" fill="#f26c00" fill-opacity="0.12" stroke-linejoin="round" />
                    <circle cx="150" cy="58" r="4" fill="#f26c00" />
                    @break

                @default
                    <rect x="90" y="52" width="120" height="70" rx="6" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" fill="none" />
                    <path d="M120 52 v-6 a12 12 0 0 1 24 0 v6" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" fill="none" />
                    <line x1="90" y1="86" x2="210" y2="86" stroke="#f26c00" stroke-width="3" />
            @endswitch
        </svg>
    </div>

    {{-- Subsol: nume client + cuvinte-cheie de domeniu --}}
    <div class="relative px-5 pb-5 sm:px-6">
        <p class="text-xl font-black tracking-tight text-white sm:text-2xl">{{ $project['client'] ?? '' }}</p>
        @if ($keywords)
            <p class="mt-1 text-[11px] font-medium uppercase tracking-wider text-white/45">{{ $keywords }}</p>
        @endif
    </div>
</div>
