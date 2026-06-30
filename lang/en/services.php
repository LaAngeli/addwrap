<?php

declare(strict_types=1);

return [

    'index' => [
        'eyebrow' => 'Services',
        'title' => 'Everything you need to grow online',
        'subtitle' => 'Marketing agency: from brand identity to content, paid advertising and a fast website with SEO included.',
        'cta_primary' => 'Start your project',
        'cta_secondary' => 'See pricing',
        'explorer_eyebrow' => 'Explore the services',
        'explorer_title' => 'Choose the right service for you',
        'explorer_subtitle' => 'Tap a service to see what it includes and how it helps you.',
        'view_service' => 'View the full service',
        'hero_points' => ['6 integrated services', 'Custom packages', 'Multilingual'],
        'hero_caption' => 'Integrated services, built to work together.',
    ],

    'show' => [
        'deliverables_title' => 'What we deliver',
        'included_title' => 'What we include',
        'packages_title' => 'Packages',
        'addons_title' => 'Add-on services',
        'other_title' => 'Other services',
        'combine_eyebrow' => 'Recommended combos',
        'combine_title' => 'Pairs perfectly with',
        'combine_subtitle' => 'Services that amplify results when combined.',
        'recommended' => 'Recommended',
        'cta_title' => 'Ready to get started?',
        'cta_text' => 'Let us discuss how this service fits your goals.',
        'price_cta' => 'Request a quote',
        'vat_hint' => 'All prices exclude VAT (21% rate).',
    ],

    'items' => [

        'brandbook' => [
            'name' => 'Brandbook',
            'tagline' => 'A complete visual identity for your brand',
            'excerpt' => 'Logo, palette, fonts, tone of voice, patterns and mockups — a complete brand system, final deliverables.',
            'description' => 'We build your visual and verbal brand identity in a complete package, with final deliverables ready to use across every channel.',
            'features' => [
                'Logo & variations',
                'Palette & typography',
                'Tone of voice & direction',
                'Mockups & brand guide',
            ],
            'price' => [
                'amount' => '€3,000',
                'unit' => 'complete package · final deliverables',
                'vat' => '+ 21% VAT',
                'frequency' => 'one-time',
            ],
            'modules' => [
                ['title' => 'I. Logo development', 'items' => ['3 logotype versions', 'Shape & color variations', 'Brand palette', 'Fonts']],
                ['title' => 'II. Concept & design direction', 'items' => ['Slogan', 'Tone of voice', 'Brand direction', 'Concept moodboard']],
                ['title' => 'III. Brand elements', 'items' => ['Set of 4 patterns', '3 images / backgrounds', 'Social media images (profile + cover)']],
                ['title' => 'IV. Mockups', 'items' => ['Set of 10 mockups of your choice', 'Business card, letterhead, folder, envelopes, t-shirt, roll-up, etc.']],
                ['title' => 'V. Brand guide', 'items' => ['Logo presentation', 'Logo / font / color usage rules', 'Finalized mockup set']],
            ],
            'highlight' => [
                'title' => 'Flexible · custom package',
                'text' => 'We can reconfigure the package so you get exactly the assets you need — e.g. just logo + palette, just fonts + patterns, or just mockups. Price calculated on request.',
            ],
        ],

        'content-strategy' => [
            'name' => 'Content Strategy',
            'tagline' => 'A 12-month communication plan, structured and measurable',
            'excerpt' => 'Tailored strategy, posting calendar and monthly content scenarios, with monitoring and reports.',
            'description' => 'We develop a 12-month communication plan with SMART goals, monthly content scenarios and continuous performance monitoring.',
            'packages' => [
                ['name' => 'Standard', 'volume' => '8 scenarios / month', 'price' => '€3,000', 'unit' => '+ 21% VAT / year', 'equivalent' => 'approx. €250/month', 'featured' => false],
                ['name' => 'Advanced', 'badge' => 'Recommended', 'volume' => '12 scenarios / month', 'price' => '€3,500', 'unit' => '+ 21% VAT / year', 'equivalent' => 'approx. €292/month', 'featured' => true],
            ],
            'features_title' => 'Both packages include',
            'features' => [
                'Tailored strategy + SMART goals',
                'Internal & external analysis + target audience',
                'Choosing the optimal communication channels',
                'Content plan + posting calendar',
                'Recommended content scenarios and types',
                'Monitoring & strategy adjustment',
                'Monthly / quarterly reports',
            ],
            'addons' => [
                ['title' => 'Video shooting and/or editing', 'price' => '€50/hour', 'note' => 'subtitles included · + 21% VAT'],
            ],
        ],

        'google-ads' => [
            'name' => 'Google Ads',
            'tagline' => 'Paid advertising with professional management',
            'excerpt' => 'Search · Display · YouTube. Setup, optimization and monthly reporting, regardless of the number of campaigns.',
            'description' => 'We manage your Google Ads campaigns (Search, Display, YouTube) with setup, continuous optimization and transparent monthly reporting.',
            'price' => [
                'amount' => '€400',
                'unit' => 'Search · Display · YouTube',
                'vat' => '+ 21% VAT',
                'frequency' => '/ month',
            ],
            'features_title' => 'What we include',
            'features' => [
                'Setup, optimization & reporting',
                'Regardless of the number of campaigns or client budget',
                'Monthly performance report',
                'Bid & keyword optimization',
            ],
            'addons' => [
                ['title' => 'Add-on for Website + SEO clients', 'price' => '+ €150–200/month', 'note' => 'tracking infrastructure already configured — reduced rate'],
                ['title' => 'Google Analytics setup', 'price' => '€150', 'note' => 'one-time, if missing'],
                ['title' => 'Banner creation', 'price' => '€50/banner', 'note' => 'reformatting €15/size'],
            ],
            'note' => 'Google Ads budgets are NOT included — they are paid directly to the platform. All prices + 21% VAT.',
        ],

        'meta-ads' => [
            'name' => 'Meta Ads',
            'tagline' => 'Facebook & Instagram ads with professional management',
            'excerpt' => 'Campaign setup, monitoring and monthly report on Facebook and Instagram.',
            'description' => 'We plan and manage your Meta campaigns (Facebook + Instagram), with setup, monitoring and monthly reporting.',
            'price' => [
                'amount' => '€400',
                'unit' => 'Facebook + Instagram',
                'vat' => '+ 21% VAT',
                'frequency' => '/ month',
            ],
            'features_title' => 'What we include',
            'features' => [
                'Campaign setup & structuring',
                'Continuous monitoring & optimization',
                'Monthly performance report',
                'Does not include graphics / ad copy',
            ],
            'addons' => [
                ['title' => 'Add-on for Website + SEO clients', 'price' => '+ €50/month', 'note' => 'tracking already configured'],
                ['title' => 'Banner creation', 'price' => '€50/banner', 'note' => 'reformatting €15/size'],
            ],
            'note' => 'Meta budgets are NOT included — they are paid directly to the platform. All prices + 21% VAT.',
        ],

        'seo-aeo-geo' => [
            'name' => 'SEO / AEO / GEO',
            'tagline' => 'Visibility in Google, AI assistants and generative engines',
            'excerpt' => 'Technical audit, on-page optimization, structured data and monitoring — included in the monthly Website + SEO package.',
            'description' => 'We optimize your website for search engines (SEO), direct answers (AEO) and generative AI engines (GEO), so you are found wherever your customers search, including ChatGPT and Google AI.',
            'price' => [
                'amount' => 'from €300',
                'unit' => 'SEO · AEO · GEO',
                'vat' => '+ 21% VAT',
                'frequency' => '/ month',
            ],
            'highlight' => [
                'title' => 'Part of the Website + SEO package',
                'text' => 'SEO / GEO / AEO optimization is included in the monthly maintenance (from €400/month + 21% VAT), with no separate setup cost.',
            ],
            'features_title' => 'What we include',
            'features' => [
                'Technical SEO audit & competitive analysis',
                'On-page SEO implementation',
                'Keywords + optimized meta',
                'URL structure & sitemap',
                'Structured data (Schema.org)',
                'Google Search Console',
                'Ranking monitoring & reporting',
            ],
        ],

        'web-development' => [
            'name' => 'Website + Maintenance',
            'tagline' => 'Tailored websites, from presentation sites to complex platforms',
            'excerpt' => 'Presentation site from €400, complex projects on request, plus maintenance and SEO in a monthly plan.',
            'description' => 'We build fast, secure websites, structured by project complexity and your goals — from presentation sites to online stores and SaaS platforms.',
            'features' => [
                'Modern, responsive design',
                'Technical maintenance & support',
                'Continuous optimization & SEO',
                'From presentation to complex platforms',
            ],
            'price' => [
                'amount' => 'from €400',
                'unit' => 'presentation site · creation',
                'vat' => '+ 21% VAT',
                'frequency' => 'one-time',
            ],
            'highlight' => [
                'title' => 'All-in-one package',
                'text' => 'For development, technical support and continuous optimization, choose the Web Dev + Maintenance + SEO package — all in one monthly subscription, from €400/month.',
            ],
            'modules' => [
                ['title' => 'Technical maintenance', 'items' => ['Site functionality monitoring', 'Technology & plugin updates', 'Bug fixing (front + back)', 'Speed & security optimization', 'Periodic backups', 'New pages & features', 'External integrations (forms, payments, APIs)']],
                ['title' => 'Continuous optimization', 'items' => ['Periodic site updates', 'Content changes on request', 'Ongoing performance monitoring', 'Continuous SEO optimization', 'Dedicated technical support', 'Option to extend the contract', 'Monthly results reporting']],
            ],
            'note' => 'SEO / GEO / AEO optimization is included in the monthly package.',
        ],

    ],

];
