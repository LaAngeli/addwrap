<?php

declare(strict_types=1);

namespace App\Support;

class Projects
{
    /**
     * Toate studiile de caz, ordonate descrescător după an.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function published(): array
    {
        $projects = self::projects();
        uasort($projects, fn (array $a, array $b): int => strcmp($b['year'], $a['year']));

        return $projects;
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function find(string $slug): ?array
    {
        return self::projects()[$slug] ?? null;
    }

    /**
     * Conținutul localizat al unui proiect (cu fallback pe limba implicită).
     *
     * @param  array<string, mixed>  $project
     * @return array<string, mixed>
     */
    public static function content(array $project, ?string $locale = null): array
    {
        $locale ??= app()->getLocale();

        return $project[$locale] ?? $project[config('site.default_locale', 'ro')] ?? [];
    }

    /**
     * Alte proiecte, fără cel curent.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function others(string $slug, int $limit = 3): array
    {
        $others = array_filter(
            self::published(),
            fn (string $key): bool => $key !== $slug,
            ARRAY_FILTER_USE_KEY
        );

        return array_slice($others, 0, $limit, true);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private static function projects(): array
    {
        return [

            'nordica-ecommerce' => [
                'slug' => 'nordica-ecommerce',
                'client' => 'Nordica',
                'category' => 'web',
                'year' => '2025',
                'featured' => true,
                'ro' => [
                    'title' => 'Magazin online relansat: site nou plus SEO',
                    'excerpt' => 'Am reconstruit de la zero magazinul online al unui retailer de mobilier și am inclus crearea site-ului în mentenanța lunară, fără investiție mare la start.',
                    'metrics' => [
                        ['value' => '+150%', 'label' => 'trafic organic în 6 luni'],
                        ['value' => '2,3x', 'label' => 'rată de conversie'],
                        ['value' => '-35%', 'label' => 'cost per comandă'],
                    ],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Provocarea'],
                        ['type' => 'paragraph', 'text' => 'Site-ul vechi era lent, greu de administrat și aproape invizibil în Google. Clientul pierdea comenzi din cauza timpului mare de încărcare și a unei structuri confuze pentru utilizatori.'],
                        ['type' => 'heading', 'text' => 'Abordarea'],
                        ['type' => 'list', 'items' => [
                            'Site nou, rapid și ușor de administrat, optimizat pentru mobil.',
                            'Implementare SEO tehnic și on-page, cu date structurate.',
                            'Crearea site-ului inclusă în mentenanța lunară.',
                        ]],
                        ['type' => 'heading', 'text' => 'Rezultate'],
                        ['type' => 'paragraph', 'text' => 'În șase luni, traficul organic a crescut cu 150%, iar rata de conversie s-a mai mult decât dublat. Costul per comandă a scăzut cu 35% datorită vitezei și unei experiențe mai clare.'],
                        ['type' => 'quote', 'text' => 'Pentru prima dată simțim că site-ul lucrează pentru noi, nu împotriva noastră.', 'author' => 'Director general, Nordica'],
                    ],
                ],
                'en' => [
                    'title' => 'Online store relaunched: new website plus SEO',
                    'excerpt' => 'We rebuilt a furniture retailer online store from scratch and included the website creation in the monthly maintenance, with no large upfront cost.',
                    'metrics' => [
                        ['value' => '+150%', 'label' => 'organic traffic in 6 months'],
                        ['value' => '2.3x', 'label' => 'conversion rate'],
                        ['value' => '-35%', 'label' => 'cost per order'],
                    ],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'The challenge'],
                        ['type' => 'paragraph', 'text' => 'The old site was slow, hard to manage and almost invisible in Google. The client was losing orders due to long load times and a confusing structure for users.'],
                        ['type' => 'heading', 'text' => 'The approach'],
                        ['type' => 'list', 'items' => [
                            'A new, fast and easy-to-manage website, optimized for mobile.',
                            'Technical and on-page SEO implementation, with structured data.',
                            'Website creation included in the monthly maintenance.',
                        ]],
                        ['type' => 'heading', 'text' => 'Results'],
                        ['type' => 'paragraph', 'text' => 'In six months, organic traffic grew by 150% and the conversion rate more than doubled. Cost per order dropped by 35% thanks to speed and a clearer experience.'],
                        ['type' => 'quote', 'text' => 'For the first time it feels like the website is working for us, not against us.', 'author' => 'CEO, Nordica'],
                    ],
                ],
            ],

            'vitalis-google-ads' => [
                'slug' => 'vitalis-google-ads',
                'client' => 'Vitalis',
                'category' => 'ads',
                'year' => '2025',
                'featured' => false,
                'ro' => [
                    'title' => 'Scalare Google Ads pentru o clinică medicală',
                    'excerpt' => 'Am restructurat campaniile Google Ads ale unei clinici și am crescut numărul de programări, reducând în același timp costul per pacient nou.',
                    'metrics' => [
                        ['value' => '4,1x', 'label' => 'randament al investiției'],
                        ['value' => '+60%', 'label' => 'programări online'],
                        ['value' => '-28%', 'label' => 'cost per programare'],
                    ],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Provocarea'],
                        ['type' => 'paragraph', 'text' => 'Bugetul de publicitate se consuma pe cuvinte cheie prea generale, iar pacienții potriviți ajungeau greu la clinică. Lipsea o structură clară și o măsurare corectă a conversiilor.'],
                        ['type' => 'heading', 'text' => 'Abordarea'],
                        ['type' => 'list', 'items' => [
                            'Audit de cont și restructurare pe servicii medicale concrete.',
                            'Cuvinte cheie cu intenție mare și anunțuri relevante.',
                            'Configurare corectă a conversiilor și optimizare săptămânală.',
                        ]],
                        ['type' => 'heading', 'text' => 'Rezultate'],
                        ['type' => 'paragraph', 'text' => 'Programările online au crescut cu 60%, iar costul per programare a scăzut cu 28%. Fiecare leu investit a adus de peste patru ori valoare în programări.'],
                        ['type' => 'quote', 'text' => 'Acum știm exact ce campanie ne aduce pacienți și cât ne costă fiecare.', 'author' => 'Manager marketing, Vitalis'],
                    ],
                ],
                'en' => [
                    'title' => 'Scaling Google Ads for a medical clinic',
                    'excerpt' => 'We restructured a clinic Google Ads campaigns and increased bookings while lowering the cost per new patient.',
                    'metrics' => [
                        ['value' => '4.1x', 'label' => 'return on ad spend'],
                        ['value' => '+60%', 'label' => 'online bookings'],
                        ['value' => '-28%', 'label' => 'cost per booking'],
                    ],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'The challenge'],
                        ['type' => 'paragraph', 'text' => 'The ad budget was spent on overly broad keywords, and the right patients struggled to reach the clinic. There was no clear structure and no proper conversion tracking.'],
                        ['type' => 'heading', 'text' => 'The approach'],
                        ['type' => 'list', 'items' => [
                            'Account audit and restructuring around concrete medical services.',
                            'High-intent keywords and relevant ads.',
                            'Proper conversion setup and weekly optimization.',
                        ]],
                        ['type' => 'heading', 'text' => 'Results'],
                        ['type' => 'paragraph', 'text' => 'Online bookings grew by 60% and the cost per booking dropped by 28%. Every euro invested returned more than four times its value in bookings.'],
                        ['type' => 'quote', 'text' => 'Now we know exactly which campaign brings patients and how much each one costs.', 'author' => 'Marketing manager, Vitalis'],
                    ],
                ],
            ],

            'lumio-rebranding' => [
                'slug' => 'lumio-rebranding',
                'client' => 'Lumio',
                'category' => 'branding',
                'year' => '2024',
                'featured' => false,
                'ro' => [
                    'title' => 'Rebranding complet pentru un startup tech',
                    'excerpt' => 'Am construit de la zero identitatea vizuală a unui startup, de la logo și paletă până la ghidul de brand și vizualizări.',
                    'metrics' => [
                        ['value' => '3 luni', 'label' => 'de la concept la lansare'],
                        ['value' => '10', 'label' => 'vizualizări finale'],
                        ['value' => '1', 'label' => 'sistem de brand coerent'],
                    ],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Provocarea'],
                        ['type' => 'paragraph', 'text' => 'Startup-ul avea un produs bun, dar o imagine improvizată care nu inspira încredere investitorilor și clienților. Aveau nevoie de o identitate care să arate matur și consecvent.'],
                        ['type' => 'heading', 'text' => 'Abordarea'],
                        ['type' => 'list', 'items' => [
                            'Strategie și poziționare de brand, ton al vocii.',
                            'Logo, paletă, fonturi și set de pattern-uri.',
                            'Ghid de brand și set complet de vizualizări.',
                        ]],
                        ['type' => 'heading', 'text' => 'Rezultate'],
                        ['type' => 'paragraph', 'text' => 'În trei luni, brandul a primit o identitate completă și coerentă, aplicată pe toate materialele. Echipa lucrează acum rapid, fără să reinventeze stilul la fiecare proiect.'],
                        ['type' => 'quote', 'text' => 'Brandbook-ul ne-a dat încredere să ieșim în față. Arătăm exact cum ne dorim.', 'author' => 'Co-fondator, Lumio'],
                    ],
                ],
                'en' => [
                    'title' => 'Complete rebranding for a tech startup',
                    'excerpt' => 'We built a startup visual identity from scratch, from logo and palette to the brand guide and mockups.',
                    'metrics' => [
                        ['value' => '3 months', 'label' => 'from concept to launch'],
                        ['value' => '10', 'label' => 'final mockups'],
                        ['value' => '1', 'label' => 'coherent brand system'],
                    ],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'The challenge'],
                        ['type' => 'paragraph', 'text' => 'The startup had a good product but an improvised image that did not inspire trust in investors and customers. They needed an identity that looked mature and consistent.'],
                        ['type' => 'heading', 'text' => 'The approach'],
                        ['type' => 'list', 'items' => [
                            'Brand strategy and positioning, tone of voice.',
                            'Logo, palette, fonts and a set of patterns.',
                            'Brand guide and a complete set of mockups.',
                        ]],
                        ['type' => 'heading', 'text' => 'Results'],
                        ['type' => 'paragraph', 'text' => 'In three months, the brand received a complete and coherent identity, applied across all materials. The team now works fast, without reinventing the style on every project.'],
                        ['type' => 'quote', 'text' => 'The brandbook gave us the confidence to step forward. We look exactly how we want.', 'author' => 'Co-founder, Lumio'],
                    ],
                ],
            ],

            'terra-content' => [
                'slug' => 'terra-content',
                'client' => 'Terra Verde',
                'category' => 'content',
                'year' => '2024',
                'featured' => false,
                'ro' => [
                    'title' => 'Strategie de conținut care a triplat reach-ul',
                    'excerpt' => 'Am construit un plan de conținut pe 12 luni pentru un brand de produse eco și am transformat o pagină tăcută într-un canal care aduce clienți.',
                    'metrics' => [
                        ['value' => '3x', 'label' => 'reach organic'],
                        ['value' => '+220%', 'label' => 'engagement'],
                        ['value' => '12', 'label' => 'scenarii / lună'],
                    ],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Provocarea'],
                        ['type' => 'paragraph', 'text' => 'Brandul posta rar și fără direcție. Conținutul nu reflecta valorile eco ale companiei și nu genera nicio reacție din partea publicului.'],
                        ['type' => 'heading', 'text' => 'Abordarea'],
                        ['type' => 'list', 'items' => [
                            'Strategie de conținut cu obiective clare și public țintă definit.',
                            'Calendar editorial și scenarii lunare pe teme relevante.',
                            'Monitorizare lunară și ajustare în funcție de rezultate.',
                        ]],
                        ['type' => 'heading', 'text' => 'Rezultate'],
                        ['type' => 'paragraph', 'text' => 'Reach-ul organic s-a triplat, iar engagement-ul a crescut cu 220%. Comunitatea a început să interacționeze și să recomande brandul, nu doar să îl urmărească.'],
                        ['type' => 'quote', 'text' => 'În sfârșit avem o voce. Oamenii ne scriu și ne recomandă prietenilor.', 'author' => 'Fondatoare, Terra Verde'],
                    ],
                ],
                'en' => [
                    'title' => 'Content strategy that tripled reach',
                    'excerpt' => 'We built a 12-month content plan for an eco products brand and turned a silent page into a channel that brings customers.',
                    'metrics' => [
                        ['value' => '3x', 'label' => 'organic reach'],
                        ['value' => '+220%', 'label' => 'engagement'],
                        ['value' => '12', 'label' => 'scenarios / month'],
                    ],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'The challenge'],
                        ['type' => 'paragraph', 'text' => 'The brand posted rarely and without direction. The content did not reflect the company eco values and generated no reaction from the audience.'],
                        ['type' => 'heading', 'text' => 'The approach'],
                        ['type' => 'list', 'items' => [
                            'Content strategy with clear goals and a defined target audience.',
                            'Editorial calendar and monthly scenarios on relevant topics.',
                            'Monthly monitoring and adjustment based on results.',
                        ]],
                        ['type' => 'heading', 'text' => 'Results'],
                        ['type' => 'paragraph', 'text' => 'Organic reach tripled and engagement grew by 220%. The community started interacting and recommending the brand, not just following it.'],
                        ['type' => 'quote', 'text' => 'We finally have a voice. People message us and recommend us to friends.', 'author' => 'Founder, Terra Verde'],
                    ],
                ],
            ],

            'autopro-seo-local' => [
                'slug' => 'autopro-seo-local',
                'client' => 'AutoPro',
                'category' => 'seo',
                'year' => '2024',
                'featured' => false,
                'ro' => [
                    'title' => 'Pe locul 1 în Google pentru un service auto local',
                    'excerpt' => 'Am dus un service auto pe prima poziție în căutările locale și am transformat căutările de pe telefon în programări reale.',
                    'metrics' => [
                        ['value' => '#1', 'label' => 'în căutările locale'],
                        ['value' => '+180%', 'label' => 'apeluri telefonice'],
                        ['value' => '+90%', 'label' => 'trafic pe site'],
                    ],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Provocarea'],
                        ['type' => 'paragraph', 'text' => 'Service-ul era invizibil în căutările locale, deși avea recenzii excelente. Clienții din zonă ajungeau la concurență pentru că nu îl găseau pe Google sau pe hartă.'],
                        ['type' => 'heading', 'text' => 'Abordarea'],
                        ['type' => 'list', 'items' => [
                            'Optimizare SEO local și profil Google Business complet.',
                            'Pagini de serviciu optimizate pe intenții locale.',
                            'Date structurate și monitorizare a pozițiilor.',
                        ]],
                        ['type' => 'heading', 'text' => 'Rezultate'],
                        ['type' => 'paragraph', 'text' => 'Service-ul a ajuns pe prima poziție în căutările locale relevante, iar apelurile telefonice au crescut cu 180%. Vizibilitatea s-a transformat direct în programări.'],
                        ['type' => 'quote', 'text' => 'Acum clienții ne sună după ce ne găsesc pe Google. Nu mai depindem de noroc.', 'author' => 'Proprietar, AutoPro'],
                    ],
                ],
                'en' => [
                    'title' => 'Ranked #1 on Google for a local auto service',
                    'excerpt' => 'We took an auto service to the top spot in local search and turned phone searches into real bookings.',
                    'metrics' => [
                        ['value' => '#1', 'label' => 'in local search'],
                        ['value' => '+180%', 'label' => 'phone calls'],
                        ['value' => '+90%', 'label' => 'website traffic'],
                    ],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'The challenge'],
                        ['type' => 'paragraph', 'text' => 'The service was invisible in local search, despite excellent reviews. Nearby customers ended up at competitors because they could not find it on Google or the map.'],
                        ['type' => 'heading', 'text' => 'The approach'],
                        ['type' => 'list', 'items' => [
                            'Local SEO optimization and a complete Google Business profile.',
                            'Service pages optimized for local intent.',
                            'Structured data and ranking monitoring.',
                        ]],
                        ['type' => 'heading', 'text' => 'Results'],
                        ['type' => 'paragraph', 'text' => 'The service reached the top spot in relevant local searches, and phone calls grew by 180%. Visibility translated directly into bookings.'],
                        ['type' => 'quote', 'text' => 'Now customers call us after finding us on Google. We no longer rely on luck.', 'author' => 'Owner, AutoPro'],
                    ],
                ],
            ],

            'casabuna-strategie' => [
                'slug' => 'casabuna-strategie',
                'client' => 'Casa Bună',
                'category' => 'strategy',
                'year' => '2023',
                'featured' => false,
                'ro' => [
                    'title' => 'Plan de marketing integrat pentru un retailer',
                    'excerpt' => 'Am unit branding, conținut, publicitate și web într-o singură strategie coerentă pentru un retailer de produse pentru casă.',
                    'metrics' => [
                        ['value' => '+45%', 'label' => 'vânzări într-un an'],
                        ['value' => '4', 'label' => 'canale integrate'],
                        ['value' => '1', 'label' => 'strategie unitară'],
                    ],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Provocarea'],
                        ['type' => 'paragraph', 'text' => 'Retailerul lucra cu mai mulți furnizori separați, iar mesajele erau inconsistente. Lipsea o direcție unică, ceea ce ducea la efort dublu și rezultate slabe.'],
                        ['type' => 'heading', 'text' => 'Abordarea'],
                        ['type' => 'list', 'items' => [
                            'Strategie integrată cu obiective comune pe toate canalele.',
                            'Branding consecvent, conținut planificat și campanii corelate.',
                            'Raportare lunară și optimizare continuă.',
                        ]],
                        ['type' => 'heading', 'text' => 'Rezultate'],
                        ['type' => 'paragraph', 'text' => 'Într-un an, vânzările au crescut cu 45%, iar brandul a căpătat o voce unitară pe toate canalele. Efortul de marketing a devenit un sistem, nu o serie de acțiuni izolate.'],
                        ['type' => 'quote', 'text' => 'Pentru prima dată totul trage în aceeași direcție. Vedem rezultatele lună de lună.', 'author' => 'Director, Casa Bună'],
                    ],
                ],
                'en' => [
                    'title' => 'Integrated marketing plan for a retailer',
                    'excerpt' => 'We united branding, content, advertising and web into a single coherent strategy for a home goods retailer.',
                    'metrics' => [
                        ['value' => '+45%', 'label' => 'sales in one year'],
                        ['value' => '4', 'label' => 'integrated channels'],
                        ['value' => '1', 'label' => 'unified strategy'],
                    ],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'The challenge'],
                        ['type' => 'paragraph', 'text' => 'The retailer worked with several separate vendors, and the messaging was inconsistent. There was no single direction, which led to double effort and weak results.'],
                        ['type' => 'heading', 'text' => 'The approach'],
                        ['type' => 'list', 'items' => [
                            'Integrated strategy with shared goals across all channels.',
                            'Consistent branding, planned content and correlated campaigns.',
                            'Monthly reporting and continuous optimization.',
                        ]],
                        ['type' => 'heading', 'text' => 'Results'],
                        ['type' => 'paragraph', 'text' => 'In one year, sales grew by 45% and the brand gained a unified voice across all channels. Marketing became a system, not a series of isolated actions.'],
                        ['type' => 'quote', 'text' => 'For the first time everything pulls in the same direction. We see results month after month.', 'author' => 'Director, Casa Buna'],
                    ],
                ],
            ],

        ];
    }
}
