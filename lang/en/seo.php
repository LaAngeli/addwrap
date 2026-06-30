<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Meta SEO (EN)
|--------------------------------------------------------------------------
| Title: "{Page title} | AddWrap" — the brand is appended automatically
| (App\Support\Seo), so titles HERE are WITHOUT the brand. Title ≤ ~48 chars,
| keyword-first.
|
| Description — fixed structure: [benefit/keyword-first] + [what we do] + [CTA].
| Length ≤ ~155 chars, with the keyword in the first words.
*/

return [

    'default' => [
        'title' => 'Digital marketing agency',
        'description' => 'Digital marketing agency: brandbook, content, Google & Meta Ads, SEO/AEO/GEO and web development. We grow businesses with measurable results.',
    ],

    'home' => [
        'title' => 'Digital marketing agency',
        'description' => 'Digital marketing agency that delivers results: brandbook, content, Google & Meta Ads, SEO/AEO/GEO and web. Request a custom quote.',
    ],

    'services_index' => [
        'title' => 'Digital marketing services',
        'description' => 'Integrated digital marketing services: branding, content, Google & Meta Ads, SEO/AEO/GEO and web development. Discover the AddWrap packages.',
    ],

    'about' => [
        'title' => 'About us',
        'description' => 'A digital marketing agency with a small, dedicated team. Find out who we are, what we believe and how we work with our clients.',
    ],

    'portfolio' => [
        'title' => 'Portfolio and case studies',
        'description' => 'Case studies with real results: branding, Google & Meta Ads, SEO and web development. See the projects delivered by AddWrap.',
    ],

    'blog' => [
        'title' => 'Digital marketing blog',
        'description' => 'Digital marketing guides and articles: SEO, Google and Meta Ads, content and online performance. Read the AddWrap blog.',
    ],

    'faq' => [
        'title' => 'Frequently asked questions',
        'description' => 'Clear answers about services, pricing and how we work. Find out everything you need to know before working with AddWrap.',
    ],

    'pricing' => [
        'title' => 'Pricing and packages',
        'description' => 'Transparent digital marketing pricing: branding, ads, SEO and web. Estimate your package with the calculator or request a quote.',
    ],

    'contact' => [
        'title' => 'Contact',
        'description' => 'Let us talk about your digital marketing project. Contact the AddWrap team for a custom quote, with no obligation.',
    ],

    'thank_you' => [
        'title' => 'Thank you',
        'description' => 'Your message has been sent successfully. We will get back to you shortly.',
    ],

    'terms' => [
        'title' => 'Terms and conditions',
        'description' => 'Terms and conditions for using the AddWrap website and services.',
    ],

    'privacy' => [
        'title' => 'Privacy policy',
        'description' => 'How we collect, use and protect your personal data on the AddWrap website.',
    ],

    'cookies' => [
        'title' => 'Cookie policy',
        'description' => 'How we use cookies on the AddWrap website and how you can manage your preferences.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Service subpages (dedicated, keyword-optimized meta)
    |--------------------------------------------------------------------------
    | Titles WITHOUT the brand. Description: benefit + what we deliver + CTA.
    */

    'services' => [

        'brandbook' => [
            'title' => 'Brandbook and visual identity',
            'description' => 'Complete visual identity: logo, palette, fonts, tone of voice and brand guide, with final deliverables. Request the brandbook package.',
        ],

        'content-strategy' => [
            'title' => 'Content strategy, 12 months',
            'description' => 'A 12-month content strategy: plan, posting calendar and monthly scenarios, with monitoring and reports. Request a quote.',
        ],

        'google-ads' => [
            'title' => 'Google Ads: campaign management',
            'description' => 'Google Ads campaigns (Search, Display, YouTube) with setup, optimization and monthly reporting. Professional management — request a quote.',
        ],

        'meta-ads' => [
            'title' => 'Meta Ads: Facebook & Instagram',
            'description' => 'Meta Ads campaigns on Facebook and Instagram: setup, continuous optimization and a monthly performance report. Request a quote.',
        ],

        'seo-aeo-geo' => [
            'title' => 'SEO, AEO and GEO',
            'description' => 'Visibility in Google and AI assistants: SEO audit, on-page optimization, structured data and monitoring (SEO/AEO/GEO). Learn more.',
        ],

        'web-development' => [
            'title' => 'Website and maintenance',
            'description' => 'Fast, secure websites, from presentation sites to complex platforms, with maintenance and SEO included in the subscription. Request a quote.',
        ],

    ],

];
