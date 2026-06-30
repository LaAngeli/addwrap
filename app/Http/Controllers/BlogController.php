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
    public function index(): View
    {
        return view('pages.blog', [
            'posts' => BlogPosts::published(),
        ]);
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

        return view('pages.blog-show', [
            'post' => $post,
            'slug' => $slug,
            'related' => BlogPosts::related($slug),
        ]);
    }
}
