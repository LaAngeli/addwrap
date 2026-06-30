<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Schema;
use App\Support\Seo;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function faq(Seo $seo): View
    {
        // Titlul/descrierea/breadcrumb se rezolvă automat din rută;
        // adăugăm doar nodul FAQPage (AEO: răspunsuri directe pentru AI/Google).
        $seo->addSchema(Schema::faqPage($this->faqEntries()));

        return view('pages.faq');
    }

    public function pricing(): View
    {
        return view('pages.pricing');
    }

    public function thankYou(): View
    {
        return view('pages.thank-you');
    }

    public function terms(): View
    {
        return view('pages.legal.terms');
    }

    public function privacy(): View
    {
        return view('pages.legal.privacy');
    }

    public function cookies(): View
    {
        return view('pages.legal.cookies');
    }

    /**
     * Întrebările frecvente aplatizate pentru schema FAQPage.
     *
     * @return array<int, array{question: string, answer: string}>
     */
    private function faqEntries(): array
    {
        $entries = [];

        foreach ((array) trans('faq.categories') as $category) {
            foreach (($category['items'] ?? []) as $item) {
                if (isset($item['q'], $item['a'])) {
                    $entries[] = ['question' => $item['q'], 'answer' => $item['a']];
                }
            }
        }

        return $entries;
    }
}
