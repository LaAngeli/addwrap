@props([
    'post' => [],
    'slug' => '',
])

@php
    use App\Support\BlogPosts;
    use App\Support\Localization;
    use Illuminate\Support\Carbon;

    $c = BlogPosts::content($post);
@endphp

<a href="{{ Localization::route('blog.show', ['slug' => $slug]) }}" class="group flex flex-col">
    <x-blog-cover :post="$post" class="transition group-hover:opacity-90" />

    <div class="mt-5 flex items-center gap-2 text-xs text-muted">
        <span class="font-semibold uppercase tracking-wider text-ink">{{ __('blog.categories.'.($post['category'] ?? 'general')) }}</span>
        <span aria-hidden="true">·</span>
        <time datetime="{{ $post['date'] ?? '' }}">{{ Carbon::parse($post['date'] ?? now())->locale(app()->getLocale())->isoFormat('D MMM YYYY') }}</time>
    </div>

    <h3 class="mt-2 text-xl font-bold tracking-tight text-ink transition group-hover:text-zinc-600">{{ $c['title'] ?? '' }}</h3>
    <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-muted">{{ $c['excerpt'] ?? '' }}</p>
    <span class="mt-4 inline-flex items-center gap-1 text-sm font-medium text-ink">
        {{ __('blog.read_more') }}
        <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
    </span>
</a>
