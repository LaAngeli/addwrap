<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\BlogPosts;
use App\Support\Localization;
use App\Support\Schema;
use App\Support\Seo;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    public function index(Seo $seo): View
    {
        $posts = BlogPosts::published();

        $items = [];
        foreach ($posts as $slug => $post) {
            $content = BlogPosts::content($post);
            $items[] = [
                'url' => Localization::route('blog.show', ['slug' => $slug]),
                'name' => (string) ($content['title'] ?? $slug),
            ];
        }

        $seo->addSchema(Schema::itemList((string) trans('seo.blog.title'), $items));

        return view('pages.blog', ['posts' => $posts]);
    }

    public function show(string $slug, Seo $seo): View
    {
        $post = BlogPosts::find($slug);

        abort_if($post === null, 404);

        $content = BlogPosts::content($post);
        $title = (string) ($content['title'] ?? '');

        $seo->cover('images/og/blog/'.$slug.'-'.app()->getLocale().'.jpg')
            ->title($title)
            ->description((string) ($content['excerpt'] ?? ''))
            ->type('article')
            ->publishedTime($post['date'] ?? null)
            ->modifiedTime($post['date'] ?? null)
            ->breadcrumbs([
                ['name' => (string) trans('messages.nav.blog'), 'url' => Localization::route('blog')],
                ['name' => $title, 'url' => url()->current()],
            ])
            ->addSchema(Schema::article($post, $content, $seo->getImage()));

        // AEO: articolele structurate ca pași/decizie expun HowTo schema
        // (Google poate afișa rich snippet pas-cu-pas; LLM-urile preferă
        // pașii numerotați ca răspuns).
        $howtoSteps = $content['howto_steps'] ?? null;
        if (is_array($howtoSteps) && ! empty($howtoSteps)) {
            $seo->addSchema(Schema::howTo(
                $title,
                (string) ($content['excerpt'] ?? ''),
                $howtoSteps
            ));
        }

        return view('pages.blog-show', [
            'post' => $post,
            'slug' => $slug,
            'related' => BlogPosts::related($slug),
        ]);
    }
}
