<?php

declare(strict_types=1);

return [

    'index' => [
        'eyebrow' => 'Servicii',
        'title' => 'Tot ce ai nevoie pentru a crește online',
        'subtitle' => 'Agenție de marketing: de la identitatea de brand la conținut, publicitate plătită și site rapid cu SEO inclus.',
        'cta_primary' => 'Începe proiectul',
        'cta_secondary' => 'Vezi prețurile',
        'explorer_eyebrow' => 'Explorează serviciile',
        'explorer_title' => 'Alege serviciul potrivit pentru tine',
        'explorer_subtitle' => 'Apasă pe un serviciu pentru a vedea ce include și cum te ajută.',
        'view_service' => 'Vezi serviciul complet',
        'hero_points' => ['6 servicii integrate', 'Pachete personalizate', 'Multilingv'],
        'hero_caption' => 'Servicii integrate, gândite să lucreze împreună.',
    ],

    'show' => [
        'deliverables_title' => 'Ce livrăm',
        'included_title' => 'Ce includem',
        'packages_title' => 'Pachete',
        'addons_title' => 'Servicii suplimentare',
        'other_title' => 'Alte servicii',
        'combine_eyebrow' => 'Combinații recomandate',
        'combine_title' => 'Merge perfect cu',
        'combine_subtitle' => 'Servicii care amplifică rezultatele atunci când le combini.',
        'recommended' => 'Recomandat',
        'cta_title' => 'Pregătit să începem?',
        'cta_text' => 'Hai să discutăm cum acest serviciu se potrivește obiectivelor tale.',
        'price_cta' => 'Cere o ofertă',
        'vat_hint' => 'Toate prețurile sunt fără TVA (cota 21%).',
    ],

    'items' => [

        'brandbook' => [
            'name' => 'Brandbook',
            'tagline' => 'Identitate vizuală completă pentru brandul tău',
            'excerpt' => 'Logo, paletă, fonturi, ton al vocii, pattern-uri și vizualizări — un sistem de brand complet, livrabile finale.',
            'description' => 'Construim identitatea vizuală și verbală a brandului tău într-un pachet complet, cu livrabile finale gata de folosit pe toate canalele.',
            'features' => [
                'Logo & variațiuni',
                'Paletă & tipografie',
                'Ton al vocii & direcție',
                'Vizualizări & ghid de brand',
            ],
            'price' => [
                'amount' => '3.000 €',
                'unit' => 'pachet complet · livrabile finale',
                'vat' => '+ TVA 21%',
                'frequency' => 'o singură dată',
            ],
            'modules' => [
                ['title' => 'I. Dezvoltarea logoului', 'items' => ['3 versiuni de logotip', 'Variațiuni de formă & culoare', 'Paletă de brand', 'Fonturi']],
                ['title' => 'II. Concept & direcție design', 'items' => ['Slogan', 'Ton al vocii', 'Direcție de brand', 'Moodboard concept']],
                ['title' => 'III. Elemente de brand', 'items' => ['Set de 4 pattern-uri', '3 imagini / background', 'Imagini social media (profil + cover)']],
                ['title' => 'IV. Vizualizări', 'items' => ['Set de 10 vizualizări la alegere', 'Carte de vizită, antet, mapă, plicuri, tricou, roll-up etc.']],
                ['title' => 'V. Ghid de brand', 'items' => ['Prezentare logo', 'Reguli de utilizare logo / font / culori', 'Set de vizualizări finalizat']],
            ],
            'highlight' => [
                'title' => 'Flexibil · pachet personalizat',
                'text' => 'Reconfigurăm pachetul ca să primești strict instrumentele de care ai nevoie — de ex. doar logo + paletă, doar fonturi + pattern-uri sau doar vizualizări. Preț calculat în funcție de solicitare.',
            ],
        ],

        'content-strategy' => [
            'name' => 'Strategie de Conținut',
            'tagline' => 'Plan de comunicare pe 12 luni, structurat și măsurabil',
            'excerpt' => 'Strategie personalizată, calendar de postări și scenarii lunare de conținut, cu monitorizare și rapoarte.',
            'description' => 'Dezvoltăm un plan de comunicare pe 12 luni, cu obiective SMART, scenarii lunare de conținut și monitorizare continuă a rezultatelor.',
            'packages' => [
                ['name' => 'Standard', 'volume' => '8 scenarii / lună', 'price' => '3.000 €', 'unit' => '+ TVA 21% / an', 'equivalent' => 'echivalent 250 €/lună', 'featured' => false],
                ['name' => 'Avansat', 'badge' => 'Recomandat', 'volume' => '12 scenarii / lună', 'price' => '3.500 €', 'unit' => '+ TVA 21% / an', 'equivalent' => 'echivalent ≈ 292 €/lună', 'featured' => true],
            ],
            'features_title' => 'Ambele pachete includ',
            'features' => [
                'Strategie personalizată + obiective SMART',
                'Analiză internă & externă + identificare public țintă',
                'Stabilirea canalelor optime de comunicare',
                'Plan de conținut + calendar de postări',
                'Scenarii și tipuri de conținut recomandate',
                'Monitorizare & ajustare strategie',
                'Rapoarte lunare / trimestriale',
            ],
            'addons' => [
                ['title' => 'Filmare și/sau editare video', 'price' => '50 €/oră', 'note' => 'cu subtitrare inclusă · + TVA 21%'],
            ],
        ],

        'google-ads' => [
            'name' => 'Google Ads',
            'tagline' => 'Publicitate plătită cu management profesional',
            'excerpt' => 'Search · Display · YouTube. Setare, optimizare și raportare lunară, indiferent de numărul de campanii.',
            'description' => 'Gestionăm campaniile tale Google Ads (Search, Display, YouTube) cu setare, optimizare continuă și raportare lunară transparentă.',
            'price' => [
                'amount' => '400 €',
                'unit' => 'Search · Display · YouTube',
                'vat' => '+ TVA 21%',
                'frequency' => '/ lună',
            ],
            'features_title' => 'Ce includem',
            'features' => [
                'Setare, optimizare & raportare',
                'Indiferent de numărul de campanii sau bugetul clientului',
                'Raport lunar de performanță',
                'Optimizare licitații & cuvinte cheie',
            ],
            'addons' => [
                ['title' => 'Add-on pentru clienții cu Website + SEO', 'price' => '+ 150–200 €/lună', 'note' => 'infrastructura de tracking e deja configurată — tarif redus'],
                ['title' => 'Setare Google Analytics', 'price' => '150 €', 'note' => 'o singură dată, dacă lipsește'],
                ['title' => 'Creare banner', 'price' => '50 €/banner', 'note' => 'reformatare 15 €/format'],
            ],
            'note' => 'Bugetele Google Ads NU sunt incluse — se plătesc direct platformei. Toate prețurile + TVA 21%.',
        ],

        'meta-ads' => [
            'name' => 'Meta Ads',
            'tagline' => 'Reclame Facebook & Instagram cu management profesional',
            'excerpt' => 'Setare campanie, monitorizare și raport lunar pe Facebook și Instagram.',
            'description' => 'Planificăm și gestionăm campaniile tale Meta (Facebook + Instagram), cu setare, monitorizare și raportare lunară.',
            'price' => [
                'amount' => '400 €',
                'unit' => 'Facebook + Instagram',
                'vat' => '+ TVA 21%',
                'frequency' => '/ lună',
            ],
            'features_title' => 'Ce includem',
            'features' => [
                'Setare & structurare campanii',
                'Monitorizare & optimizare continuă',
                'Raport lunar de performanță',
                'Nu include grafică / texte publicitare',
            ],
            'addons' => [
                ['title' => 'Add-on pentru clienții cu Website + SEO', 'price' => '+ 50 €/lună', 'note' => 'tracking deja configurat'],
                ['title' => 'Creare banner', 'price' => '50 €/banner', 'note' => 'reformatare 15 €/format'],
            ],
            'note' => 'Bugetele Meta NU sunt incluse — se plătesc direct platformei. Toate prețurile + TVA 21%.',
        ],

        'seo-aeo-geo' => [
            'name' => 'SEO / AEO / GEO',
            'tagline' => 'Vizibilitate în Google, în asistenții AI și în motoarele generative',
            'excerpt' => 'Audit tehnic, optimizare on-page, date structurate și monitorizare — inclus în pachetul lunar Website + SEO.',
            'description' => 'Optimizăm site-ul pentru motoarele de căutare (SEO), pentru răspunsurile directe (AEO) și pentru motoarele generative AI (GEO), ca să fii găsit oriunde caută clienții tăi, inclusiv în ChatGPT și Google AI.',
            'price' => [
                'amount' => 'de la 300 €',
                'unit' => 'SEO · AEO · GEO',
                'vat' => '+ TVA 21%',
                'frequency' => '/ lună',
            ],
            'highlight' => [
                'title' => 'Parte din pachetul Website + SEO',
                'text' => 'Optimizarea SEO / GEO / AEO este inclusă în mentenanța lunară (de la 400 €/lună + TVA 21%), fără cost separat de start.',
            ],
            'features_title' => 'Ce includem',
            'features' => [
                'Audit SEO tehnic & analiză competitivă',
                'Implementare SEO On-Page',
                'Cuvinte cheie + meta optimizate',
                'Structură URL & sitemap',
                'Date structurate (Schema.org)',
                'Google Search Console',
                'Monitorizare poziții & raportare',
            ],
        ],

        'web-development' => [
            'name' => 'Website + Mentenanță',
            'tagline' => 'Site-uri pe măsură, de la prezentare la platforme complexe',
            'excerpt' => 'Site de prezentare de la 400 €, proiecte complexe la cerere, plus mentenanță și SEO în abonament lunar.',
            'description' => 'Construim site-uri rapide și sigure, structurate după complexitatea proiectului și obiectivele tale — de la site de prezentare la magazine online și platforme SaaS.',
            'features' => [
                'Design modern, responsive',
                'Mentenanță tehnică & suport',
                'Optimizare & SEO continuă',
                'De la prezentare la platforme complexe',
            ],
            'price' => [
                'amount' => 'de la 400 €',
                'unit' => 'site de prezentare · creare',
                'vat' => '+ TVA 21%',
                'frequency' => 'taxă unică',
            ],
            'highlight' => [
                'title' => 'Pachet all-in-one',
                'text' => 'Pentru dezvoltare, suport tehnic și optimizare continuă, alege pachetul Web Dev + Mentenanță + SEO — totul într-un abonament lunar, de la 400 €/lună.',
            ],
            'modules' => [
                ['title' => 'Mentenanță tehnică', 'items' => ['Monitorizare funcționalitate site', 'Actualizare tehnologii & plugin-uri', 'Remediere erori (front + back)', 'Optimizare viteză & securitate', 'Backup-uri periodice', 'Pagini & funcționalități noi', 'Integrări externe (formulare, plăți, API-uri)']],
                ['title' => 'Optimizare continuă', 'items' => ['Actualizări periodice site', 'Modificări de conținut la cerere', 'Monitorizare permanentă performanță', 'Optimizări SEO continue', 'Suport tehnic dedicat', 'Posibilitate prelungire contract', 'Raportare lunară a rezultatelor']],
            ],
            'note' => 'Optimizarea SEO / GEO / AEO este inclusă în pachetul lunar.',
        ],

    ],

];
