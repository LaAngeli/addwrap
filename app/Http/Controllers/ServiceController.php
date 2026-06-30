<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Localization;
use App\Support\Seo;
use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    /**
     * Pagina overview cu toate serviciile.
     */
    public function index(): View
    {
        return view('pages.services.index', [
            'services' => Localization::services(),
        ]);
    }

    /**
     * Subpagina dedicată unui serviciu, rezolvată după slug-ul localizat.
     */
    public function show(string $service, Seo $seo): View
    {
        $key = Localization::serviceKeyFromSlug($service);

        abort_if($key === null, 404);

        $seo->forService($key)
            ->cover('images/og/services/'.$key.'-'.app()->getLocale().'.jpg');

        // AEO/GEO: pe pagina SEO/AEO/GEO publicăm setul de definiții ca
        // DefinedTermSet (acronime citabile de motoarele de răspuns + LLM-uri).
        $definitions = (array) (trans('services.items.'.$key.'.definitions') ?: []);
        if (! empty($definitions)) {
            $seo->addSchema(\App\Support\Schema::definedTermSet(
                (string) trans('services.items.'.$key.'.name'),
                $definitions
            ));
        }

        // AEO: dacă serviciul are FAQ, expunem FAQPage schema. Răspunsurile
        // sunt scurte, factuale, candidate pentru AI Overviews / Perplexity.
        $faq = (array) (trans('services.items.'.$key.'.faq') ?: []);
        if (! empty($faq)) {
            $entries = array_values(array_map(
                static fn (array $qa): array => ['question' => $qa['q'], 'answer' => $qa['a']],
                $faq
            ));
            $seo->addSchema(\App\Support\Schema::faqPage($entries));
        }

        // Pagină bespoke per serviciu dacă există (ex: pages.services.brandbook),
        // altfel șablonul generic.
        $view = view()->exists('pages.services.'.$key)
            ? 'pages.services.'.$key
            : 'pages.services.show';

        return view($view, [
            'serviceKey' => $key,
            'service' => Localization::services()[$key],
        ]);
    }
}
