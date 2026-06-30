<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\BlogPosts;
use App\Support\Localization;
use App\Support\Projects;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    /**
     * Rute statice incluse în sitemap (fără paginile noindex).
     *
     * @var array<int, string>
     */
    private const STATIC_ROUTES = [
        'home', 'services.index', 'about', 'portfolio', 'blog',
        'faq', 'pricing', 'contact', 'terms', 'privacy', 'cookies',
    ];

    /**
     * Sitemap XML multilingv, cu alternate hreflang și lastmod pentru fiecare URL.
     */
    public function sitemap(): Response
    {
        $locales = Localization::all();
        $default = config('site.default_locale');

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">'."\n";

        foreach ($this->pages() as $page) {
            $urls = $page['urls'];
            $lastmod = $page['lastmod'];

            foreach ($locales as $locale) {
                $xml .= "  <url>\n";
                $xml .= '    <loc>'.e($urls[$locale]).'</loc>'."\n";
                $xml .= '    <lastmod>'.e($lastmod).'</lastmod>'."\n";

                foreach ($locales as $alt) {
                    $xml .= '    <xhtml:link rel="alternate" hreflang="'.$alt.'" href="'.e($urls[$alt]).'"/>'."\n";
                }
                $xml .= '    <xhtml:link rel="alternate" hreflang="x-default" href="'.e($urls[$default]).'"/>'."\n";

                $xml .= "  </url>\n";
            }
        }

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    /**
     * robots.txt cu referință la sitemap și blocarea paginilor noindex.
     */
    public function robots(): Response
    {
        $lines = ['User-agent: *', 'Allow: /'];

        foreach (Localization::all() as $locale) {
            $path = parse_url(Localization::route('thank_you', [], $locale), PHP_URL_PATH);
            if ($path) {
                $lines[] = 'Disallow: '.$path;
            }
        }

        $lines[] = '';
        $lines[] = 'Sitemap: '.url('sitemap.xml');

        return response(implode("\n", $lines)."\n", 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }

    /**
     * llms.txt — ghid pentru crawlerele AI (AEO/GEO): descriere + linkuri cheie.
     *
     * @see https://llmstxt.org
     */
    public function llms(): Response
    {
        $name = config('site.company.name');
        $out = "# {$name}\n\n";
        $out .= '> '.trans('seo.default.description')."\n\n";

        $out .= "## Servicii\n\n";
        foreach (Localization::services() as $key => $service) {
            $itemName = (string) trans('services.items.'.$key.'.name');
            $excerpt = (string) trans('services.items.'.$key.'.excerpt');
            $out .= "- [{$itemName}](".Localization::serviceUrl($key)."): {$excerpt}\n";
        }

        $out .= "\n## Resurse\n\n";
        $out .= '- ['.trans('messages.nav.about').']('.Localization::route('about').")\n";
        $out .= '- ['.trans('messages.nav.portfolio').']('.Localization::route('portfolio').")\n";
        $out .= '- ['.trans('messages.nav.blog').']('.Localization::route('blog').")\n";
        $out .= '- ['.trans('messages.nav.pricing').']('.Localization::route('pricing').")\n";
        $out .= '- ['.trans('messages.nav.faq').']('.Localization::route('faq').")\n";
        $out .= '- ['.trans('messages.nav.contact').']('.Localization::route('contact').")\n";

        return response($out, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }

    /**
     * Toate paginile site-ului, fiecare cu URL-ul pe fiecare locale și data
     * ultimei modificări. Pentru paginile statice se folosește data globală
     * din config; pentru blog data articolului; pentru portfolio anul + 12-31.
     *
     * @return array<int, array{urls: array<string, string>, lastmod: string}>
     */
    private function pages(): array
    {
        $staticLastmod = (string) config('site.last_modified', date('Y-m-d'));
        $pages = [];

        foreach (self::STATIC_ROUTES as $route) {
            $pages[] = [
                'urls' => $this->localizedUrls(fn (string $locale): string => Localization::route($route, [], $locale)),
                'lastmod' => $staticLastmod,
            ];
        }

        foreach (array_keys(Localization::services()) as $key) {
            $pages[] = [
                'urls' => $this->localizedUrls(fn (string $locale): string => Localization::serviceUrl($key, $locale)),
                'lastmod' => $staticLastmod,
            ];
        }

        foreach (BlogPosts::published() as $slug => $post) {
            $pages[] = [
                'urls' => $this->localizedUrls(fn (string $locale): string => Localization::route('blog.show', ['slug' => $slug], $locale)),
                'lastmod' => (string) ($post['date'] ?? $staticLastmod),
            ];
        }

        foreach (Projects::published() as $slug => $project) {
            $year = (string) ($project['year'] ?? '');
            $pages[] = [
                'urls' => $this->localizedUrls(fn (string $locale): string => Localization::route('portfolio.show', ['slug' => $slug], $locale)),
                'lastmod' => $year !== '' ? $year.'-12-31' : $staticLastmod,
            ];
        }

        return $pages;
    }

    /**
     * @param  callable(string): string  $resolver
     * @return array<string, string>
     */
    private function localizedUrls(callable $resolver): array
    {
        $urls = [];

        foreach (Localization::all() as $locale) {
            $urls[$locale] = $resolver($locale);
        }

        return $urls;
    }
}
