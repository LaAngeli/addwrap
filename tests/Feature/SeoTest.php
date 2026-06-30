<?php

declare(strict_types=1);

/** Titlul brandat așteptat pentru o cheie din lang/seo.php (≤ 60 caractere). */
function brandedTitle(string $key): string
{
    $title = (string) trans($key);
    $full = $title.' | '.config('site.company.name');

    return mb_strlen($full) <= 60 ? $full : $title;
}

test('pagina home RO are title, description si date structurate globale', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('<title>'.e(brandedTitle('seo.home.title')).'</title>', false)
        ->assertSee('name="description"', false)
        ->assertSee('rel="canonical"', false)
        ->assertSee('hreflang="ro"', false)
        ->assertSee('hreflang="en"', false)
        ->assertSee('hreflang="x-default"', false)
        ->assertSee('"@type":"Organization"', false)
        ->assertSee('"@type":"WebSite"', false);
});

test('paginile statice isi rezolva meta din numele rutei', function () {
    $this->get('/despre')
        ->assertOk()
        ->assertSee('<title>'.e(brandedTitle('seo.about.title')).'</title>', false);

    $this->get('/preturi')
        ->assertOk()
        ->assertSee('<title>'.e(brandedTitle('seo.pricing.title')).'</title>', false);
});

test('titlul foloseste separatorul „|" si numele firmei', function () {
    $this->get('/despre')
        ->assertOk()
        ->assertSee('<title>Despre noi | AddWrap</title>', false);
});

test('versiunea EN serveste meta in engleza', function () {
    app()->setLocale('en');

    $this->get('/en')
        ->assertOk()
        ->assertSee('<title>'.e(brandedTitle('seo.home.title')).'</title>', false)
        ->assertSee('og:locale" content="en_US', false)
        ->assertSee('hreflang="ro"', false);
});

test('subpagina de serviciu seteaza meta dedicat si schema Service', function () {
    $this->get('/servicii/seo-aeo-geo')
        ->assertOk()
        ->assertSee(e(trans('seo.services.seo-aeo-geo.title')), false)
        ->assertSee(' | AddWrap', false)
        ->assertSee('"@type":"Service"', false);
});

test('articolul de blog are og:type article si schema BlogPosting', function () {
    $this->get('/blog/seo-ai-2026')
        ->assertOk()
        ->assertSee('og:type" content="article"', false)
        ->assertSee('"@type":"BlogPosting"', false)
        ->assertSee('SEO în 2026', false);
});

test('studiul de caz are schema CreativeWork', function () {
    $this->get('/portofoliu/nordica-ecommerce')
        ->assertOk()
        ->assertSee('"@type":"CreativeWork"', false);
});

test('pagina de multumire este noindex', function () {
    $this->get('/multumim')
        ->assertOk()
        ->assertSee('name="robots" content="noindex, nofollow"', false);
});

test('meta titlurile si descrierile respecta limitele Google', function () {
    $paths = ['/', '/servicii', '/servicii/seo-aeo-geo', '/despre', '/blog', '/preturi', '/contact', '/intrebari-frecvente'];

    foreach ($paths as $path) {
        $html = $this->get($path)->assertOk()->getContent();

        expect(preg_match('/<title>(.*?)<\/title>/s', $html, $t))->toBe(1, "title lipsă pe {$path}");
        expect(preg_match('/<meta name="description" content="(.*?)">/s', $html, $d))->toBe(1, "description lipsă pe {$path}");

        $title = html_entity_decode($t[1], ENT_QUOTES);
        $desc = html_entity_decode($d[1], ENT_QUOTES);

        expect(mb_strlen($title))->toBeLessThanOrEqual(60, "titlu prea lung pe {$path}: {$title}");
        expect(mb_strlen($desc))->toBeLessThanOrEqual(160, "descriere prea lungă pe {$path}");
    }
});

test('home emite un singur graf JSON-LD cu entitatile globale', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('"@graph"', false)
        ->assertSee('"@type":"Organization"', false)
        ->assertSee('"@type":"WebSite"', false)
        ->assertSee('"@type":"WebPage"', false);
});

test('subpagina de serviciu are BreadcrumbList si Service in graf', function () {
    $this->get('/servicii/seo-aeo-geo')
        ->assertOk()
        ->assertSee('"@type":"BreadcrumbList"', false)
        ->assertSee('"@type":"Service"', false);
});

test('pagina FAQ expune schema FAQPage', function () {
    $this->get('/intrebari-frecvente')
        ->assertOk()
        ->assertSee('"@type":"FAQPage"', false)
        ->assertSee('"@type":"Question"', false);
});

test('home are date Open Graph si X card imbogatite', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('property="og:image:width"', false)
        ->assertSee('property="og:image:alt"', false)
        ->assertSee('name="twitter:card"', false);
});

test('sitemap.xml este valid si multilingv', function () {
    $this->get('/sitemap.xml')
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
        ->assertSee('<urlset', false)
        ->assertSee('hreflang="x-default"', false)
        ->assertSee('/servicii/seo-aeo-geo', false);
});

test('robots.txt referentiaza sitemap si blocheaza paginile noindex', function () {
    $this->get('/robots.txt')
        ->assertOk()
        ->assertSee('Sitemap:', false)
        ->assertSee('Disallow: /multumim', false);
});

test('llms.txt descrie site-ul pentru crawlerele AI', function () {
    $this->get('/llms.txt')
        ->assertOk()
        ->assertSee('# AddWrap', false)
        ->assertSee('## Servicii', false);
});

test('serviciile, articolele si studiile de caz au cover OG dedicat', function () {
    $this->get('/servicii/seo-aeo-geo')
        ->assertOk()
        ->assertSee('og:image" content="', false)
        ->assertSee('images/og/services/seo-aeo-geo-ro.jpg', false);

    $this->get('/blog/seo-ai-2026')
        ->assertOk()
        ->assertSee('images/og/blog/seo-ai-2026-ro.jpg', false);

    $this->get('/portofoliu/nordica-ecommerce')
        ->assertOk()
        ->assertSee('images/og/portfolio/nordica-ecommerce-ro.jpg', false);
});
