<?php

declare(strict_types=1);

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
| Fișiere SEO globale (fără prefix de locale): sitemap, robots, llms.
*/
Route::get('sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('robots.txt', [SeoController::class, 'robots'])->name('robots');
Route::get('llms.txt', [SeoController::class, 'llms'])->name('llms');

/*
| Hook de deploy: golește OPcache-ul procesului web (vezi config/site.php).
| 404 dacă tokenul din .env lipsește sau nu se potrivește.
*/
Route::get('deploy/opcache-clear/{token}', function (string $token) {
    $expected = config('site.deploy.opcache_clear_token');

    abort_if(blank($expected) || ! hash_equals($expected, $token), 404);

    if (function_exists('opcache_reset')) {
        opcache_reset();
    }

    return response('opcache cleared');
})->name('deploy.opcache_clear');

/*
|--------------------------------------------------------------------------
| Rute web localizate
|--------------------------------------------------------------------------
| RO (limba principală) este servită pe rădăcină, fără prefix.
| EN este servită sub prefixul /en.
| Numele rutelor sunt prefixate cu locale-ul: "ro.*" și "en.*".
| Slug-urile traduse vin din config/site.php.
*/

foreach (config('site.locales') as $locale) {
    $isDefault = $locale === config('site.default_locale');
    $slugs = config("site.routes.{$locale}");

    Route::prefix($isDefault ? '' : $locale)
        ->name($locale.'.')
        ->group(function () use ($slugs) {
            Route::get('/', [PageController::class, 'home'])->name('home');

            // Servicii: overview + subpagini
            Route::get($slugs['services'], [ServiceController::class, 'index'])->name('services.index');
            Route::get($slugs['services'].'/{service}', [ServiceController::class, 'show'])->name('services.show');

            // Pagini companie
            Route::get($slugs['about'], [PageController::class, 'about'])->name('about');
            Route::get($slugs['portfolio'], [PortfolioController::class, 'index'])->name('portfolio');
            Route::get($slugs['portfolio'].'/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');
            Route::get($slugs['blog'], [BlogController::class, 'index'])->name('blog');
            Route::get($slugs['blog'].'/{slug}', [BlogController::class, 'show'])->name('blog.show');
            Route::get($slugs['faq'], [PageController::class, 'faq'])->name('faq');
            Route::get($slugs['pricing'], [PageController::class, 'pricing'])->name('pricing');

            // Contact
            Route::get($slugs['contact'], [ContactController::class, 'show'])->name('contact');
            Route::get($slugs['thank_you'], [PageController::class, 'thankYou'])->name('thank_you');

            // Pagini legale
            Route::get($slugs['terms'], [PageController::class, 'terms'])->name('terms');
            Route::get($slugs['privacy'], [PageController::class, 'privacy'])->name('privacy');
            Route::get($slugs['cookies'], [PageController::class, 'cookies'])->name('cookies');
        });
}
