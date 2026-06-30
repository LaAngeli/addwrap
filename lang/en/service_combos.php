<?php

declare(strict_types=1);

return [

    'brandbook' => [
        ['key' => 'web-development', 'reason' => 'A website that perfectly reflects your new brand.'],
        ['key' => 'content-strategy', 'reason' => 'Brand voice and tone applied consistently in content.'],
        ['key' => 'meta-ads', 'reason' => 'Ads visually consistent with your identity.'],
    ],

    'content-strategy' => [
        ['key' => 'seo-aeo-geo', 'reason' => 'Content built to be found in search.'],
        ['key' => 'meta-ads', 'reason' => 'Distribute your content to the right audience.'],
        ['key' => 'web-development', 'reason' => 'A blog and landing pages for your content.'],
    ],

    'google-ads' => [
        ['key' => 'web-development', 'reason' => 'Fast landing pages that convert paid traffic.'],
        ['key' => 'seo-aeo-geo', 'reason' => 'Paid and organic visibility, together.'],
        ['key' => 'meta-ads', 'reason' => 'Full coverage across Google and social.'],
    ],

    'meta-ads' => [
        ['key' => 'content-strategy', 'reason' => 'Creative and messaging that perform in ads.'],
        ['key' => 'web-development', 'reason' => 'Dedicated landing pages for your campaigns.'],
        ['key' => 'google-ads', 'reason' => 'A complete paid advertising mix.'],
    ],

    'seo-aeo-geo' => [
        ['key' => 'web-development', 'reason' => 'SEO included in a fast, secure website.'],
        ['key' => 'content-strategy', 'reason' => 'Content that ranks and drives traffic.'],
        ['key' => 'google-ads', 'reason' => 'Complement organic with paid traffic.'],
    ],

    'web-development' => [
        ['key' => 'seo-aeo-geo', 'reason' => 'A website optimized for search from the start.'],
        ['key' => 'content-strategy', 'reason' => 'Content that fills your site with value.'],
        ['key' => 'google-ads', 'reason' => 'Reduced Ads add-on for website clients.'],
    ],

];
