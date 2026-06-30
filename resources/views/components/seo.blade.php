@php
    use App\Support\Localization;
    use App\Support\Seo;

    /** @var \App\Support\Seo $seo */
    $seo = app(Seo::class)->resolveFromRoute();

    $title = $seo->getTitle();
    $description = $seo->getDescription();
    $image = $seo->getImage();
    $type = $seo->getType();
    $locale = app()->getLocale();
    $ogLocale = config('site.og_locales.'.$locale, $locale);
    $twitterHandle = config('site.twitter_handle');
@endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">

@unless ($seo->isIndexable())
    <meta name="robots" content="noindex, nofollow">
@endunless

<link rel="canonical" href="{{ url()->current() }}">

{{-- Versiuni alternative de limbă (SEO multilingv) --}}
@foreach (Localization::all() as $alt)
    <link rel="alternate" hreflang="{{ $alt }}" href="{{ Localization::switchUrl($alt) }}">
@endforeach
<link rel="alternate" hreflang="x-default" href="{{ Localization::switchUrl(config('site.default_locale')) }}">

{{-- Open Graph --}}
<meta property="og:site_name" content="{{ config('site.company.name') }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:locale" content="{{ $ogLocale }}">
@foreach (Localization::all() as $alt)
    @if ($alt !== $locale)
        <meta property="og:locale:alternate" content="{{ config('site.og_locales.'.$alt, $alt) }}">
    @endif
@endforeach
@if ($image)
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:image:width" content="{{ config('site.og_image_width', 1200) }}">
    <meta property="og:image:height" content="{{ config('site.og_image_height', 630) }}">
    <meta property="og:image:alt" content="{{ $title }}">
@endif
@if ($type === 'article')
    @if ($seo->getPublishedTime())
        <meta property="article:published_time" content="{{ $seo->getPublishedTime() }}">
    @endif
    @if ($seo->getModifiedTime())
        <meta property="article:modified_time" content="{{ $seo->getModifiedTime() }}">
    @endif
    <meta property="article:publisher" content="{{ config('site.company.name') }}">
@endif

{{-- X (Twitter) Card --}}
<meta name="twitter:card" content="{{ $image ? 'summary_large_image' : 'summary' }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
@if ($twitterHandle)
    <meta name="twitter:site" content="{{ '@'.ltrim($twitterHandle, '@') }}">
    <meta name="twitter:creator" content="{{ '@'.ltrim($twitterHandle, '@') }}">
@endif
@if ($image)
    <meta name="twitter:image" content="{{ $image }}">
    <meta name="twitter:image:alt" content="{{ $title }}">
@endif

{{-- Date structurate JSON-LD (@graph) — fundație AEO/GEO --}}
<script type="application/ld+json">{!! json_encode($seo->jsonLd(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
