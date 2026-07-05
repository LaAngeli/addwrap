@php($gtmId = config('site.gtm.container_id'))
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Marchează sincron că JS e disponibil, ÎNAINTE de primul paint — folosit de
         CSS pentru starea inițială a elementelor [data-animate] (vezi app.css).
         Trebuie să ruleze blocant, aici, NU din bundle-ul @vite (acela e
         type="module" = deferred, deci ar rula după ce body-ul e deja pictat,
         provocând un flash vizibil: conținut vizibil → dispare brusc → animă
         înapoi cu GSAP). --}}
    <script>document.documentElement.classList.add('js');</script>

    {{-- Favicon & icoane --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo/addwrap-icon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/icons/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#18181b">

    @if ($gtmId)
        {{-- Hints de conexiune pentru GTM (TLS handshake în paralel cu restul HTML-ului).
             dns-prefetch pe potențialele destinații downstream (GA4, Google Ads, Meta Pixel)
             — doar DNS, ieftin, fără preconnect ca să nu deschidem conexiuni neutilizate. --}}
        <link rel="preconnect" href="https://www.googletagmanager.com" crossorigin>
        <link rel="dns-prefetch" href="//www.googletagmanager.com">
        <link rel="dns-prefetch" href="//www.google-analytics.com">
        <link rel="dns-prefetch" href="//connect.facebook.net">
    @endif

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

    @if ($gtmId)
        {{-- GTM container — rulează DUPĂ Consent Mode default, astfel încât
             orice tag din container respectă starea de consent de la prima lovire. --}}
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ $gtmId }}');
        </script>
    @endif

    {{-- Meta SEO/AEO/GEO centralizat (title, description, canonical, hreflang,
         Open Graph, Twitter, JSON-LD) — gestionat de App\Support\Seo. --}}
    <x-seo />

    @fonts

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    @stack('head')
</head>
<body class="min-h-screen bg-paper text-ink antialiased flex flex-col">

    @if ($gtmId)
        {{-- GTM noscript fallback — primul element din body. --}}
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtmId }}" height="0" width="0" style="display:none;visibility:hidden" title="Google Tag Manager"></iframe>
        </noscript>
    @endif

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
