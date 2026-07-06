<?php

declare(strict_types=1);

return [
    'eyebrow' => 'Calculator de buget',
    'title' => 'Estimează-ți investiția',
    'subtitle' => 'Alege serviciile dorite pentru o estimare orientativă. Abonamentul lunar și investiția inițială se calculează separat.',

    // Grupuri de selecție
    'group_monthly' => 'Abonament lunar',
    'group_monthly_hint' => 'servicii recurente, facturate lunar',
    'group_onetime' => 'Proiecte one-time',
    'group_onetime_hint' => 'costuri o singură dată',

    // Durata contractului (relevantă doar pentru abonament)
    'duration_label' => 'Durata contractului',
    'months_unit' => 'luni',

    // Prefix pentru prețuri estimative („de la")
    'from_prefix' => 'de la',

    // Rezultate
    'monthly_total_label' => 'Abonament lunar',
    'onetime_total_label' => 'Investiție inițială',
    'onetime_note' => 'o singură dată',
    'contract_label' => 'Buget primul contract (:months luni)',
    'contract_hint' => 'abonament × :months luni + investiție inițială',
    'unit_month' => '/lună',

    'empty_state' => 'Selectează cel puțin un serviciu pentru a vedea estimarea.',
    'cta' => 'Cere o ofertă exactă',
    'disclaimer' => 'Prețurile marcate „de la" sunt estimative și se stabilesc după discuție. Toate valorile sunt în €, fără TVA (21%) și fără bugetul media.',

    // Tarif add-on (aplicat automat când Google/Meta Ads e ales împreună cu alt serviciu).
    'addon_badge' => 'add-on',
    'addon_hint' => 'aplicat automat la combinație cu alt serviciu',

    // Etichete item-uri (atomice — split față de cele 6 servicii)
    'items' => [
        'content-strategy' => 'Strategie de conținut',
        'google-ads' => 'Google Ads (management)',
        'meta-ads' => 'Meta Ads (management)',
        'seo-aeo-geo' => 'SEO / AEO / GEO',
        'web-maintenance' => 'Mentenanță website',
        'web-creation' => 'Creare site de prezentare',
        'brandbook' => 'Brandbook — pachet complet',
        'analytics-setup' => 'Setare Google Analytics + GTM',
    ],
];
