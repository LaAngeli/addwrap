<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Favicon & icoane --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo/addwrap-icon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/icons/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#18181b">

    {{-- Google Consent Mode v2 — implicit „denied" până la consimțământ.
         Trebuie să fie inline și să ruleze înaintea oricărui tag Google (GA / Ads / GTM). --}}
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('consent', 'default', {
            ad_storage: 'denied',
            ad_user_data: 'denied',
            ad_personalization: 'denied',
            analytics_storage: 'denied',
            functionality_storage: 'granted',
            security_storage: 'granted',
            wait_for_update: 500
        });
        (function () {
            try {
                var c = JSON.parse(localStorage.getItem('addwrap_consent') || 'null');
                if (c) {
                    gtag('consent', 'update', {
                        ad_storage: c.marketing ? 'granted' : 'denied',
                        ad_user_data: c.marketing ? 'granted' : 'denied',
                        ad_personalization: c.marketing ? 'granted' : 'denied',
                        analytics_storage: c.analytics ? 'granted' : 'denied'
                    });
                }
            } catch (e) {}
        })();
    </script>

    {{-- Meta SEO/AEO/GEO centralizat (title, description, canonical, hreflang,
         Open Graph, Twitter, JSON-LD) — gestionat de App\Support\Seo. --}}
    <x-seo />

    @fonts

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    @stack('head')
</head>
<body class="min-h-screen bg-white text-ink antialiased flex flex-col">

    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:rounded-lg focus:bg-brand-600 focus:px-4 focus:py-2 focus:text-white">
        {{ __('messages.common.skip_to_content') }}
    </a>

    @include('partials.header')

    <main id="main" class="flex-1">
        @yield('content')
    </main>

    @include('partials.footer')

    @include('partials.cookie-consent')

    @livewireScripts
    @stack('scripts')
</body>
</html>
