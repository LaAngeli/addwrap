<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Limbi disponibile
    |--------------------------------------------------------------------------
    | RO este limba principală (servită pe rădăcină, fără prefix).
    | EN este versiunea secundară (servită sub prefixul /en).
    */

    'locales' => ['ro', 'en'],

    'default_locale' => 'ro',

    /*
    |--------------------------------------------------------------------------
    | SEO / social
    |--------------------------------------------------------------------------
    | Asset-uri sociale (căi relative la public/). og_image = imaginea Open Graph
    | implicită (1200x630). logo = imaginea folosită în datele structurate
    | (Organization.logo, raster, min 112x112). Fișierele sunt generate în
    | public/images/og/ și public/images/logo/.
    */

    'og_image' => 'images/og/addwrap-default.jpg',
    'og_image_width' => 1200,
    'og_image_height' => 630,

    'logo' => 'images/logo/addwrap-mark.png',

    'og_locales' => [
        'ro' => 'ro_RO',
        'en' => 'en_US',
    ],

    // Handle X/Twitter fără @ (lasă null dacă nu există cont).
    'twitter_handle' => null,

    /*
    |--------------------------------------------------------------------------
    | Slug-uri rute traduse
    |--------------------------------------------------------------------------
    | Definite în config (nu în lang) pentru a fi disponibile la momentul
    | înregistrării rutelor, fără dependență de translator în timpul boot-ului.
    */

    'routes' => [
        'ro' => [
            'services' => 'servicii',
            'about' => 'despre',
            'portfolio' => 'portofoliu',
            'blog' => 'blog',
            'faq' => 'intrebari-frecvente',
            'pricing' => 'preturi',
            'contact' => 'contact',
            'thank_you' => 'multumim',
            'terms' => 'termeni-si-conditii',
            'privacy' => 'politica-de-confidentialitate',
            'cookies' => 'politica-de-cookies',
        ],
        'en' => [
            'services' => 'services',
            'about' => 'about',
            'portfolio' => 'portfolio',
            'blog' => 'blog',
            'faq' => 'faq',
            'pricing' => 'pricing',
            'contact' => 'contact',
            'thank_you' => 'thank-you',
            'terms' => 'terms-and-conditions',
            'privacy' => 'privacy-policy',
            'cookies' => 'cookie-policy',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Servicii oferite
    |--------------------------------------------------------------------------
    | Cheia internă este stabilă; slug-ul poate diferi per limbă.
    | Textele (nume, tagline, descriere) vin din lang/{locale}/services.php
    | folosind aceeași cheie internă.
    */

    'services' => [
        'brandbook' => [
            'slug' => ['ro' => 'brandbook', 'en' => 'brandbook'],
            'icon' => 'palette',
        ],
        'content-strategy' => [
            'slug' => ['ro' => 'strategie-de-content', 'en' => 'content-strategy'],
            'icon' => 'document-text',
        ],
        'google-ads' => [
            'slug' => ['ro' => 'google-ads', 'en' => 'google-ads'],
            'icon' => 'magnifying-glass',
        ],
        'meta-ads' => [
            'slug' => ['ro' => 'meta-ads', 'en' => 'meta-ads'],
            'icon' => 'megaphone',
        ],
        'seo-aeo-geo' => [
            'slug' => ['ro' => 'seo-aeo-geo', 'en' => 'seo-aeo-geo'],
            'icon' => 'chart-bar',
        ],
        'web-development' => [
            'slug' => ['ro' => 'web-development', 'en' => 'web-development'],
            'icon' => 'code-bracket',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Prețuri orientative pentru calculatorul de buget
    |--------------------------------------------------------------------------
    | Valori placeholder în lei, de calibrat. monthly = fee lunar de management,
    | setup = cost unic. Multiplicatorul de amploare ajustează estimarea.
    */

    'pricing' => [
        'scope_multiplier' => [
            'small' => 0.8,
            'medium' => 1.0,
            'large' => 1.4,
        ],
        // Valori orientative în EUR (fără TVA), aliniate la lista de prețuri.
        'services' => [
            'brandbook' => ['monthly' => 0, 'setup' => 3000],
            'content-strategy' => ['monthly' => 250, 'setup' => 0],
            'google-ads' => ['monthly' => 400, 'setup' => 150],
            'meta-ads' => ['monthly' => 400, 'setup' => 0],
            'seo-aeo-geo' => ['monthly' => 300, 'setup' => 0],
            'web-development' => ['monthly' => 100, 'setup' => 400],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Date de contact / firmă (placeholder, de completat ulterior)
    |--------------------------------------------------------------------------
    */

    'company' => [
        'name' => 'AddWrap',
        'email' => env('CONTACT_EMAIL', 'hello@addwrap.ro'),
        'phone' => '+40 741 069 314',
        // Număr WhatsApp în format internațional, fără + și fără spații (pentru wa.me).
        'whatsapp' => '40741069314',

        // Date legale ale firmei — completează-le o singură dată aici;
        // apar automat pe toate paginile legale (Termeni, Confidențialitate, Cookies).
        'legal' => [
            'name' => 'AddWrap S.R.L.',
            'cui' => 'RO________',
            'reg_com' => 'J__/____/____',
            'address' => '[sediul social — de completat]',
        ],

        'social' => [
            'facebook' => 'https://www.facebook.com/addwrapcreative',
            'instagram' => 'https://www.instagram.com/add.wrap/',
            'whatsapp' => 'https://wa.me/40741069314',
        ],
        'anpc_sal' => 'https://anpc.ro/ce-este-sal/',
        'anpc_sol' => 'https://ec.europa.eu/consumers/odr',
    ],

];
