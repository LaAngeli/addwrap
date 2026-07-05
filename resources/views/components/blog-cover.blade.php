@props([
    'post' => [],
    'tall' => false,
])

@php
    use App\Support\BlogPosts;

    $c = BlogPosts::content($post);
    $cat = $post['category'] ?? 'general';
    $slug = $post['slug'] ?? null;
    $img = $slug ? 'images/blog/'.$slug.'.jpg' : null;
    $hasImg = $img && file_exists(public_path($img));

    // Fallback dacă nu există imagine: gradient monocrom + monogramă
    $gradients = [
        'seo' => 'from-teal-ink to-teal-deep',
        'ads' => 'from-zinc-800 to-teal-deep',
        'content' => 'from-zinc-700 to-teal-ink',
        'branding' => 'from-teal-ink to-teal-deep',
        'web' => 'from-zinc-800 to-[#04181c]',
        'strategy' => 'from-zinc-600 to-teal-deep',
    ];
    $grad = $gradients[$cat] ?? 'from-teal-ink to-teal-deep';
    $mono = mb_strtoupper(mb_substr($c['title'] ?? 'A', 0, 1));
@endphp

<div {{ $attributes->merge(['class' => 'relative w-full overflow-hidden rounded-2xl bg-zinc-900 '.($tall ? 'aspect-[16/10]' : 'aspect-[16/9]')]) }}>
    @if ($hasImg)
        <img src="{{ asset($img) }}" alt="{{ $c['title'] ?? '' }}" loading="lazy" decoding="async" class="h-full w-full object-cover" />
    @else
        <div class="absolute inset-0 bg-gradient-to-br {{ $grad }}">
            <div class="bg-dot-grid absolute inset-0 text-white opacity-10"></div>
            <span class="absolute inset-0 flex items-center justify-center text-7xl font-black text-white/15 sm:text-8xl">{{ $mono }}</span>
        </div>
    @endif
    <span class="absolute left-4 top-4 rounded-full bg-zinc-900/40 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-white backdrop-blur">{{ __('blog.categories.'.$cat) }}</span>
</div>
