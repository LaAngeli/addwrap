<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Support\Seo;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Setează locale-ul aplicației pe baza primului segment din URL.
     * RO este servită pe rădăcină (fără prefix), EN sub prefixul /en.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Stare SEO proaspătă la fiecare request (rulează înaintea controllerului),
        // ca să nu se scurgă meta între request-uri pe Octane sau în teste.
        app()->forgetInstance(Seo::class);

        $locales = config('site.locales', ['ro']);
        $segment = $request->segment(1);

        $locale = in_array($segment, $locales, true)
            ? $segment
            : config('site.default_locale', 'ro');

        app()->setLocale($locale);

        return $next($request);
    }
}
