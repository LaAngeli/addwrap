<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Schema;
use App\Support\Seo;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(Seo $seo): View
    {
        // FAQ vizibil în Home → expunem FAQPage schema, pentru rich snippets
        // și citare directă de către AI Overviews / Perplexity.
        $entries = $this->flatFaq((array) trans('pages.home.faq'));
        if (! empty($entries)) {
            $seo->addSchema(Schema::faqPage($entries));
        }

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

    public function pricing(Seo $seo): View
    {
        $entries = $this->flatFaq((array) trans('pages.pricing.faq'));
        if (! empty($entries)) {
            $seo->addSchema(Schema::faqPage($entries));
        }

        // Tabelul complet de prețuri → OfferCatalog cu un Offer per linie,
        // citabil per item de Bing / Perplexity / AI Overviews.
        $groups = (array) (trans('pages.pricing.table_groups') ?: []);
        if (! empty($groups)) {
            $seo->addSchema(Schema::priceList(
                (string) trans('pages.pricing.full_list_title'),
                $groups
            ));
        }

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

    /**
     * Normalizează o listă de {q, a} la formatul {question, answer} cerut de
     * Schema::faqPage (FAQ pe Home, Pricing etc.).
     *
     * @param  array<int, array<string, mixed>>  $items
     * @return array<int, array{question: string, answer: string}>
     */
    private function flatFaq(array $items): array
    {
        $entries = [];

        foreach ($items as $item) {
            if (isset($item['q'], $item['a'])) {
                $entries[] = ['question' => (string) $item['q'], 'answer' => (string) $item['a']];
            }
        }

        return $entries;
    }
}
