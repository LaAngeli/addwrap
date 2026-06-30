<?php

declare(strict_types=1);

namespace App\Support;

class BlogPosts
{
    /**
     * Toate articolele, ordonate descrescător după dată.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function published(): array
    {
        $posts = self::posts();
        uasort($posts, fn (array $a, array $b): int => strcmp($b['date'], $a['date']));

        return $posts;
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function find(string $slug): ?array
    {
        return self::posts()[$slug] ?? null;
    }

    /**
     * Conținutul localizat al unui articol (cu fallback pe limba implicită).
     *
     * @param  array<string, mixed>  $post
     * @return array<string, mixed>
     */
    public static function content(array $post, ?string $locale = null): array
    {
        $locale ??= app()->getLocale();

        return $post[$locale] ?? $post[config('site.default_locale', 'ro')] ?? [];
    }

    /**
     * Articole din aceeași categorie, fără cel curent.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function related(string $slug, int $limit = 3): array
    {
        $current = self::find($slug);
        $category = $current['category'] ?? null;

        $related = array_filter(
            self::published(),
            fn (array $post, string $key): bool => $key !== $slug && ($category === null || $post['category'] === $category),
            ARRAY_FILTER_USE_BOTH
        );

        if (count($related) < $limit) {
            foreach (self::published() as $key => $post) {
                if ($key !== $slug) {
                    $related[$key] = $post;
                }
            }
        }

        return array_slice($related, 0, $limit, true);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private static function posts(): array
    {
        return [

            'seo-ai-2026' => [
                'slug' => 'seo-ai-2026',
                'category' => 'seo',
                'date' => '2026-06-12',
                'read_minutes' => 7,
                'author' => 'Echipa AddWrap',
                'featured' => true,
                'ro' => [
                    'title' => 'SEO în 2026: cum te găsesc clienții în era căutării AI',
                    'excerpt' => 'Motoarele de căutare au devenit motoare de răspuns. Iată cum îți optimizezi conținutul pentru Google, dar și pentru asistenții AI care răspund direct la întrebările clienților tăi.',
                    'blocks' => [
                        ['type' => 'paragraph', 'text' => 'Comportamentul de căutare s-a schimbat mai mult în ultimii doi ani decât în deceniul precedent. Oamenii nu mai tastează doar cuvinte cheie, ci pun întrebări complete și se așteaptă la un răspuns imediat, fie de la Google, fie de la un asistent AI. Pentru un business, asta înseamnă că SEO clasic nu mai este suficient.'],
                        ['type' => 'heading', 'text' => 'De la cuvinte cheie la intenție'],
                        ['type' => 'paragraph', 'text' => 'Primul pas este să treci de la o listă de cuvinte cheie la o hartă a intențiilor. Ce vrea de fapt să afle clientul când caută serviciul tău? Conținutul care răspunde clar și complet la o întrebare reală câștigă atât în rezultatele clasice, cât și în răspunsurile generate de AI.'],
                        ['type' => 'heading', 'text' => 'Cele trei straturi: SEO, AEO și GEO'],
                        ['type' => 'list', 'items' => [
                            'SEO — fundamentul tehnic și de conținut care îți face site-ul ușor de citit de motoarele de căutare.',
                            'AEO — optimizarea pentru motoarele de răspuns, astfel încât AI-ul să te citeze ca sursă.',
                            'GEO — vizibilitatea locală, pe hartă și în căutările cu intenție geografică.',
                        ]],
                        ['type' => 'quote', 'text' => 'Nu mai optimizezi pentru un algoritm, ci pentru momentul în care un om are nevoie de răspunsul tău.'],
                        ['type' => 'paragraph', 'text' => 'În practică, asta înseamnă date structurate corecte, conținut care răspunde la întrebări, o viteză bună a site-ului și o prezență locală îngrijită. Niciuna dintre ele nu aduce rezultate peste noapte, dar împreună construiesc o vizibilitate greu de clintit.'],
                    ],
                ],
                'en' => [
                    'title' => 'SEO in 2026: how customers find you in the age of AI search',
                    'excerpt' => 'Search engines have become answer engines. Here is how to optimize your content for Google and for the AI assistants that answer your customers directly.',
                    'blocks' => [
                        ['type' => 'paragraph', 'text' => 'Search behaviour has changed more in the last two years than in the previous decade. People no longer just type keywords; they ask full questions and expect an immediate answer, either from Google or from an AI assistant. For a business, that means classic SEO is no longer enough.'],
                        ['type' => 'heading', 'text' => 'From keywords to intent'],
                        ['type' => 'paragraph', 'text' => 'The first step is moving from a list of keywords to a map of intent. What does the customer actually want to learn when they look for your service? Content that answers a real question clearly and completely wins both in classic results and in AI-generated answers.'],
                        ['type' => 'heading', 'text' => 'The three layers: SEO, AEO and GEO'],
                        ['type' => 'list', 'items' => [
                            'SEO — the technical and content foundation that makes your site easy for search engines to read.',
                            'AEO — answer engine optimization, so AI cites you as a source.',
                            'GEO — local visibility, on the map and in geo-intent searches.',
                        ]],
                        ['type' => 'quote', 'text' => 'You are no longer optimizing for an algorithm, but for the moment a person needs your answer.'],
                        ['type' => 'paragraph', 'text' => 'In practice, this means correct structured data, content that answers questions, good site speed and a tidy local presence. None of them deliver results overnight, but together they build visibility that is hard to shake.'],
                    ],
                ],
            ],

            'google-meta-buget' => [
                'slug' => 'google-meta-buget',
                'category' => 'ads',
                'date' => '2026-05-28',
                'read_minutes' => 6,
                'author' => 'Echipa AddWrap',
                'featured' => false,
                'ro' => [
                    'title' => 'Google Ads sau Meta Ads: unde să pui primul buget',
                    'excerpt' => 'Cele două platforme rezolvă probleme diferite. Alegerea greșită îți arde bugetul, iar cea potrivită îți aduce primii clienți mai repede decât crezi.',
                    'blocks' => [
                        ['type' => 'paragraph', 'text' => 'Una dintre cele mai frecvente întrebări pe care le primim este simplă: Google sau Meta? Răspunsul depinde mai puțin de buget și mai mult de momentul în care vrei să prinzi clientul în decizia lui de cumpărare.'],
                        ['type' => 'heading', 'text' => 'Google Ads prinde cererea existentă'],
                        ['type' => 'paragraph', 'text' => 'Pe Google, oamenii caută activ o soluție. Dacă cineva tastează serviciul tău, are deja intenție. Aici câștigi clienți gata de cumpărare, dar plătești pentru această intenție prin licitație pe cuvinte cheie.'],
                        ['type' => 'heading', 'text' => 'Meta Ads creează cererea'],
                        ['type' => 'paragraph', 'text' => 'Pe Facebook și Instagram, oamenii nu caută, ci descoperă. Aici construiești notorietate, educi publicul și creezi dorință cu ajutorul creativelor bune. Costul pe rezultat e adesea mai mic, dar drumul până la vânzare e mai lung.'],
                        ['type' => 'list', 'items' => [
                            'Ai un serviciu pe care oamenii îl caută deja? Începe cu Google.',
                            'Ai un produs vizual sau o ofertă care trebuie explicată? Începe cu Meta.',
                            'Ai buget pentru ambele? Folosește Meta pentru notorietate și Google pentru conversie.',
                        ]],
                        ['type' => 'quote', 'text' => 'Bugetul mic nu e o problemă dacă îl pui în locul potrivit pentru afacerea ta.'],
                    ],
                    'howto_steps' => [
                        ['name' => 'Identifică tipul de cerere', 'text' => 'Întreabă-te dacă oamenii caută activ serviciul tău pe Google. Dacă da, există cerere existentă pe care o poți capta direct cu Google Ads — clienții sunt deja în decizie.'],
                        ['name' => 'Evaluează factorul vizual', 'text' => 'Produsul sau serviciul tău se vinde prin imagine, atmosferă sau poveste? Atunci Meta Ads (Facebook + Instagram) îți permite să construiești dorință cu creativ bun, chiar dacă cererea nu există încă.'],
                        ['name' => 'Alocă bugetul potrivit contextului', 'text' => 'Cu buget unic, începe cu platforma care se potrivește contextului afacerii. Cu buget dual, folosește Meta pentru notorietate și Google pentru conversie — Meta umple top-ul funnel-ului, Google îl închide.'],
                    ],
                ],
                'en' => [
                    'title' => 'Google Ads or Meta Ads: where to put your first budget',
                    'excerpt' => 'The two platforms solve different problems. The wrong choice burns your budget; the right one brings your first customers faster than you think.',
                    'blocks' => [
                        ['type' => 'paragraph', 'text' => 'One of the most common questions we get is simple: Google or Meta? The answer depends less on budget and more on when you want to catch the customer in their buying decision.'],
                        ['type' => 'heading', 'text' => 'Google Ads captures existing demand'],
                        ['type' => 'paragraph', 'text' => 'On Google, people actively search for a solution. If someone types your service, they already have intent. Here you win ready-to-buy customers, but you pay for that intent through keyword bidding.'],
                        ['type' => 'heading', 'text' => 'Meta Ads creates demand'],
                        ['type' => 'paragraph', 'text' => 'On Facebook and Instagram, people do not search, they discover. Here you build awareness, educate your audience and create desire with good creative. Cost per result is often lower, but the path to a sale is longer.'],
                        ['type' => 'list', 'items' => [
                            'Do people already search for your service? Start with Google.',
                            'Do you have a visual product or an offer that needs explaining? Start with Meta.',
                            'Have budget for both? Use Meta for awareness and Google for conversion.',
                        ]],
                        ['type' => 'quote', 'text' => 'A small budget is not a problem if you put it in the right place for your business.'],
                    ],
                    'howto_steps' => [
                        ['name' => 'Identify the type of demand', 'text' => 'Ask whether people are actively searching for your service on Google. If they are, there is existing demand you can capture directly with Google Ads — customers are already in decision mode.'],
                        ['name' => 'Evaluate the visual factor', 'text' => 'Does your product or service sell through image, atmosphere or story? Then Meta Ads (Facebook + Instagram) lets you build desire with strong creative, even when demand does not exist yet.'],
                        ['name' => 'Allocate the budget to fit context', 'text' => 'With a single budget, start with the platform that matches your business context. With dual budget, use Meta for awareness and Google for conversion — Meta fills the top of the funnel, Google closes it.'],
                    ],
                ],
            ],

            'calendar-continut' => [
                'slug' => 'calendar-continut',
                'category' => 'content',
                'date' => '2026-05-15',
                'read_minutes' => 5,
                'author' => 'Echipa AddWrap',
                'featured' => false,
                'ro' => [
                    'title' => 'Calendarul de conținut care chiar aduce clienți',
                    'excerpt' => 'Postezi constant, dar fără rezultate? Problema rareori e frecvența. E lipsa unui plan care leagă fiecare postare de un obiectiv de business.',
                    'blocks' => [
                        ['type' => 'paragraph', 'text' => 'Multe afaceri postează des, dar haotic. Rezultatul e o pagină activă care nu vinde nimic. Un calendar de conținut bun nu înseamnă mai multe postări, ci postări cu rol clar.'],
                        ['type' => 'heading', 'text' => 'Pornește de la obiectiv, nu de la idei'],
                        ['type' => 'paragraph', 'text' => 'Înainte să decizi ce postezi, decide ce vrei să obții: notorietate, încredere sau vânzare. Fiecare postare ar trebui să servească unul dintre aceste scopuri, altfel e doar zgomot.'],
                        ['type' => 'heading', 'text' => 'Structura unui calendar care funcționează'],
                        ['type' => 'list', 'items' => [
                            'Conținut educativ care răspunde la întrebările clienților.',
                            'Conținut de încredere: rezultate, testimoniale, procese din spate.',
                            'Conținut de conversie: oferte, apeluri la acțiune, demonstrații.',
                            'Conținut de comunitate care umanizează brandul.',
                        ]],
                        ['type' => 'quote', 'text' => 'Consistența bate inspirația. Un plan modest, dus la capăt, învinge mereu o idee genială lăsată baltă.'],
                        ['type' => 'paragraph', 'text' => 'Odată ce ai structura, planificarea devine simplă. Aloci teme pe săptămâni, pregătești din timp și măsori ce funcționează, ca să faci mai mult din ce aduce rezultate.'],
                    ],
                    'howto_steps' => [
                        ['name' => 'Definește obiectivul de business', 'text' => 'Înainte să decizi ce postezi, alege ce vrei să obții: notorietate, încredere sau vânzare. Fiecare postare ar trebui să servească unul dintre aceste scopuri, altfel e doar zgomot.'],
                        ['name' => 'Structurează tipurile de conținut', 'text' => 'Acoperă patru direcții: educativ (răspunde la întrebări), încredere (rezultate, procese din spate), conversie (oferte, CTA) și comunitate (poveste, oameni). Așa eviți pagina monotonă care nu vinde.'],
                        ['name' => 'Alocă teme pe săptămâni', 'text' => 'Repartizează direcțiile pe săptămâni și pregătește din timp materialele. Un calendar cu 4-6 săptămâni înainte e suficient ca să nu te prinzi în producție în ultima clipă.'],
                        ['name' => 'Măsoară și ajustează lunar', 'text' => 'La sfârșit de lună, vezi ce postări au generat reacții, salvări sau lead-uri, și fă mai mult din ce a adus rezultate. Calendarul nu e gravat în piatră.'],
                    ],
                ],
                'en' => [
                    'title' => 'The content calendar that actually brings customers',
                    'excerpt' => 'Posting consistently but seeing no results? The problem is rarely frequency. It is the lack of a plan that ties every post to a business goal.',
                    'blocks' => [
                        ['type' => 'paragraph', 'text' => 'Many businesses post often, but chaotically. The result is an active page that sells nothing. A good content calendar is not about more posts, but about posts with a clear role.'],
                        ['type' => 'heading', 'text' => 'Start from the goal, not from ideas'],
                        ['type' => 'paragraph', 'text' => 'Before you decide what to post, decide what you want to achieve: awareness, trust or sales. Every post should serve one of these goals, otherwise it is just noise.'],
                        ['type' => 'heading', 'text' => 'The structure of a calendar that works'],
                        ['type' => 'list', 'items' => [
                            'Educational content that answers customer questions.',
                            'Trust content: results, testimonials, behind-the-scenes.',
                            'Conversion content: offers, calls to action, demos.',
                            'Community content that humanizes the brand.',
                        ]],
                        ['type' => 'quote', 'text' => 'Consistency beats inspiration. A modest plan carried through always beats a brilliant idea left undone.'],
                        ['type' => 'paragraph', 'text' => 'Once you have the structure, planning becomes simple. You assign themes to weeks, prepare ahead and measure what works, so you do more of what brings results.'],
                    ],
                    'howto_steps' => [
                        ['name' => 'Define the business goal', 'text' => 'Before deciding what to post, choose what you want to achieve: awareness, trust or sales. Every post should serve one of these goals, otherwise it is just noise.'],
                        ['name' => 'Structure the content types', 'text' => 'Cover four directions: educational (answer questions), trust (results, behind-the-scenes), conversion (offers, CTA) and community (story, people). That keeps the page from sliding into the silent-sells-nothing trap.'],
                        ['name' => 'Assign themes to weeks', 'text' => 'Map the directions to specific weeks and prepare assets ahead of time. A calendar that runs 4-6 weeks in advance is enough to avoid last-minute production scrambles.'],
                        ['name' => 'Measure and adjust monthly', 'text' => 'At month-end, look at which posts drove reactions, saves or leads, and do more of what brought results. The calendar is not set in stone.'],
                    ],
                ],
            ],

            'brandbook-economie' => [
                'slug' => 'brandbook-economie',
                'category' => 'branding',
                'date' => '2026-04-30',
                'read_minutes' => 5,
                'author' => 'Echipa AddWrap',
                'featured' => false,
                'ro' => [
                    'title' => 'De ce un brandbook îți economisește bani pe termen lung',
                    'excerpt' => 'Un brandbook pare un cost de început. În realitate, e investiția care oprește risipa de timp și bani la fiecare material pe care îl creezi după.',
                    'blocks' => [
                        ['type' => 'paragraph', 'text' => 'Fără reguli clare de brand, fiecare postare, banner sau pagină se reinventează de la zero. Asta înseamnă timp pierdut, mesaje inconsecvente și un brand care nu rămâne în minte.'],
                        ['type' => 'heading', 'text' => 'Consistența construiește încredere'],
                        ['type' => 'paragraph', 'text' => 'Oamenii cumpără de la branduri pe care le recunosc. Când culorile, fonturile și tonul vocii sunt aceleași peste tot, brandul tău pare mai mare și mai serios decât este în realitate.'],
                        ['type' => 'heading', 'text' => 'Ce economisești concret'],
                        ['type' => 'list', 'items' => [
                            'Timpul de creație: orice colaborator știe exact ce să folosească.',
                            'Costuri de refacere: nu mai plătești de două ori pentru același material.',
                            'Decizii repetate: regulile sunt deja luate, nu le mai negociezi de fiecare dată.',
                        ]],
                        ['type' => 'quote', 'text' => 'Un brand fără reguli e ca o casă fără plan: se poate construi, dar costă mai mult și nu iese drept.'],
                        ['type' => 'paragraph', 'text' => 'Un brandbook bun nu îți limitează creativitatea, ci îți dă un cadru în care poți crea rapid și coerent. Plătești o dată și beneficiezi la fiecare material de după.'],
                    ],
                ],
                'en' => [
                    'title' => 'Why a brandbook saves you money in the long run',
                    'excerpt' => 'A brandbook looks like an upfront cost. In reality, it is the investment that stops wasting time and money on every asset you create afterwards.',
                    'blocks' => [
                        ['type' => 'paragraph', 'text' => 'Without clear brand rules, every post, banner or page is reinvented from scratch. That means wasted time, inconsistent messaging and a brand that does not stick in memory.'],
                        ['type' => 'heading', 'text' => 'Consistency builds trust'],
                        ['type' => 'paragraph', 'text' => 'People buy from brands they recognize. When colors, fonts and tone of voice are the same everywhere, your brand looks bigger and more serious than it actually is.'],
                        ['type' => 'heading', 'text' => 'What you actually save'],
                        ['type' => 'list', 'items' => [
                            'Creation time: every collaborator knows exactly what to use.',
                            'Rework costs: you no longer pay twice for the same asset.',
                            'Repeated decisions: the rules are already set, you do not renegotiate them every time.',
                        ]],
                        ['type' => 'quote', 'text' => 'A brand without rules is like a house without a plan: you can build it, but it costs more and never comes out straight.'],
                        ['type' => 'paragraph', 'text' => 'A good brandbook does not limit your creativity, it gives you a framework to create fast and coherently. You pay once and benefit on every asset afterwards.'],
                    ],
                ],
            ],

            'viteza-site-vanzari' => [
                'slug' => 'viteza-site-vanzari',
                'category' => 'web',
                'date' => '2026-04-18',
                'read_minutes' => 6,
                'author' => 'Echipa AddWrap',
                'featured' => false,
                'ro' => [
                    'title' => 'Viteza site-ului înseamnă vânzări: ghid practic Core Web Vitals',
                    'excerpt' => 'Fiecare secundă de încărcare în plus îți costă clienți. Iată ce înseamnă Core Web Vitals și cum transformi viteza într-un avantaj de vânzare.',
                    'blocks' => [
                        ['type' => 'paragraph', 'text' => 'Un site lent nu enervează doar vizitatorii, ci îți reduce direct vânzările și poziția în Google. Studiile arată că rata de abandon crește puternic cu fiecare secundă în plus de încărcare.'],
                        ['type' => 'heading', 'text' => 'Ce măsoară Core Web Vitals'],
                        ['type' => 'list', 'items' => [
                            'LCP — cât de repede apare conținutul principal al paginii.',
                            'INP — cât de prompt răspunde site-ul la interacțiunile utilizatorului.',
                            'CLS — cât de stabil este aspectul paginii în timpul încărcării.',
                        ]],
                        ['type' => 'heading', 'text' => 'Cum îmbunătățești viteza'],
                        ['type' => 'paragraph', 'text' => 'Imaginile optimizate, un hosting bun, cod curat și încărcarea inteligentă a resurselor fac cea mai mare diferență. De multe ori, câteva ajustări tehnice reduc timpul de încărcare la jumătate.'],
                        ['type' => 'quote', 'text' => 'Viteza nu e un detaliu tehnic, ci prima impresie pe care o lași înainte ca cineva să apuce să citească ceva.'],
                        ['type' => 'paragraph', 'text' => 'Tratează viteza ca pe o funcție de business, nu ca pe o bifă tehnică. Un site rapid convertește mai bine, costă mai puțin în publicitate și urcă mai ușor în căutări.'],
                    ],
                    'howto_steps' => [
                        ['name' => 'Măsoară Core Web Vitals', 'text' => 'Rulează PageSpeed Insights sau Lighthouse pe paginile cheie și notează LCP (cât de repede apare conținutul principal), INP (cât de repede răspunde site-ul la interacțiuni) și CLS (cât de stabil rămâne layout-ul).'],
                        ['name' => 'Optimizează imaginile', 'text' => 'Comprimă, alege formate moderne (WebP/AVIF), setează dimensiuni explicite pentru width și height, și folosește lazy loading pentru imaginile sub fold. De obicei aici câștigi cea mai mare parte din LCP.'],
                        ['name' => 'Curăță codul și încarcă inteligent resursele', 'text' => 'Elimină JS și CSS nefolosite, preîncarcă fonturile critice, defer-uiește scripturile non-critice și mută bibliotecile grele după prima interacțiune. Așa scapi de blocajele de render.'],
                        ['name' => 'Re-măsoară și iterează', 'text' => 'După fiecare modificare, re-rulează testele și verifică tendința. O îmbunătățire de 1 secundă la LCP poate crește rata de conversie cu 5-10% — viteza nu e bifă, e canal de vânzări.'],
                    ],
                ],
                'en' => [
                    'title' => 'Site speed means sales: a practical Core Web Vitals guide',
                    'excerpt' => 'Every extra second of load time costs you customers. Here is what Core Web Vitals mean and how to turn speed into a selling advantage.',
                    'blocks' => [
                        ['type' => 'paragraph', 'text' => 'A slow site does not just annoy visitors, it directly reduces your sales and your Google ranking. Studies show that bounce rate rises sharply with every extra second of load time.'],
                        ['type' => 'heading', 'text' => 'What Core Web Vitals measure'],
                        ['type' => 'list', 'items' => [
                            'LCP — how fast the main page content appears.',
                            'INP — how promptly the site responds to user interactions.',
                            'CLS — how stable the layout is while the page loads.',
                        ]],
                        ['type' => 'heading', 'text' => 'How to improve speed'],
                        ['type' => 'paragraph', 'text' => 'Optimized images, good hosting, clean code and smart resource loading make the biggest difference. Often, a few technical tweaks cut load time in half.'],
                        ['type' => 'quote', 'text' => 'Speed is not a technical detail, it is the first impression you make before anyone gets to read a thing.'],
                        ['type' => 'paragraph', 'text' => 'Treat speed as a business function, not a technical checkbox. A fast site converts better, costs less in advertising and climbs more easily in search.'],
                    ],
                    'howto_steps' => [
                        ['name' => 'Measure Core Web Vitals', 'text' => 'Run PageSpeed Insights or Lighthouse on key pages and note LCP (how fast the main content appears), INP (how fast the site responds to interactions) and CLS (how stable the layout stays).'],
                        ['name' => 'Optimize images', 'text' => 'Compress, pick modern formats (WebP/AVIF), set explicit width and height, and lazy-load below-the-fold images. This usually yields most of your LCP gains.'],
                        ['name' => 'Clean the code and load resources smartly', 'text' => 'Remove unused JS and CSS, preload critical fonts, defer non-critical scripts and move heavy libraries behind first interaction. That removes the render blockers.'],
                        ['name' => 'Re-measure and iterate', 'text' => 'After every change, re-run the tests and watch the trend. A 1-second LCP improvement can lift conversion rate by 5-10% — speed is not a checkbox, it is a sales channel.'],
                    ],
                ],
            ],

            'buget-marketing-business-mic' => [
                'slug' => 'buget-marketing-business-mic',
                'category' => 'strategy',
                'date' => '2026-04-02',
                'read_minutes' => 7,
                'author' => 'Echipa AddWrap',
                'featured' => false,
                'ro' => [
                    'title' => 'Bugetul de marketing pentru un business mic: cum îl împarți corect',
                    'excerpt' => 'Nu ai nevoie de un buget mare, ci de unul bine împărțit. Iată un cadru simplu pentru a aloca fiecare leu acolo unde aduce cel mai mult.',
                    'blocks' => [
                        ['type' => 'paragraph', 'text' => 'Pentru un business mic, marketingul pare adesea o cheltuială riscantă. Dar problema rareori e suma, ci felul în care e împărțită. Un buget mic, bine direcționat, bate un buget mare risipit.'],
                        ['type' => 'heading', 'text' => 'Regula celor trei direcții'],
                        ['type' => 'paragraph', 'text' => 'Împarte bugetul între fundație, atragere și optimizare. Fundația e brandul și site-ul. Atragerea e publicitatea și conținutul. Optimizarea e ce înveți din date și reinvestești.'],
                        ['type' => 'list', 'items' => [
                            'Fundație: identitate de brand și un site care convertește.',
                            'Atragere: campanii plătite și conținut constant.',
                            'Optimizare: măsurare, testare și ajustare lunară.',
                        ]],
                        ['type' => 'heading', 'text' => 'Începe mic, dar începe corect'],
                        ['type' => 'paragraph', 'text' => 'Nu trebuie să faci tot odată. Mai bine pui bazele solid pe un singur canal și îl duci la capăt, decât să împrăștii bugetul pe cinci canale făcute pe jumătate.'],
                        ['type' => 'quote', 'text' => 'Marketingul nu e o cheltuială, ci un sistem: pui ceva la intrare, măsori la ieșire și ajustezi.'],
                    ],
                    'howto_steps' => [
                        ['name' => 'Pune fundația brand + site', 'text' => 'Înainte de orice ad, investește în identitate de brand coerentă și într-un site care convertește. Fără aceste două, restul investițiilor curg apă — niciun click plătit nu salvează un site lent sau un mesaj confuz.'],
                        ['name' => 'Aloca bugetul pe atragere', 'text' => 'Pune între 50% și 70% din bugetul lunar în campanii plătite (Google sau Meta) și conținut constant. Atragerea aduce primii vizitatori și primele lead-uri într-un interval previzibil.'],
                        ['name' => 'Optimizează lunar pe baza datelor', 'text' => 'Lunar, măsoară cost/lead per canal și fă mai mult din ce funcționează. 10-20% din buget rămân pentru testare — experimente pe care le poți închide dacă nu performează.'],
                    ],
                ],
                'en' => [
                    'title' => 'Marketing budget for a small business: how to split it right',
                    'excerpt' => 'You do not need a big budget, you need a well-split one. Here is a simple framework to put every euro where it brings the most.',
                    'blocks' => [
                        ['type' => 'paragraph', 'text' => 'For a small business, marketing often feels like a risky expense. But the problem is rarely the amount, it is how it is split. A small, well-directed budget beats a big, wasted one.'],
                        ['type' => 'heading', 'text' => 'The rule of three directions'],
                        ['type' => 'paragraph', 'text' => 'Split your budget between foundation, attraction and optimization. The foundation is your brand and website. Attraction is advertising and content. Optimization is what you learn from data and reinvest.'],
                        ['type' => 'list', 'items' => [
                            'Foundation: brand identity and a website that converts.',
                            'Attraction: paid campaigns and consistent content.',
                            'Optimization: monthly measuring, testing and adjusting.',
                        ]],
                        ['type' => 'heading', 'text' => 'Start small, but start right'],
                        ['type' => 'paragraph', 'text' => 'You do not have to do everything at once. It is better to lay solid foundations on a single channel and see it through than to scatter your budget across five half-done channels.'],
                        ['type' => 'quote', 'text' => 'Marketing is not an expense, it is a system: you put something in, measure the output and adjust.'],
                    ],
                    'howto_steps' => [
                        ['name' => 'Lay the brand + site foundation', 'text' => 'Before any ad, invest in coherent brand identity and a website that converts. Without these two, the rest of the spend leaks away — no paid click saves a slow site or a confused message.'],
                        ['name' => 'Allocate the budget to attraction', 'text' => 'Put 50-70% of the monthly budget into paid campaigns (Google or Meta) and consistent content. Attraction brings your first visitors and first leads within a predictable timeframe.'],
                        ['name' => 'Optimize monthly based on data', 'text' => 'Each month, measure cost per lead by channel and do more of what works. Keep 10-20% of the budget for testing — experiments you can shut down quickly if they do not perform.'],
                    ],
                ],
            ],

        ];
    }
}
