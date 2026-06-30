<?php

declare(strict_types=1);

return [

    'brandbook' => [
        ['key' => 'web-development', 'reason' => 'Un site care reflectă perfect noul tău brand.'],
        ['key' => 'content-strategy', 'reason' => 'Voce și ton de brand aplicate constant în conținut.'],
        ['key' => 'meta-ads', 'reason' => 'Reclame coerente vizual cu identitatea ta.'],
    ],

    'content-strategy' => [
        ['key' => 'seo-aeo-geo', 'reason' => 'Conținut gândit să fie găsit în căutare.'],
        ['key' => 'meta-ads', 'reason' => 'Distribuie conținutul către publicul potrivit.'],
        ['key' => 'web-development', 'reason' => 'Blog și landing pages pentru conținutul tău.'],
    ],

    'google-ads' => [
        ['key' => 'web-development', 'reason' => 'Landing pages rapide care convertesc traficul plătit.'],
        ['key' => 'seo-aeo-geo', 'reason' => 'Vizibilitate plătită și organică, împreună.'],
        ['key' => 'meta-ads', 'reason' => 'Acoperire completă pe Google și social.'],
    ],

    'meta-ads' => [
        ['key' => 'content-strategy', 'reason' => 'Creative și mesaje care performează în reclame.'],
        ['key' => 'web-development', 'reason' => 'Landing pages dedicate campaniilor.'],
        ['key' => 'google-ads', 'reason' => 'Mix complet de publicitate plătită.'],
    ],

    'seo-aeo-geo' => [
        ['key' => 'web-development', 'reason' => 'SEO inclus într-un site rapid și sigur.'],
        ['key' => 'content-strategy', 'reason' => 'Conținut care rankează și aduce trafic.'],
        ['key' => 'google-ads', 'reason' => 'Completează organicul cu trafic plătit.'],
    ],

    'web-development' => [
        ['key' => 'seo-aeo-geo', 'reason' => 'Site optimizat pentru căutare, din start.'],
        ['key' => 'content-strategy', 'reason' => 'Conținut care îți umple site-ul de valoare.'],
        ['key' => 'google-ads', 'reason' => 'Add-on redus la Ads pentru clienții cu site.'],
    ],

];
