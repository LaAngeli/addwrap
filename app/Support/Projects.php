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
     * Clienți reali. Câmpurile completate sunt cele verificabile public
     * (nume, domeniu, descriere, link, logo, cuvinte-cheie). `category` este pe
     * 'general' până se confirmă serviciul concret livrat; `metrics` rămân goale
     * până la primirea rezultatelor reale (nu se inventează cifre/citate pentru
     * firme reale). `icon` alege ilustrația copertei; `logo` = fișierul din
     * public/images/partners; `tag`/`keywords` (localizate) = eticheta și
     * cuvintele-cheie de domeniu afișate pe copertă. `hero => false` exclude
     * clientul din showcase-ul interactiv din hero (rămâne în grila de jos).
     *
     * @return array<string, array<string, mixed>>
     */
    private static function projects(): array
    {
        return [

            'optiplaza' => [
                'slug' => 'optiplaza',
                'client' => 'Optiplaza',
                'category' => 'general',
                'icon' => 'optics',
                'logo' => 'optiplaza',
                'year' => '2025',
                'url' => 'https://optiplaza.md/',
                'featured' => true,
                'ro' => [
                    'title' => 'Optiplaza — rețea de optică medicală',
                    'tag' => 'Optică',
                    'keywords' => 'Ochelari · Lentile · Consultații',
                    'excerpt' => 'Rețea de optică din Republica Moldova: ochelari de vedere, lentile și consultații de specialitate.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Despre client'],
                        ['type' => 'paragraph', 'text' => 'Optiplaza este o rețea de optică din Republica Moldova, cu magazine în care clienții găsesc ochelari de vedere, lentile de contact și consultații de specialitate. Brandul îmbină componenta medicală cu partea de retail și modă optică.'],
                    ],
                ],
                'en' => [
                    'title' => 'Optiplaza — optical retail chain',
                    'tag' => 'Optical',
                    'keywords' => 'Eyewear · Lenses · Eye care',
                    'excerpt' => 'Optical retail chain in the Republic of Moldova: prescription eyewear, lenses and specialist eye care.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'About the client'],
                        ['type' => 'paragraph', 'text' => 'Optiplaza is an optical retail chain in the Republic of Moldova, with stores offering prescription glasses, contact lenses and specialist eye consultations. The brand combines the medical side with retail and eyewear fashion.'],
                    ],
                ],
            ],

            'synaptica' => [
                'slug' => 'synaptica',
                'client' => 'Synaptica Cluj',
                'category' => 'general',
                'icon' => 'neuro',
                'logo' => 'synaptica',
                'year' => '2025',
                'url' => 'https://synaptica-cluj.ro/',
                'featured' => true,
                'ro' => [
                    'title' => 'Synaptica — neurofeedback și antrenament cerebral',
                    'tag' => 'Neurofeedback',
                    'keywords' => 'Neurofeedback · EEG · Cognitiv',
                    'excerpt' => 'Clinică de neurofeedback și antrenament cerebral non-invaziv (brainmapping EEG) din Cluj-Napoca.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Despre client'],
                        ['type' => 'paragraph', 'text' => 'Synaptica este o clinică din Cluj-Napoca specializată în neurofeedback și antrenament cerebral non-invaziv, folosind brainmapping EEG și feedback în timp real. Programele sunt personalizate pentru echilibru mental, somn și performanță cognitivă.'],
                    ],
                ],
                'en' => [
                    'title' => 'Synaptica — neurofeedback and brain training',
                    'tag' => 'Neurofeedback',
                    'keywords' => 'Neurofeedback · EEG · Cognitive',
                    'excerpt' => 'Neurofeedback and non-invasive brain-training clinic (EEG brainmapping) in Cluj-Napoca.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'About the client'],
                        ['type' => 'paragraph', 'text' => 'Synaptica is a Cluj-Napoca clinic specialized in neurofeedback and non-invasive brain training, using EEG brainmapping and real-time feedback. Programs are personalized for mental balance, sleep and cognitive performance.'],
                    ],
                ],
            ],

            'pfg-finance' => [
                'slug' => 'pfg-finance',
                'client' => 'PFG Finance',
                'category' => 'general',
                'icon' => 'finance',
                'logo' => 'pfg-finance',
                'year' => '2025',
                'url' => 'https://www.pfgfinance.ro/',
                'featured' => false,
                'ro' => [
                    'title' => 'PFG Finance — soluții de creditare',
                    'tag' => 'Finanțe',
                    'keywords' => 'Credite · Ipotecar · Refinanțări',
                    'excerpt' => 'Broker de credite din Cluj-Napoca: credite ipotecare, de nevoi personale, auto și refinanțări.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Despre client'],
                        ['type' => 'paragraph', 'text' => 'PFG Finance este un broker de credite din Cluj-Napoca care oferă soluții de finanțare: credite ipotecare, de nevoi personale, auto și refinanțări. Firma îmbină consultanța financiară cu educația clienților și conectarea cu profesioniști din domeniu.'],
                    ],
                ],
                'en' => [
                    'title' => 'PFG Finance — credit solutions',
                    'tag' => 'Finance',
                    'keywords' => 'Loans · Mortgage · Refinancing',
                    'excerpt' => 'Credit brokerage in Cluj-Napoca: mortgages, personal and auto loans, and refinancing.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'About the client'],
                        ['type' => 'paragraph', 'text' => 'PFG Finance is a credit brokerage in Cluj-Napoca offering financing solutions: mortgages, personal and auto loans, and refinancing. The firm combines financial advice with client education and connections to related professionals.'],
                    ],
                ],
            ],

            'napoca7' => [
                'slug' => 'napoca7',
                'client' => 'Napoca7',
                'category' => 'general',
                'icon' => 'retail',
                'logo' => 'napoca7',
                'year' => '2025',
                'url' => 'https://napoca7.ro/',
                'featured' => false,
                'ro' => [
                    'title' => 'Napoca7 — retail de încălțăminte și accesorii',
                    'tag' => 'Retail',
                    'keywords' => 'Încălțăminte · Accesorii · Retail',
                    'excerpt' => 'Retailer de încălțăminte și accesorii din Cluj-Napoca, cu magazine fizice și online.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Despre client'],
                        ['type' => 'paragraph', 'text' => 'Napoca7 este un retailer de încălțăminte și accesorii din Cluj-Napoca, prezent în magazine fizice și online, cu zeci de branduri pentru femei, bărbați și copii. Poziționarea mizează pe calitate și prețuri accesibile.'],
                    ],
                ],
                'en' => [
                    'title' => 'Napoca7 — footwear and accessories retail',
                    'tag' => 'Retail',
                    'keywords' => 'Footwear · Accessories · Retail',
                    'excerpt' => 'Footwear and accessories retailer from Cluj-Napoca, with physical and online stores.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'About the client'],
                        ['type' => 'paragraph', 'text' => 'Napoca7 is a footwear and accessories retailer from Cluj-Napoca, present in physical stores and online, with dozens of brands for women, men and children. Its positioning focuses on quality and affordable prices.'],
                    ],
                ],
            ],

            'wolf-electric' => [
                'slug' => 'wolf-electric',
                'client' => 'Wolf Electric',
                'category' => 'general',
                'icon' => 'electric',
                'logo' => 'wolf-electric',
                'year' => '2024',
                'url' => 'https://wolfelectric.ro/',
                'featured' => false,
                'ro' => [
                    'title' => 'Wolf Electric — instalații electrice',
                    'tag' => 'Electric',
                    'keywords' => 'Instalații · Electric · Service',
                    'excerpt' => 'Firmă de instalații și servicii electrice, cu acoperire în Cluj, Florești și Iași.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Despre client'],
                        ['type' => 'paragraph', 'text' => 'Wolf Electric este o firmă de instalații și servicii electrice, cu acoperire în Cluj, Florești și Iași. Echipa gestionează lucrări pentru clienți rezidențiali și de business.'],
                    ],
                ],
                'en' => [
                    'title' => 'Wolf Electric — electrical installations',
                    'tag' => 'Electrical',
                    'keywords' => 'Wiring · Electrical · Service',
                    'excerpt' => 'Electrical installation and services company operating in Cluj, Florești and Iași.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'About the client'],
                        ['type' => 'paragraph', 'text' => 'Wolf Electric is an electrical installation and services company operating in Cluj, Florești and Iași. The team handles projects for both residential and business clients.'],
                    ],
                ],
            ],

            'rgq-consulting' => [
                'slug' => 'rgq-consulting',
                'client' => 'RGQ Consulting',
                'category' => 'general',
                'icon' => 'quality',
                'logo' => 'rgq-consulting',
                'year' => '2024',
                'url' => 'https://rgqconsulting.ro/',
                'featured' => false,
                'ro' => [
                    'title' => 'RGQ Consulting — management al calității',
                    'tag' => 'Calitate',
                    'keywords' => 'ISO 9001 · Lean · Audit',
                    'excerpt' => 'Consultanță în sisteme de management al calității: implementare ISO 9001, Lean și evaluare de risc.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Despre client'],
                        ['type' => 'paragraph', 'text' => 'RGQ Consulting oferă consultanță în sisteme de management al calității și îmbunătățire continuă: implementare ISO 9001, Lean Manufacturing și evaluarea riscurilor operaționale. Firma lucrează cu organizații din producție, servicii și administrație.'],
                    ],
                ],
                'en' => [
                    'title' => 'RGQ Consulting — quality management',
                    'tag' => 'Quality',
                    'keywords' => 'ISO 9001 · Lean · Audit',
                    'excerpt' => 'Quality-management systems consulting: ISO 9001 implementation, Lean and risk assessment.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'About the client'],
                        ['type' => 'paragraph', 'text' => 'RGQ Consulting provides quality-management and continuous-improvement consulting: ISO 9001 implementation, Lean Manufacturing and operational risk assessment. The firm works with organizations across manufacturing, services and administration.'],
                    ],
                ],
            ],

            'smart-integration' => [
                'slug' => 'smart-integration',
                'client' => 'Smart Integration',
                'category' => 'general',
                'icon' => 'integration',
                'logo' => 'smart-integrated-business',
                'year' => '2024',
                'url' => 'https://smartintegration.ro/',
                'featured' => false,
                'ro' => [
                    'title' => 'Smart Integration — consultanță & management de proiect',
                    'tag' => 'Consultanță',
                    'keywords' => 'Consultanță · Proiecte · Software',
                    'excerpt' => 'Expertiză tehnică și management de proiect pentru programe cu finanțare europeană.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Despre client'],
                        ['type' => 'paragraph', 'text' => 'Smart Integration este o firmă de consultanță și expertiză tehnică, cu accent pe management de proiect și soluții software. Lucrează în special cu instituții și programe cu finanțare europeană.'],
                    ],
                ],
                'en' => [
                    'title' => 'Smart Integration — consulting & project management',
                    'tag' => 'Consulting',
                    'keywords' => 'Consulting · Projects · Software',
                    'excerpt' => 'Technical expertise and project management for EU-funded programs.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'About the client'],
                        ['type' => 'paragraph', 'text' => 'Smart Integration is a consulting and technical-expertise firm focused on project management and software solutions. It works mainly with institutions and EU-funded programs.'],
                    ],
                ],
            ],

            'solis' => [
                'slug' => 'solis',
                'client' => 'Solis School of Life',
                'category' => 'general',
                'icon' => 'education',
                'logo' => 'solis',
                'year' => '2024',
                'url' => 'https://solis.school/',
                'featured' => false,
                'ro' => [
                    'title' => 'Solis School of Life — educație alternativă',
                    'tag' => 'Educație',
                    'keywords' => 'Experiențial · Bilingv · Personalizat',
                    'excerpt' => 'Școală alternativă din Cluj: învățare experiențială, bilingvă, cu parcurs personalizat.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Despre client'],
                        ['type' => 'paragraph', 'text' => 'Solis School of Life este o școală alternativă din Cluj, cu învățare experiențială, predare bilingvă și parcurs personalizat pentru fiecare copil. Abordarea pune accent pe educație „cu suflet și înțelepciune".'],
                    ],
                ],
                'en' => [
                    'title' => 'Solis School of Life — alternative education',
                    'tag' => 'Education',
                    'keywords' => 'Experiential · Bilingual · Tailored',
                    'excerpt' => 'Alternative school in Cluj: experiential, bilingual learning with personalized paths.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'About the client'],
                        ['type' => 'paragraph', 'text' => 'Solis School of Life is an alternative school in Cluj, with experiential learning, bilingual teaching and a personalized path for each child. Its approach emphasizes education “with soul and wisdom”.'],
                    ],
                ],
            ],

            'cleaning-pasca' => [
                'slug' => 'cleaning-pasca',
                'client' => 'Cleaning Pasca',
                'category' => 'general',
                'icon' => 'cleaning',
                'logo' => 'cleaning-pasca',
                'year' => '2024',
                'url' => 'https://ecocleaningpasca.ro/',
                'featured' => false,
                'hero' => false,
                'ro' => [
                    'title' => 'Cleaning Pasca — servicii profesionale de curățenie',
                    'tag' => 'Curățenie',
                    'keywords' => 'Birouri · Scări de bloc · Comercial',
                    'excerpt' => 'Firmă de curățenie profesională din Cluj: birouri, scări de bloc, spații comerciale și curățenie după constructor.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'Despre client'],
                        ['type' => 'paragraph', 'text' => 'Cleaning Pasca este o firmă de curățenie profesională din Cluj, cu o gamă variată de servicii pentru afaceri: curățenie de birouri, scări de bloc, spații comerciale, curățenie după constructor, alpinism utilitar, întreținere spațiu verde și servicii DDD (dezinsecție, dezinfecție, deratizare). Firma își asumă calitatea prin contract.'],
                    ],
                ],
                'en' => [
                    'title' => 'Cleaning Pasca — professional cleaning services',
                    'tag' => 'Cleaning',
                    'keywords' => 'Offices · Buildings · Commercial',
                    'excerpt' => 'Professional cleaning company in Cluj: offices, residential buildings, commercial spaces and post-construction cleaning.',
                    'metrics' => [],
                    'blocks' => [
                        ['type' => 'heading', 'text' => 'About the client'],
                        ['type' => 'paragraph', 'text' => 'Cleaning Pasca is a professional cleaning company in Cluj offering a wide range of services for businesses: office cleaning, residential building (stairwell) cleaning, commercial spaces, post-construction cleaning, rope-access work, green-space maintenance and pest-control services. The company backs its quality with contractual guarantees.'],
                    ],
                ],
            ],

        ];
    }
}
