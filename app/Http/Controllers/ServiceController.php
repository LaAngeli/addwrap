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
