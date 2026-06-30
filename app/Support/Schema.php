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
            'areaServed' => ['@type' => 'Country', 'name' => 'Romania'],
            'sameAs' => array_values(array_filter([
                $social['facebook'] ?? null,
                $social['instagram'] ?? null,
            ])),
        ], static fn ($value): bool => $value !== null && $value !== [] && $value !== '');
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

        $amountStr = (string) $price['amount'];

        // Extrage prima secvență numerică (cu „." sau „," ca separator de mii / zecimale).
        if (! preg_match('/(\d[\d.,]*)/', $amountStr, $match)) {
            return null;
        }

        // Normalizează: scoatem separatorul de mii („." în „3.000"). Dacă rămâne
        // „,", o tratăm ca zecimală (ex: „1,5").
        $numeric = str_replace('.', '', $match[1]);
        $numeric = str_replace(',', '.', $numeric);
        $value = (float) $numeric;

        if ($value <= 0) {
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
            'author' => [
                '@type' => 'Organization',
                'name' => $post['author'] ?? config('site.company.name'),
            ],
            'publisher' => ['@id' => self::organizationId()],
        ], static fn ($value): bool => $value !== null && $value !== '');
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
