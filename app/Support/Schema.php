<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Builder de noduri JSON-LD (Schema.org) pentru un singur graf `@graph`.
 *
 * Fiecare metodă întoarce un nod fără `@context` (acesta e pus o singură dată
 * la rădăcina grafului, în Seo::jsonLd()). Nodurile se leagă între ele prin
 * `@id`, ceea ce dă motoarelor de căutare și asistenților AI o hartă coerentă a
 * entităților (Organization, WebSite, WebPage, Breadcrumb, conținut) — baza
 * solidă pentru AEO/GEO.
 */
class Schema
{
    public static function organizationId(): string
    {
        return Localization::route('home').'#organization';
    }

    public static function websiteId(): string
    {
        return Localization::route('home').'#website';
    }

    public static function webPageId(): string
    {
        return url()->current().'#webpage';
    }

    public static function breadcrumbId(): string
    {
        return url()->current().'#breadcrumb';
    }

    /**
     * Entitatea firmei (nod global, referit prin @id din celelalte noduri).
     *
     * @return array<string, mixed>
     */
    public static function organization(): array
    {
        $company = (array) config('site.company');
        $social = (array) ($company['social'] ?? []);
        $profile = (array) config('site.organization', []);

        return array_filter([
            '@type' => 'Organization',
            '@id' => self::organizationId(),
            'name' => $company['name'] ?? null,
            'url' => Localization::route('home'),
            'logo' => config('site.logo') ? [
                '@type' => 'ImageObject',
                'url' => asset(config('site.logo')),
            ] : null,
            'email' => $company['email'] ?? null,
            'telephone' => $company['phone'] ?? null,
            'description' => (string) trans('seo.default.description'),
            'foundingDate' => $profile['founding_date'] ?? null,
            'areaServed' => ['@type' => 'Country', 'name' => 'Romania'],
            'knowsAbout' => $profile['knows_about'] ?? null,
            'contactPoint' => self::organizationContactPoint($company),
            'hasOfferCatalog' => self::organizationOfferCatalog(),
            'sameAs' => array_values(array_filter([
                $social['facebook'] ?? null,
                $social['instagram'] ?? null,
            ])),
        ], static fn ($value): bool => $value !== null && $value !== [] && $value !== '');
    }

    /**
     * ContactPoint formal pentru Organization — canalul oficial către
     * customer service (telefon + email + limbile suportate).
     *
     * @param  array<string, mixed>  $company
     * @return array<string, mixed>|null
     */
    private static function organizationContactPoint(array $company): ?array
    {
        if (empty($company['email']) && empty($company['phone'])) {
            return null;
        }

        return array_filter([
            '@type' => 'ContactPoint',
            'contactType' => 'customer service',
            'telephone' => $company['phone'] ?? null,
            'email' => $company['email'] ?? null,
            'availableLanguage' => ['Romanian', 'English'],
            'areaServed' => 'RO',
        ], static fn ($value): bool => $value !== null && $value !== '' && $value !== []);
    }

    /**
     * OfferCatalog cu inventarul de servicii — referit din Organization.
     * Fiecare item e un Service stub cu @id care leagă graful la nodul Service
     * complet emis pe pagina dedicată (`/servicii/{slug}#service`).
     *
     * @return array<string, mixed>|null
     */
    private static function organizationOfferCatalog(): ?array
    {
        $services = Localization::services();

        if (empty($services)) {
            return null;
        }

        return [
            '@type' => 'OfferCatalog',
            '@id' => Localization::route('home').'#offer-catalog',
            'name' => (string) trans('seo.services_index.title'),
            'itemListElement' => array_map(static function (string $key): array {
                return [
                    '@type' => 'Offer',
                    'itemOffered' => array_filter([
                        '@type' => 'Service',
                        '@id' => Localization::serviceUrl($key).'#service',
                        'name' => (string) trans('services.items.'.$key.'.name'),
                        'description' => (string) trans('services.items.'.$key.'.excerpt'),
                        'url' => Localization::serviceUrl($key),
                    ], static fn ($value): bool => $value !== null && $value !== ''),
                ];
            }, array_keys($services)),
        ];
    }

    /**
     * Entitatea site-ului.
     *
     * @return array<string, mixed>
     */
    public static function website(): array
    {
        return [
            '@type' => 'WebSite',
            '@id' => self::websiteId(),
            'url' => Localization::route('home'),
            'name' => config('site.company.name'),
            'inLanguage' => app()->getLocale(),
            'publisher' => ['@id' => self::organizationId()],
        ];
    }

    /**
     * Pagina curentă, legată de site, breadcrumb și imaginea principală.
     *
     * @return array<string, mixed>
     */
    public static function webPage(string $title, string $description, ?string $image, bool $hasBreadcrumb): array
    {
        return array_filter([
            '@type' => 'WebPage',
            '@id' => self::webPageId(),
            'url' => url()->current(),
            'name' => $title,
            'description' => $description,
            'isPartOf' => ['@id' => self::websiteId()],
            'inLanguage' => app()->getLocale(),
            'primaryImageOfPage' => $image ? ['@type' => 'ImageObject', 'url' => $image] : null,
            'breadcrumb' => $hasBreadcrumb ? ['@id' => self::breadcrumbId()] : null,
        ], static fn ($value): bool => $value !== null);
    }

    /**
     * Firul Ariadnei (breadcrumb).
     *
     * @param  array<int, array{name: string, url: string}>  $items
     * @return array<string, mixed>
     */
    public static function breadcrumb(array $items): array
    {
        return [
            '@type' => 'BreadcrumbList',
            '@id' => self::breadcrumbId(),
            'itemListElement' => array_map(static function (array $item, int $index): array {
                return [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $item['name'],
                    'item' => $item['url'],
                ];
            }, $items, array_keys($items)),
        ];
    }

    /**
     * Un serviciu oferit, opțional cu un nod Offer (preț + monedă) atașat
     * pentru rich snippets de preț în SERP.
     *
     * @param  array<string, mixed>  $items  Textele serviciului din services.items.{key}
     * @return array<string, mixed>
     */
    public static function service(string $key, array $items): array
    {
        $service = array_filter([
            '@type' => 'Service',
            '@id' => url()->current().'#service',
            'name' => $items['name'] ?? $key,
            'serviceType' => $items['name'] ?? $key,
            'description' => $items['description'] ?? ($items['excerpt'] ?? ''),
            'url' => Localization::serviceUrl($key),
            'provider' => ['@id' => self::organizationId()],
            'areaServed' => ['@type' => 'Country', 'name' => 'Romania'],
            'mainEntityOfPage' => ['@id' => self::webPageId()],
        ], static fn ($value): bool => $value !== null && $value !== '');

        $offer = self::serviceOffer($key, $items['price'] ?? null);
        if ($offer !== null) {
            $service['offers'] = $offer;
        }

        return $service;
    }

    /**
     * Construiește nodul Offer pentru un serviciu, parsând prețul din string
     * (acceptă formate „3.000 €", „400 €", „de la 300 €"). Returnează null
     * dacă nu există un preț parseabil.
     *
     * @param  array<string, mixed>|null  $price
     * @return array<string, mixed>|null
     */
    private static function serviceOffer(string $key, ?array $price): ?array
    {
        if ($price === null || empty($price['amount'])) {
            return null;
        }

        $value = self::parsePriceAmount((string) $price['amount']);
        if ($value === null) {
            return null;
        }

        return array_filter([
            '@type' => 'Offer',
            'price' => $value,
            'priceCurrency' => 'EUR',
            'availability' => 'https://schema.org/InStock',
            'url' => Localization::serviceUrl($key),
            'priceSpecification' => array_filter([
                '@type' => 'UnitPriceSpecification',
                'price' => $value,
                'priceCurrency' => 'EUR',
                'referenceQuantity' => isset($price['frequency']) ? [
                    '@type' => 'QuantitativeValue',
                    'unitText' => trim((string) $price['frequency'], '/ '),
                ] : null,
            ], static fn ($value): bool => $value !== null && $value !== '' && $value !== []),
        ], static fn ($value): bool => $value !== null && $value !== '' && $value !== []);
    }

    /**
     * Parsează prima secvență numerică dintr-un string de preț localizat
     * („400 €", „de la 3.000 €", „+ 150–200 €", „50 €/oră").
     * - „." e tratat ca separator de mii (3.000 → 3000).
     * - „," rămas devine separator zecimal (1,5 → 1.5).
     * - „preț la cerere" / orice fără cifre → null.
     *
     * Pentru intervale (150–200) și „de la X", returnează valoarea de start.
     */
    private static function parsePriceAmount(string $str): ?float
    {
        if (! preg_match('/(\d[\d.,]*)/', $str, $match)) {
            return null;
        }

        $numeric = str_replace('.', '', $match[1]);
        $numeric = str_replace(',', '.', $numeric);
        $value = (float) $numeric;

        return $value > 0 ? $value : null;
    }

    /**
     * Un articol de blog.
     *
     * @param  array<string, mixed>  $post  Meta articolului (date, author etc.)
     * @param  array<string, mixed>  $content  Conținutul localizat (title, excerpt)
     * @return array<string, mixed>
     */
    public static function article(array $post, array $content, ?string $image): array
    {
        return array_filter([
            '@type' => 'BlogPosting',
            '@id' => url()->current().'#article',
            'headline' => $content['title'] ?? '',
            'description' => $content['excerpt'] ?? '',
            'datePublished' => $post['date'] ?? null,
            'dateModified' => $post['date'] ?? null,
            'inLanguage' => app()->getLocale(),
            'image' => $image ? ['@type' => 'ImageObject', 'url' => $image] : null,
            'mainEntityOfPage' => ['@id' => self::webPageId()],
            'author' => self::articleAuthor($post),
            'publisher' => ['@id' => self::organizationId()],
            'articleSection' => self::articleSection($post),
            'keywords' => self::articleKeywords($post),
            'wordCount' => self::articleWordCount($content),
        ], static fn ($value): bool => $value !== null && $value !== '');
    }

    /**
     * Eticheta de categorie tradusă (din `blog.categories.*`), folosită ca
     * `articleSection` — semnal tematic suplimentar pentru AI/Google.
     *
     * @param  array<string, mixed>  $post
     */
    private static function articleSection(array $post): ?string
    {
        $category = (string) ($post['category'] ?? '');

        if ($category === '' || ! \Illuminate\Support\Facades\Lang::has("blog.categories.{$category}")) {
            return null;
        }

        return (string) trans("blog.categories.{$category}");
    }

    /**
     * Cuvinte cheie comma-separated: eticheta categoriei + (dacă există o
     * mapare în `site.blog_category_service`) numele serviciului asociat.
     * Reutilizează aceeași sursă de adevăr ca internal linking-ul din
     * blog-show, deci rămâne sincronizat dacă se schimbă mapping-ul.
     *
     * @param  array<string, mixed>  $post
     */
    private static function articleKeywords(array $post): ?string
    {
        $category = (string) ($post['category'] ?? '');
        $terms = array_filter([self::articleSection($post)]);

        $serviceKey = config("site.blog_category_service.{$category}");
        if (is_string($serviceKey) && \Illuminate\Support\Facades\Lang::has("services.items.{$serviceKey}.name")) {
            $terms[] = (string) trans("services.items.{$serviceKey}.name");
        }

        return ! empty($terms) ? implode(', ', $terms) : null;
    }

    /**
     * Numără cuvintele din conținutul real al articolului (paragrafe,
     * titluri, citate, iteme de listă), ignorând markup-ul de bloc.
     *
     * @param  array<string, mixed>  $content
     */
    private static function articleWordCount(array $content): ?int
    {
        $blocks = (array) ($content['blocks'] ?? []);
        $text = '';

        foreach ($blocks as $block) {
            if (isset($block['text'])) {
                $text .= ' '.$block['text'];
            }
            if (isset($block['items']) && is_array($block['items'])) {
                $text .= ' '.implode(' ', $block['items']);
            }
        }

        $text = trim($text);
        if ($text === '') {
            return null;
        }

        $words = preg_split('/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY);

        return $words !== false ? count($words) : null;
    }

    /**
     * Decide ce să trimită ca `author` pe un articol:
     * - dacă semnătura e generică („Echipa AddWrap"), referim Organization
     *   prin @id (corect semantic, evită un Person fake);
     * - dacă apare o persoană reală, emitem Person cu @id stabil sub /despre,
     *   astfel încât articolele aceluiași autor să se grupeze în graf.
     *
     * @param  array<string, mixed>  $post
     * @return array<string, mixed>
     */
    private static function articleAuthor(array $post): array
    {
        $name = trim((string) ($post['author'] ?? ''));

        // Semnături colective — autor = Organization.
        $teamSignatures = ['Echipa AddWrap', 'The AddWrap team', 'AddWrap', ''];
        if (in_array($name, $teamSignatures, true)) {
            return ['@id' => self::organizationId()];
        }

        // Autor individual — Person cu @id stabil bazat pe slug-ul numelui.
        return [
            '@type' => 'Person',
            '@id' => Localization::route('about').'#author-'.\Illuminate\Support\Str::slug($name),
            'name' => $name,
            'worksFor' => ['@id' => self::organizationId()],
        ];
    }

    /**
     * Un studiu de caz din portofoliu.
     *
     * @param  array<string, mixed>  $project  Meta proiectului (client, year etc.)
     * @param  array<string, mixed>  $content  Conținutul localizat (title, excerpt)
     * @return array<string, mixed>
     */
    public static function caseStudy(array $project, array $content): array
    {
        return array_filter([
            '@type' => 'CreativeWork',
            '@id' => url()->current().'#case-study',
            'name' => $content['title'] ?? '',
            'abstract' => $content['excerpt'] ?? '',
            'inLanguage' => app()->getLocale(),
            'datePublished' => $project['year'] ?? null,
            'mainEntityOfPage' => ['@id' => self::webPageId()],
            'about' => isset($project['client'])
                ? ['@type' => 'Organization', 'name' => $project['client']]
                : null,
            'creator' => ['@id' => self::organizationId()],
        ], static fn ($value): bool => $value !== null && $value !== '');
    }

    /**
     * Pagina de întrebări frecvente (AEO: răspunsuri directe pentru AI/Google).
     *
     * @param  array<int, array{question: string, answer: string}>  $qas
     * @return array<string, mixed>
     */
    public static function faqPage(array $qas): array
    {
        return [
            '@type' => 'FAQPage',
            '@id' => url()->current().'#faq',
            'mainEntity' => array_map(static function (array $qa): array {
                return [
                    '@type' => 'Question',
                    'name' => $qa['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $qa['answer'],
                    ],
                ];
            }, $qas),
        ];
    }

    /**
     * Listă ordonată de articole / proiecte / orice pe o pagină-inventar.
     * Ajută AI și Google să înțeleagă rapid ce conținut conține pagina.
     *
     * @param  array<int, array{url: string, name: string}>  $items
     * @return array<string, mixed>
     */
    public static function itemList(string $name, array $items): array
    {
        return [
            '@type' => 'ItemList',
            '@id' => url()->current().'#itemlist',
            'name' => $name,
            'numberOfItems' => count($items),
            'itemListElement' => array_map(static function (array $item, int $index): array {
                return [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'url' => $item['url'],
                    'name' => $item['name'],
                ];
            }, $items, array_keys($items)),
        ];
    }

    /**
     * Set de termeni definiți (DefinedTermSet + DefinedTerm), util pentru
     * glosare scurte și paginile care explică acronime/concepte (SEO/AEO/GEO).
     *
     * @param  array<int, array{term: string, description: string}>  $terms
     * @return array<string, mixed>
     */
    public static function definedTermSet(string $name, array $terms): array
    {
        $setId = url()->current().'#terms';

        return [
            '@type' => 'DefinedTermSet',
            '@id' => $setId,
            'name' => $name,
            'inDefinedTermSet' => $setId,
            'hasDefinedTerm' => array_map(static function (array $t) use ($setId): array {
                return [
                    '@type' => 'DefinedTerm',
                    'name' => $t['term'],
                    'description' => $t['description'],
                    'inDefinedTermSet' => $setId,
                ];
            }, $terms),
        ];
    }

    /**
     * OfferCatalog pentru tabelul complet de prețuri (un Offer per rând).
     * Pe pagina /preturi expune toate liniile de preț grupate pe categorii,
     * astfel încât Bing și asistenții AI să poată cita prețuri individuale.
     *
     * @param  array<int, array{title?: string, rows?: array<int, array{service?: string, price?: string}>}>  $groups
     * @return array<string, mixed>
     */
    public static function priceList(string $name, array $groups): array
    {
        $items = [];
        $position = 1;

        foreach ($groups as $group) {
            $category = (string) ($group['title'] ?? '');
            foreach ((array) ($group['rows'] ?? []) as $row) {
                $rawPrice = (string) ($row['price'] ?? '');
                $priceValue = self::parsePriceAmount($rawPrice);

                $items[] = array_filter([
                    '@type' => 'Offer',
                    'position' => $position++,
                    'name' => (string) ($row['service'] ?? ''),
                    'category' => $category !== '' ? $category : null,
                    'priceCurrency' => 'EUR',
                    'price' => $priceValue,
                    // Dacă rândul nu are valoare numerică („preț la cerere"),
                    // păstrăm eticheta originală ca description pentru context.
                    'description' => $priceValue === null && $rawPrice !== '' ? $rawPrice : null,
                ], static fn ($v): bool => $v !== null && $v !== '');
            }
        }

        return [
            '@type' => 'OfferCatalog',
            '@id' => url()->current().'#price-list',
            'name' => $name,
            'numberOfItems' => count($items),
            'itemListElement' => $items,
        ];
    }

    /**
     * Schema HowTo pentru articolele structurate ca pași/decizii. Acceptă
     * etape ordonate cu titlu + text; Google poate afișa rich snippet HowTo.
     *
     * @param  array<int, array{name: string, text: string}>  $steps
     * @return array<string, mixed>
     */
    public static function howTo(string $name, string $description, array $steps): array
    {
        return array_filter([
            '@type' => 'HowTo',
            '@id' => url()->current().'#howto',
            'name' => $name,
            'description' => $description,
            'inLanguage' => app()->getLocale(),
            'step' => array_map(static function (array $step, int $index): array {
                return [
                    '@type' => 'HowToStep',
                    'position' => $index + 1,
                    'name' => $step['name'],
                    'text' => $step['text'],
                ];
            }, $steps, array_keys($steps)),
        ], static fn ($value): bool => $value !== null && $value !== '');
    }
}
