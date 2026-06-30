<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/**
 * Stare SEO a paginii curente, partajată pe durata request-ului.
 *
 * Înregistrată ca singleton (scoped) în container. Controllerele pot seta
 * meta explicit pentru paginile dinamice (servicii, blog, portofoliu), iar
 * componentul <x-seo /> citește aceeași instanță și o completează automat
 * din numele rutei pentru paginile statice. Tot de aici se compune graful
 * JSON-LD (@graph) folosit pentru AEO/GEO.
 */
class Seo
{
    private ?string $title = null;

    private ?string $description = null;

    private ?string $image = null;

    private string $type = 'website';

    private bool $indexable = true;

    private ?string $publishedTime = null;

    private ?string $modifiedTime = null;

    /**
     * Fir Ariadnei: listă ordonată de [name, url].
     *
     * @var array<int, array{name: string, url: string}>
     */
    private array $breadcrumbs = [];

    /**
     * Noduri JSON-LD specifice paginii, adăugate în @graph (Service, Article etc.).
     *
     * @var array<int, array<string, mixed>>
     */
    private array $nodes = [];

    /**
     * Map nume rută de bază (fără prefix de locale) -> cheie în lang/seo.php.
     *
     * @var array<string, string>
     */
    private const ROUTE_KEYS = [
        'home' => 'home',
        'services.index' => 'services_index',
        'about' => 'about',
        'portfolio' => 'portfolio',
        'blog' => 'blog',
        'faq' => 'faq',
        'pricing' => 'pricing',
        'contact' => 'contact',
        'thank_you' => 'thank_you',
        'terms' => 'terms',
        'privacy' => 'privacy',
        'cookies' => 'cookies',
    ];

    /**
     * Eticheta de breadcrumb pentru pagini cu intrare în messages.nav.
     *
     * @var array<string, string>
     */
    private const ROUTE_NAV_LABELS = [
        'services.index' => 'services',
        'about' => 'about',
        'portfolio' => 'portfolio',
        'blog' => 'blog',
        'faq' => 'faq',
        'pricing' => 'pricing',
        'contact' => 'contact',
    ];

    /**
     * Chei de pagină care nu trebuie indexate (ex: pagina de mulțumire).
     *
     * @var array<int, string>
     */
    private const NOINDEX_KEYS = ['thank_you'];

    /**
     * Setează titlul, opțional cu numele firmei adăugat ca sufix.
     */
    public function title(string $title, bool $appendSiteName = true): static
    {
        $this->title = $appendSiteName
            ? $this->brandedTitle($title)
            : trim($title);

        return $this;
    }

    /**
     * Setează descrierea (normalizată: spații colapsate, max 160 caractere).
     */
    public function description(string $description): static
    {
        $this->description = $this->normalize($description);

        return $this;
    }

    /**
     * Imaginea Open Graph / Twitter (cale relativă la public/ sau URL absolut).
     */
    public function image(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Setează un cover OG dedicat doar dacă fișierul există în public/;
     * altfel rămâne imaginea implicită (evită og:image către un 404).
     */
    public function cover(string $relativePath): static
    {
        if (is_file(public_path($relativePath))) {
            $this->image = $relativePath;
        }

        return $this;
    }

    /**
     * Tipul Open Graph (ex: "website", "article").
     */
    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Marchează pagina ca neindexabilă (robots: noindex, nofollow).
     */
    public function noindex(): static
    {
        $this->indexable = false;

        return $this;
    }

    /**
     * Datele de publicare/modificare pentru conținut de tip articol (ISO 8601).
     */
    public function publishedTime(?string $date): static
    {
        $this->publishedTime = $date;

        return $this;
    }

    public function modifiedTime(?string $date): static
    {
        $this->modifiedTime = $date;

        return $this;
    }

    /**
     * Setează firul Ariadnei. Implicit adaugă în față crumb-ul „Acasă".
     *
     * @param  array<int, array{name: string, url: string}>  $items
     */
    public function breadcrumbs(array $items, bool $prependHome = true): static
    {
        if ($prependHome) {
            array_unshift($items, [
                'name' => (string) trans('messages.nav.home'),
                'url' => Localization::route('home'),
            ]);
        }

        $this->breadcrumbs = $items;

        return $this;
    }

    /**
     * Adaugă un nod JSON-LD pentru pagina curentă în @graph.
     *
     * @param  array<string, mixed>  $node
     */
    public function addSchema(array $node): static
    {
        $this->nodes[] = $node;

        return $this;
    }

    /**
     * Populează meta dintr-o cheie din lang/seo.php (titlu deja brandat).
     */
    public function forKey(string $key): static
    {
        $this->title = $this->brandedTitle((string) trans("seo.{$key}.title"));
        $this->description = $this->normalize((string) trans("seo.{$key}.description"));

        if (in_array($key, self::NOINDEX_KEYS, true)) {
            $this->indexable = false;
        }

        return $this;
    }

    /**
     * Populează meta pentru o subpagină de serviciu și adaugă nodul Service.
     */
    public function forService(string $key): static
    {
        $items = (array) trans('services.items.'.$key);

        $title = Lang::has("seo.services.{$key}.title")
            ? (string) trans("seo.services.{$key}.title")
            : (string) ($items['name'] ?? $key);

        $description = Lang::has("seo.services.{$key}.description")
            ? (string) trans("seo.services.{$key}.description")
            : (string) ($items['excerpt'] ?? '');

        $this->title($title);
        $this->description($description);
        $this->addSchema(Schema::service($key, $items));

        $this->breadcrumbs([
            ['name' => (string) trans('messages.nav.services'), 'url' => Localization::route('services.index')],
            ['name' => (string) ($items['name'] ?? $key), 'url' => url()->current()],
        ]);

        return $this;
    }

    /**
     * Completează meta și breadcrumb din numele rutei, dacă nu au fost setate
     * explicit de controller. Apelat de componentul <x-seo /> la randare.
     */
    public function resolveFromRoute(): static
    {
        if ($this->title !== null) {
            return $this;
        }

        $name = Route::currentRouteName();
        $base = $name !== null ? Str::after($name, '.') : null;
        $key = $base !== null ? (self::ROUTE_KEYS[$base] ?? null) : null;

        if ($key !== null) {
            $this->forKey($key);
            $this->resolveDefaultBreadcrumbs($base, $key);
        }

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title ?? $this->brandedTitle((string) trans('seo.default.title'));
    }

    public function getDescription(): string
    {
        return $this->description ?? $this->normalize((string) trans('seo.default.description'));
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Firul Ariadnei (pentru componenta &lt;x-breadcrumbs /&gt; care îl
     * randează vizibil în pagină — același set folosit și în BreadcrumbList).
     *
     * @return array<int, array{name: string, url: string}>
     */
    public function getBreadcrumbs(): array
    {
        return $this->breadcrumbs;
    }

    public function isIndexable(): bool
    {
        return $this->indexable;
    }

    public function getPublishedTime(): ?string
    {
        return $this->publishedTime;
    }

    public function getModifiedTime(): ?string
    {
        return $this->modifiedTime ?? $this->publishedTime;
    }

    /**
     * URL-ul absolut al imaginii sociale (default din config dacă nu e setată).
     */
    public function getImage(): ?string
    {
        $image = $this->image ?? config('site.og_image');

        if (! $image) {
            return null;
        }

        return Str::startsWith($image, ['http://', 'https://'])
            ? $image
            : asset($image);
    }

    /**
     * Graful JSON-LD complet al paginii: Organization + WebSite + WebPage +
     * (Breadcrumb) + nodurile specifice paginii, într-un singur @graph.
     *
     * @return array<string, mixed>
     */
    public function jsonLd(): array
    {
        $hasBreadcrumbs = count($this->breadcrumbs) > 0;

        $graph = [
            Schema::organization(),
            Schema::website(),
            Schema::webPage($this->getTitle(), $this->getDescription(), $this->getImage(), $hasBreadcrumbs),
        ];

        if ($hasBreadcrumbs) {
            $graph[] = Schema::breadcrumb($this->breadcrumbs);
        }

        foreach ($this->nodes as $node) {
            $graph[] = $node;
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    }

    /**
     * Construiește breadcrumb-ul implicit pentru paginile statice.
     */
    private function resolveDefaultBreadcrumbs(string $base, string $key): void
    {
        if ($base === 'home') {
            return;
        }

        if (isset(self::ROUTE_NAV_LABELS[$base])) {
            $label = (string) trans('messages.nav.'.self::ROUTE_NAV_LABELS[$base]);
        } else {
            $label = (string) trans("seo.{$key}.title");
        }

        $this->breadcrumbs([
            ['name' => $label, 'url' => url()->current()],
        ]);
    }

    /**
     * Structura titlului: „{Titlu pagină} | AddWrap".
     *
     * Numele firmei se adaugă doar dacă titlul complet rămâne ≤ 60 de caractere
     * (limita practică Google, ~600px); altfel se păstrează doar titlul paginii,
     * ca să nu fie trunchiat conținutul important în SERP.
     */
    private function brandedTitle(string $title): string
    {
        $title = trim((string) preg_replace('/\s+/', ' ', $title));
        $brand = (string) config('site.company.name');

        if ($title === '') {
            return $brand;
        }

        $full = $title.' | '.$brand;

        return mb_strlen($full) <= 60 ? $full : $title;
    }

    /**
     * Colapsează spațiile și limitează lungimea pentru meta description.
     */
    private function normalize(string $text): string
    {
        $text = trim((string) preg_replace('/\s+/', ' ', $text));

        return Str::limit($text, 158, '…');
    }
}
