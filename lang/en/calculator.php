<?php

declare(strict_types=1);

return [
    'eyebrow' => 'Budget calculator',
    'title' => 'Estimate your investment',
    'subtitle' => 'Pick the services you want for a ballpark estimate. The monthly subscription and the initial investment are calculated separately.',

    // Selection groups
    'group_monthly' => 'Monthly subscription',
    'group_monthly_hint' => 'recurring services, billed monthly',
    'group_onetime' => 'One-time projects',
    'group_onetime_hint' => 'one-time costs',

    // Contract length (only relevant for the subscription)
    'duration_label' => 'Contract length',
    'months_unit' => 'months',

    // Prefix for estimated ("from") prices
    'from_prefix' => 'from',

    // Results
    'monthly_total_label' => 'Monthly subscription',
    'onetime_total_label' => 'Initial investment',
    'onetime_note' => 'one-time',
    'contract_label' => 'First contract budget (:months months)',
    'contract_hint' => 'subscription × :months months + initial investment',
    'unit_month' => '/month',

    'empty_state' => 'Select at least one service to see the estimate.',
    'cta' => 'Request an exact quote',
    'disclaimer' => 'Prices marked "from" are estimates and are set after a discussion. All values are in €, excluding VAT (21%) and media budget.',

    // Item labels (atomic — split from the 6 services)
    'items' => [
        'content-strategy' => 'Content strategy',
        'google-ads' => 'Google Ads (management)',
        'meta-ads' => 'Meta Ads (management)',
        'seo-aeo-geo' => 'SEO / AEO / GEO',
        'web-maintenance' => 'Website maintenance',
        'web-creation' => 'Presentation website build',
        'brandbook' => 'Brandbook — full package',
        'analytics-setup' => 'Google Analytics + GTM setup',
    ],
];
