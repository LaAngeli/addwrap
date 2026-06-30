<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Localization;
use App\Support\Projects;
use App\Support\Schema;
use App\Support\Seo;
use Illuminate\Contracts\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        return view('pages.portfolio', [
            'projects' => Projects::published(),
        ]);
    }

    public function show(string $slug, Seo $seo): View
    {
        $project = Projects::find($slug);

        abort_if($project === null, 404);

        $content = Projects::content($project);
        $title = (string) ($content['title'] ?? '');

        $seo->cover('images/og/portfolio/'.$slug.'-'.app()->getLocale().'.jpg')
            ->title($title)
            ->description((string) ($content['excerpt'] ?? ''))
            ->type('article')
            ->breadcrumbs([
                ['name' => (string) trans('messages.nav.portfolio'), 'url' => Localization::route('portfolio')],
                ['name' => $title, 'url' => url()->current()],
            ])
            ->addSchema(Schema::caseStudy($project, $content));

        return view('pages.portfolio-show', [
            'project' => $project,
            'slug' => $slug,
            'others' => Projects::others($slug),
        ]);
    }
}
