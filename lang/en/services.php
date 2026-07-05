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
        'explorer_title' => 'Choose the way of working that fits your goals',
        'explorer_subtitle' => 'Tap a service to see what it includes and how it helps you.',
        'view_service' => 'View the full service',
        'hero_points' => ['6 integrated services', 'Custom packages', 'Multilingual'],
        'hero_caption' => 'Integrated services, built to work together.',
    ],

    'show' => [
        'deliverables_title' => 'What we deliver',
        'included_title' => 'What\'s included',
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
            'description' => 'We build your visual and communication brand identity in a complete package, with final deliverables ready to use across every channel.',
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
            'faq' => [
                ['q' => 'What do I get in the brandbook?', 'a' => 'You do not get the logo delivered as 3 final versions — we create 3 logo variations, you pick the direction that fits you, and we build the rest of the brandbook around it: palette, fonts, patterns, mockups and the brand guide. Duration ranges from one to 3 months, depending on complexity.'],
                ['q' => 'How long does the brandbook take?', 'a' => 'Between 2 and 4 weeks, depending on complexity, from the first brief to the final deliverables.'],
                ['q' => 'Can I use the brand on my own afterwards?', 'a' => 'Yes. You receive the brand guide with clear rules for logo, font, colors and mockups — you can hand it to any collaborator or print shop without ambiguity.'],
                ['q' => 'Can I take just part of the package?', 'a' => 'Yes. We reshape the package (just logo + palette, just fonts + patterns, or just mockups) and recalculate the price for your request.'],
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
            'faq' => [
                ['q' => 'What is in the 12-month plan?', 'a' => 'A strategy with SMART goals, a detailed editorial calendar, monthly content scenarios (8 or 12), optimal communication channels and monthly or quarterly reports.'],
                ['q' => 'Do you also produce the content (copy + visuals)?', 'a' => 'Strategy and calendar are included. Production (copy, photo/video, editing) is quoted separately or via the Video filming/editing add-on at €50/hour.'],
                ['q' => 'Can I adjust the strategy along the way?', 'a' => 'Yes. We review monthly what works and adjust the scenarios, so the plan stays relevant even if your business changes.'],
                ['q' => 'Which channels do we work on?', 'a' => 'We pick the optimal channels together in the strategy phase — usually Facebook, Instagram, TikTok — and concentrate effort where your audience already is.'],
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
            'features_title' => 'What\'s included',
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
            'faq' => [
                ['q' => 'Is the ad budget included in the monthly fee?', 'a' => 'No. The monthly fee covers management, optimization and reporting. The media budget is paid directly to Google, separately from our fee.'],
                ['q' => 'What types of campaigns do you run?', 'a' => 'Search (existing demand), Display (awareness and remarketing) and YouTube (video) — the choice depends on your goal and your target audience.'],
                ['q' => 'How long until the first results?', 'a' => 'Search brings conversions within days if demand exists. Display and YouTube need 4-6 weeks for algorithm optimization and a steady ROAS.'],
                ['q' => 'Is there a minimum contract?', 'a' => 'We recommend a 3-month minimum — the first 30 days are algorithm calibration, real performance shows from month two and three.'],
            ],
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
            'features_title' => 'What\'s included',
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
            'faq' => [
                ['q' => 'What is the difference between Meta Ads and Boost?', 'a' => 'Boost promotes an existing post without precise targeting. Meta Ads gives you dedicated objectives (sales, leads, traffic), granular audiences, A/B testing and detailed reporting.'],
                ['q' => 'Do you also produce creatives (images / video)?', 'a' => 'Strategy, setup and optimization are included. Creatives are produced via add-on (banner €50, reformat €15/format) or we use your existing assets.'],
                ['q' => 'How long until the first leads arrive?', 'a' => 'Usually 2-3 weeks for Meta algorithm calibration and a stable cost/result. First conversions can appear within days.'],
                ['q' => 'Is the ad budget included?', 'a' => 'No. The monthly fee covers management, optimization and report. The Meta budget is paid directly to the platform, separate from the management fee.'],
            ],
        ],

        'seo-aeo-geo' => [
            'name' => 'SEO / AEO / GEO',
            'tagline' => 'Visibility in Google, AI assistants and generative engines',
            'excerpt' => 'Technical audit, on-page optimization, structured data and monitoring — included in the monthly Website + SEO package.',
            'description' => 'We optimize your website for search engines (SEO), direct answers (AEO) and generative AI engines (GEO), so you are found wherever your customers search for you, including ChatGPT and Google AI.',
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
            'features_title' => 'What\'s included',
            'features' => [
                'Technical SEO audit & competitive analysis',
                'On-page SEO implementation',
                'Keywords + optimized meta',
                'URL structure & sitemap',
                'Structured data (Schema.org)',
                'Google Search Console',
                'Ranking monitoring & reporting',
            ],
            'glossary_eyebrow' => 'Glossary',
            'glossary_title' => 'SEO, AEO and GEO: what each means, in short',
            'glossary_subtitle' => 'Three terms, three complementary optimization directions — for classic Google, AI assistants and generative engines.',
            'definitions' => [
                [
                    'term' => 'SEO',
                    'description' => 'Search Engine Optimization — the technical and content optimization of a website to rank as high as possible in classic search engine results (Google, Bing).',
                ],
                [
                    'term' => 'AEO',
                    'description' => 'Answer Engine Optimization — optimizing content so it is extracted as a direct answer by answer engines and AI assistants (ChatGPT, Perplexity, Google AI Overviews).',
                ],
                [
                    'term' => 'GEO',
                    'description' => 'Generative Engine Optimization — making a brand citable by generative AI engines (LLMs) through structured data, llms.txt, verifiable citations and domain authority.',
                ],
            ],
            'faq' => [
                ['q' => 'What is the difference between SEO, AEO and GEO?', 'a' => 'SEO brings you to the top of classic Google results. AEO makes you cited as a direct answer by ChatGPT, Perplexity and AI Overviews. GEO is the umbrella that makes your brand citable by all generative AI engines via structured data and domain authority.'],
                ['q' => 'How long until SEO results?', 'a' => 'First signals (new positions on long-tail keywords) appear in 6-10 weeks. Stable results on competitive keywords — 4-6 months. SEO is a long game, not a one-week intervention.'],
                ['q' => 'How do you optimize for ChatGPT and Google AI?', 'a' => 'Structured data (Schema.org), llms.txt, citable FAQs, clear definitions and verifiable authority (Person/Author schema). Content that directly answers questions wins in AI Overviews and Perplexity.'],
                ['q' => 'Do I have to change my existing content?', 'a' => 'Not from scratch. The SEO audit identifies what already works, what needs restructuring (titles, meta, thin content) and what needs adding (new pages, FAQs, structured data).'],
            ],
        ],

        'web-development' => [
            'name' => 'Website + Maintenance',
            'tagline' => 'Tailored websites, structured around your company\'s complexity and goals',
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
            'faq' => [
                ['q' => 'What technologies do you work with?', 'a' => 'Laravel for the backend, Tailwind CSS and Livewire / Alpine for the frontend. Fast, SEO-friendly, easy-to-maintain sites, hosted on shared or VPS hosting.'],
                ['q' => 'How long for a presentation site?', 'a' => '4-8 weeks from brief to live, depending on the number of pages, content and external integrations (forms, payments, APIs).'],
                ['q' => 'Is hosting included?', 'a' => 'No. We recommend hosting matched to the project complexity — we integrate with your existing provider or help you choose one.'],
                ['q' => 'Can I edit the content myself?', 'a' => 'Yes, wherever you need frequent updates we integrate an easy-to-use admin panel. For rare updates, monthly maintenance includes on-demand changes.'],
            ],
        ],

    ],

];
