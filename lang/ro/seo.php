<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Meta SEO (RO)
|--------------------------------------------------------------------------
| Titlu: „{Titlu pagină} | AddWrap" — brandul se adaugă automat (App\Support\Seo),
| deci titlurile AICI sunt FĂRĂ brand. Titlu ≤ ~48 caractere, keyword-first.
|
| Descriere — structură fixă: [beneficiu/keyword-first] + [ce facem concret] +
| [CTA]. Lungime ≤ ~155 caractere, cu cuvântul-cheie în primele cuvinte.
*/

return [

    'default' => [
        'title' => 'Agenție de marketing digital',
        'description' => 'Agenție de marketing digital: brandbook, content, Google & Meta Ads, SEO/AEO/GEO și dezvoltare web. Creștem afaceri prin rezultate măsurabile.',
    ],

    'home' => [
        'title' => 'Agenție de marketing digital',
        'description' => 'Agenție de marketing digital care aduce rezultate: brandbook, content, Google & Meta Ads, SEO/AEO/GEO și web. Cere o ofertă personalizată.',
    ],

    'services_index' => [
        'title' => 'Servicii de marketing digital',
        'description' => 'Servicii de marketing digital integrate: branding, content, Google & Meta Ads, SEO/AEO/GEO și dezvoltare web. Descoperă pachetele AddWrap.',
    ],

    'about' => [
        'title' => 'Despre noi',
        'description' => 'Agenție de marketing digital cu o echipă mică și dedicată. Află cine suntem, în ce credem și cum lucrăm cu clienții noștri.',
    ],

    'portfolio' => [
        'title' => 'Portofoliu și studii de caz',
        'description' => 'Studii de caz cu rezultate reale: branding, Google & Meta Ads, SEO și web development. Vezi proiectele realizate de AddWrap.',
    ],

    'blog' => [
        'title' => 'Blog de marketing digital',
        'description' => 'Ghiduri și articole de marketing digital: SEO, Google și Meta Ads, content și performanță online. Citește blogul AddWrap.',
    ],

    'faq' => [
        'title' => 'Întrebări frecvente',
        'description' => 'Răspunsuri clare despre servicii, prețuri și modul nostru de lucru. Află tot ce trebuie să știi înainte de o colaborare cu AddWrap.',
    ],

    'pricing' => [
        'title' => 'Prețuri și pachete',
        'description' => 'Prețuri transparente la marketing digital: branding, ads, SEO și web. Estimează-ți pachetul cu calculatorul sau cere o ofertă.',
    ],

    'contact' => [
        'title' => 'Contact',
        'description' => 'Hai să discutăm despre proiectul tău de marketing digital. Contactează echipa AddWrap pentru o ofertă personalizată, fără obligații.',
    ],

    'thank_you' => [
        'title' => 'Mulțumim',
        'description' => 'Mesajul tău a fost trimis cu succes. Revenim cât mai curând cu un răspuns.',
    ],

    'terms' => [
        'title' => 'Termeni și condiții',
        'description' => 'Termenii și condițiile de utilizare a site-ului și serviciilor AddWrap.',
    ],

    'privacy' => [
        'title' => 'Politica de confidențialitate',
        'description' => 'Cum colectăm, folosim și protejăm datele tale personale pe site-ul AddWrap.',
    ],

    'cookies' => [
        'title' => 'Politica de cookies',
        'description' => 'Cum folosim cookie-urile pe site-ul AddWrap și cum îți poți gestiona preferințele.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Subpaginile de serviciu (meta dedicat, optimizat pe cuvinte cheie)
    |--------------------------------------------------------------------------
    | Titluri FĂRĂ brand. Descriere: beneficiu + ce livrăm + CTA.
    */

    'services' => [

        'brandbook' => [
            'title' => 'Brandbook și identitate vizuală',
            'description' => 'Identitate vizuală completă: logo, paletă, fonturi, ton al vocii și ghid de brand, cu livrabile finale. Cere pachetul brandbook.',
        ],

        'content-strategy' => [
            'title' => 'Strategie de content pe 12 luni',
            'description' => 'Strategie de content pe 12 luni: plan, calendar de postări și scenarii lunare, cu monitorizare și rapoarte. Cere o ofertă.',
        ],

        'google-ads' => [
            'title' => 'Google Ads: management campanii',
            'description' => 'Campanii Google Ads (Search, Display, YouTube) cu setare, optimizare și raportare lunară. Management profesional — cere o ofertă.',
        ],

        'meta-ads' => [
            'title' => 'Meta Ads: Facebook și Instagram',
            'description' => 'Campanii Meta Ads pe Facebook și Instagram: setare, optimizare continuă și raport lunar de performanță. Cere o ofertă.',
        ],

        'seo-aeo-geo' => [
            'title' => 'SEO, AEO și GEO',
            'description' => 'Vizibilitate în Google și în asistenții AI: audit SEO, optimizare on-page, date structurate și monitorizare (SEO/AEO/GEO). Află mai mult.',
        ],

        'web-development' => [
            'title' => 'Website și mentenanță',
            'description' => 'Site-uri rapide și sigure, de la prezentare la platforme complexe, cu mentenanță și SEO incluse în abonament. Cere o ofertă.',
        ],

    ],

];
