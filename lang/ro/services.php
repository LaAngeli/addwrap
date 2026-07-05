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
        'explorer_title' => 'Alege modul de lucru potrivit obiectivelor tale',
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
            'description' => 'Construim identitatea vizuală și de comunicare a brandului tău într-un pachet complet, cu livrabile finale gata de folosit pe toate canalele.',
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
            'faq' => [
                ['q' => 'Ce primesc concret într-un brandbook?', 'a' => 'Nu primești logoul gata în 3 versiuni finale — creăm 3 variații de logo, tu alegi direcția care ți se potrivește, iar în jurul ei construim restul brandbook-ului: paletă, fonturi, pattern-uri, vizualizări și ghidul de brand. Durata variază între o lună și 3 luni, în funcție de complexitate.'],
                ['q' => 'Cât durează crearea unui brandbook?', 'a' => 'Între 2 și 4 săptămâni, în funcție de complexitate, de la primul brief până la livrabilele finale.'],
                ['q' => 'Pot să folosesc brandul singur după aceea?', 'a' => 'Da. Primești ghidul de brand cu reguli clare pentru logo, font, culori și vizualizări — îl poți preda oricărui colaborator sau imprimerii fără ambiguități.'],
                ['q' => 'Pot lua doar o parte din pachet?', 'a' => 'Da. Reconfigurăm pachetul (doar logo + paletă, doar fonturi + pattern-uri sau doar vizualizări) și recalculăm prețul pe solicitarea ta.'],
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
            'faq' => [
                ['q' => 'Ce conține planul pe 12 luni?', 'a' => 'Strategie cu obiective SMART, calendar editorial detaliat, scenarii lunare de conținut (8 sau 12), canale optime de comunicare și rapoarte lunare sau trimestriale.'],
                ['q' => 'Faceți și producția conținutului (text + grafică)?', 'a' => 'Strategia și calendarul sunt incluse în abonament. Producția (text, foto/video, montaj) se cotează separat sau prin add-on Filmare/editare video la 50 €/oră.'],
                ['q' => 'Pot ajusta strategia pe parcurs?', 'a' => 'Da. Lunar revizuim ce funcționează și ajustăm scenariile, astfel încât planul rămâne relevant chiar dacă apar schimbări la business.'],
                ['q' => 'Pe ce canale lucrăm?', 'a' => 'Stabilim împreună canalele optime în faza de strategie — de regulă Facebook, Instagram, TikTok — și concentrăm efortul unde audiența ta este.'],
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
            'features_title' => 'Ce include',
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
            'faq' => [
                ['q' => 'Bugetul de publicitate este inclus în tariful lunar?', 'a' => 'Nu. Tariful lunar acoperă management, optimizare și raportare. Bugetul media se plătește direct către Google, separat de fee-ul nostru.'],
                ['q' => 'Ce tip de campanii rulați?', 'a' => 'Search (pentru cerere existentă), Display (notorietate și remarketing) și YouTube (video) — alegerea depinde de obiectivul tău și de publicul țintă.'],
                ['q' => 'Cât durează până apar primele rezultate?', 'a' => 'Search aduce conversii în câteva zile dacă există cerere. Display și YouTube au nevoie de 4-6 săptămâni pentru optimizarea algoritmilor și o medie ROAS stabilă.'],
                ['q' => 'Există minimum de contract?', 'a' => 'Recomandăm minimum 3 luni — primele 30 de zile sunt de calibrare a algoritmilor, iar performanța reală se vede din luna a doua și a treia.'],
            ],
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
            'features_title' => 'Ce include',
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
            'faq' => [
                ['q' => 'Care e diferența dintre Meta Ads și Boost?', 'a' => 'Boost-ul promovează un post existent fără targeting precis. Meta Ads îți oferă obiective dedicate (vânzări, lead-uri, trafic), audiențe granulare, A/B testing și raportare detaliată.'],
                ['q' => 'Faceți și creative-uri (imagini / video)?', 'a' => 'Strategia, setarea și optimizarea sunt incluse. Creativele se realizează prin add-on (banner 50 €, reformatare 15 €/format) sau folosim materialele tale existente.'],
                ['q' => 'Cât durează până apar primele lead-uri?', 'a' => 'De obicei 2-3 săptămâni pentru calibrarea algoritmilor Meta și obținerea unei rate stabile cost/rezultat. Primele conversii pot apărea în primele zile.'],
                ['q' => 'Bugetul reclamelor este inclus?', 'a' => 'Nu. Tariful lunar acoperă management, optimizare și raport. Bugetul Meta se plătește direct platformei, separat de fee-ul de management.'],
            ],
        ],

        'seo-aeo-geo' => [
            'name' => 'SEO / AEO / GEO',
            'tagline' => 'Vizibilitate în Google, în asistenții AI și în motoarele generative',
            'excerpt' => 'Audit tehnic, optimizare on-page, date structurate și monitorizare — inclus în pachetul lunar Website + SEO.',
            'description' => 'Optimizăm site-ul pentru motoarele de căutare (SEO), pentru răspunsurile directe (AEO) și pentru motoarele generative AI (GEO), ca să fii găsit oriunde te caută clienții tăi, inclusiv în ChatGPT și Google AI.',
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
            'features_title' => 'Ce include',
            'features' => [
                'Audit SEO tehnic & analiză competitivă',
                'Implementare SEO On-Page',
                'Cuvinte cheie + meta optimizate',
                'Structură URL & sitemap',
                'Date structurate (Schema.org)',
                'Google Search Console',
                'Monitorizare poziții & raportare',
            ],
            'glossary_eyebrow' => 'Glosar',
            'glossary_title' => 'Ce înseamnă SEO, AEO și GEO, pe scurt',
            'glossary_subtitle' => 'Trei termeni, trei direcții complementare de optimizare — orientate spre Google clasic, asistenții AI și motoarele generative.',
            'definitions' => [
                [
                    'term' => 'SEO',
                    'description' => 'Search Engine Optimization — optimizarea tehnică și de conținut a unui site pentru a apărea cât mai sus în rezultatele clasice ale motoarelor de căutare (Google, Bing).',
                ],
                [
                    'term' => 'AEO',
                    'description' => 'Answer Engine Optimization — optimizarea conținutului pentru a fi extras ca răspuns direct de motoarele de răspuns și de asistenții AI (ChatGPT, Perplexity, Google AI Overviews).',
                ],
                [
                    'term' => 'GEO',
                    'description' => 'Generative Engine Optimization — practica de a face un brand citabil de motoarele generative AI (LLM-uri), prin date structurate, llms.txt, citate verificabile și autoritate de domeniu.',
                ],
            ],
            'faq' => [
                ['q' => 'Care e diferența între SEO, AEO și GEO?', 'a' => 'SEO te aduce sus în rezultatele clasice Google. AEO te face citat ca răspuns direct de ChatGPT, Perplexity și AI Overviews. GEO e umbrela care îți face brandul citabil de toate motoarele generative AI prin date structurate și autoritate de domeniu.'],
                ['q' => 'Cât durează până apar rezultate SEO?', 'a' => 'Primele semnale (poziții noi pe long-tail) apar în 6-10 săptămâni. Rezultate stabile pe cuvinte cheie competitive — 4-6 luni. SEO e un sport pe termen lung, nu o intervenție de o săptămână.'],
                ['q' => 'Cum optimizați pentru ChatGPT și Google AI?', 'a' => 'Date structurate (Schema.org), llms.txt, FAQ-uri citabile, definiții clare și autoritate verificabilă (Person/Author schema). Conținutul care răspunde direct la întrebări câștigă în AI Overviews și Perplexity.'],
                ['q' => 'Trebuie să-mi schimb conținutul existent?', 'a' => 'Nu de la zero. Auditul SEO identifică ce funcționează deja, ce trebuie restructurat (titluri, meta, conținut subțire) și ce trebuie adăugat (pagini noi, FAQ-uri, date structurate).'],
            ],
        ],

        'web-development' => [
            'name' => 'Website + Mentenanță',
            'tagline' => 'Site-uri pe măsură, structurate după complexitatea firmei și a obiectivelor tale',
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
            'faq' => [
                ['q' => 'Pe ce tehnologii lucrați?', 'a' => 'Laravel pentru backend, Tailwind CSS și Livewire / Alpine pentru frontend. Site-uri rapide, SEO-friendly și ușor de întreținut, găzduite pe hosting compatibil shared sau VPS.'],
                ['q' => 'Cât durează un site de prezentare?', 'a' => '4-8 săptămâni de la brief până la live, în funcție de numărul de pagini, conținut și integrări externe (formulare, plăți, API-uri).'],
                ['q' => 'Hosting-ul este inclus?', 'a' => 'Nu. Recomandăm hosting potrivit complexității proiectului — ne integrăm cu provider-ul tău existent sau te ajutăm să-l alegi.'],
                ['q' => 'Pot edita conținutul singur?', 'a' => 'Da, oriunde ai nevoie de update-uri frecvente integrăm un panou de administrare ușor de folosit. Pentru update-uri rare, mentenanța lunară include modificări la cerere.'],
            ],
        ],

    ],

];
