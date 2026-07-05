<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.3
- laravel/framework (LARAVEL) - v13
- laravel/prompts (PROMPTS) - v0
- livewire/livewire (LIVEWIRE) - v4
- laravel/boost (BOOST) - v2
- laravel/mcp (MCP) - v0
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- pestphp/pest (PEST) - v4
- phpunit/phpunit (PHPUNIT) - v12
- tailwindcss (TAILWINDCSS) - v4

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== livewire/core rules ===

# Livewire

- Livewire allow to build dynamic, reactive interfaces in PHP without writing JavaScript.
- You can use Alpine.js for client-side interactions instead of JavaScript frameworks.
- Keep state server-side so the UI reflects it. Validate and authorize in actions as you would in HTTP requests.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

## Pest

- This project uses Pest for testing. Create tests: `php artisan make:test --pest {name}`.
- The `{name}` argument should not include the test suite directory. Use `php artisan make:test --pest SomeFeatureTest` instead of `php artisan make:test --pest Feature/SomeFeatureTest`.
- Run tests: `php artisan test --compact` or filter: `php artisan test --compact --filter=testName`.
- Do NOT delete tests without approval.

</laravel-boost-guidelines>

---

# Project Command Shortcuts

## Shortcut: "update live"

When the user says `update live`, Claude should run the local update workflow for GitHub/shared hosting deployment.

### Required workflow

1. Go to the project root:

```powershell
cd C:\Users\LaAngeli\Documents\WebSites\addwrap
```

2. Check the current state before doing anything else:

```powershell
git status
git diff --stat
```

3. Decide whether a frontend build is needed.

Run `npm run build` only if frontend-related files were modified, including:

```text
resources/css
resources/js
vite.config.js
tailwind.config.js
package.json
package-lock.json
```

If frontend files were modified, run:

```powershell
npm run build
```

4. Check Git status again:

```powershell
git status
```

5. If there are changes, create a relevant commit message based on the actual modified files.

Use this flow:

```powershell
git add .
git commit -m "Relevant commit message based on the actual changes"
git push origin main
```

6. **Deploy on the LIVE server** (Hostinger) — pull the just-pushed code and rebuild caches.

The site runs at `https://add-wrap.ro`; the code lives in `.../app` (web root `public_html` is a symlink to `app/public`). See [[project-deploy-hostinger]] for the full layout. Run this via the **Bash tool** (not PowerShell — it's an SSH session using the dedicated key):

```bash
ssh -i ~/.ssh/hostinger_addwrap -o BatchMode=yes -p 65002 u686621605@82.198.230.72 '
  cd /home/u686621605/domains/add-wrap.ro/app || exit 1
  git pull origin main
  # composer install DOAR daca s-a schimbat composer.lock in acest push:
  git diff --name-only HEAD@{1} HEAD | grep -q "^composer.lock$" && composer install --no-dev --optimize-autoloader --no-interaction
  php artisan config:cache && php artisan route:cache && php artisan view:cache
  echo "DEPLOY_DONE"
'
```

Then verify the live site is healthy (at least the homepage returns 200; from Windows curl add `--ssl-no-revoke`):

```bash
curl -sS --ssl-no-revoke -o /dev/null -w "live HTTP=%{http_code}\n" https://add-wrap.ro/
```

### Rules

- If there are no changes, do not create a commit **and do not run the server deploy** (nothing new to pull).
- If `npm run build` fails, stop and explain the error before continuing.
- If Git reports conflicts or errors (local OR on the server `git pull`), stop and explain the issue before continuing — never force.
- Never use `git push --force`.
- `public/build` is intentionally tracked in Git for this shared hosting workflow — so the server needs NO `npm`, only `git pull` + cache rebuild. `vendor` is NOT tracked, hence the conditional `composer install` when `composer.lock` changed.
- After frontend builds, `public/build` must be included in the commit.
- Before committing, always make sure `.env`, `vendor`, `node_modules`, logs, cache files and local IDE files are not being committed.
- The server `.env` is git-ignored and lives only on the server — `git pull` never touches it. If a change needs new/changed env vars, update the server `.env` separately (via `scp`/edit over SSH) and re-run `php artisan config:cache`.
- After the server deploy, if the live site returns 5xx, check `app/storage/logs/laravel.log` over SSH before assuming the pull was clean.

---

# Deploy — Email deliverability (configurare DNS, NU în cod)

> ✅ **Domeniul final este stabilit: `add-wrap.ro`** (atenție: cu cratimă — brandul rămâne „addWrap" fără cratimă). Email personalizat: `info@add-wrap.ro`. În cod, domeniul SEO/canonical se derivă 100% din `APP_URL` (nimic hardcodat), iar emailul afișat din `config('site.company.email')` / env `CONTACT_EMAIL`. Config-ul și `.env.example` au deja valorile reale; rămâne de setat `.env` de producție pe server + record-urile DNS de mai jos.

**`.env` de producție (pe server):**
```
APP_NAME=addWrap
APP_URL=https://add-wrap.ro
MAIL_FROM_ADDRESS=info@add-wrap.ro
CONTACT_EMAIL=info@add-wrap.ro
```
`APP_URL` E OBLIGATORIU pe server — din el ies canonical, og:url, sitemap, schema (`@id`-uri). Fără el corect, SEO-ul pointează spre domeniul greșit.

Configurează și următoarele **la nivel de DNS / panou hosting** (nu sunt modificări de cod):

1. **SPF** — record `TXT` pe `add-wrap.ro` care autorizează explicit serverul SMTP folosit (Hostinger SMTP implicit, sau alt provider dacă se schimbă) să trimită email în numele domeniului.
2. **DKIM** — semnătura criptografică generată din panoul SMTP-ului (de obicei `TXT default._domainkey.add-wrap.ro`).
3. **DMARC** — politică `TXT _dmarc.add-wrap.ro` pentru ce se întâmplă când SPF/DKIM eșuează. Pornește cu `p=none` (monitorizare) primele zile, apoi `p=quarantine`, abia apoi `p=reject` după ce rapoartele arată trafic curat.
4. **`MAIL_FROM_ADDRESS=info@add-wrap.ro`** — deja coerent cu domeniul propriu (nu Gmail/Yahoo). Inconsistența domeniu-site / domeniu-email scade scorul de încredere la Gmail/Outlook.
5. **Reply-To corect** — deja implementat în cod, nimic de schimbat la deploy:
   - [ContactFormMail::envelope()](app/Mail/ContactFormMail.php:23) — emailul către business are `replyTo` pe adresa expeditorului din formular, ca să răspunzi direct clientului.
   - [ContactConfirmationMail::envelope()](app/Mail/ContactConfirmationMail.php:25) — confirmarea către expeditor are `replyTo` pe adresa firmei.

**De ce contează**: fără SPF/DKIM/DMARC, Gmail și Outlook pun emailurile la Spam sau le resping tăcut, indiferent cât de bun e conținutul. Cele 3 record-uri DNS + adresa `From` coerentă sunt condiția minimă ca un email trimis programatic (formular de contact, confirmare) să ajungă în Inbox.

**Acțiune la deploy**: setează cele 4 variabile din `.env` de producție (mai sus) și configurează cele 3 record-uri DNS (SPF/DKIM/DMARC) pe `add-wrap.ro` la providerul ales.

---

# AddWrap — Convenții de proiect (default, învățate din Laravel Boost + deciziile clientului)

Aceste reguli se aplică la tot ce se construiește în AddWrap și au prioritate față de preferințele generice.

## Stack & compatibilitate
- Laravel 13, PHP 8.3, Livewire 4, Tailwind CSS v4, Vite, Alpine.js (vine cu Livewire — NU se include separat), GSAP, MySQL, SMTP.
- Compatibil shared hosting Hostinger: fără Redis, fără queue workers permanenți, `QUEUE_CONNECTION=sync`, cache/session pe `file`.
- Nu propune React, Vue, Inertia, Filament, Redis decât la cerere explicită.

## Localizare (RO principal / EN secundar)
- Soluție custom, fără pachet. RO pe rădăcină, EN cu prefix `/en`.
- Slug-uri rute în `config/site.php` (`routes.ro` / `routes.en`); rutele se înregistrează în buclă pe locale în `routes/web.php`, cu nume prefixate `ro.*` / `en.*`.
- Middleware `App\Http\Middleware\SetLocale` setează limba din URL.
- În Blade/PHP folosește helper-ul `App\Support\Localization` (`route()`, `switchUrl()`, `serviceUrl()`), nu `route()` direct cu nume hardcodate de locale.
- Toate textele, CTA-urile, meta title/description trec prin `__()` cu chei în `lang/ro` și `lang/en`. Orice text nou se adaugă în AMBELE limbi.

## Design
- Fundal pe **două tonuri teal** (2026): `--color-paper: #eef6f6` (turcoaz-deschis = pânza dominantă: body, navbar, TOATE secțiunile) + `--color-teal-ink: #06373f` (teal închis pentru benzi/panouri: CTA, panou-semnătură, plan izometric; gradientele de card folosesc și `--color-teal-deep: #00707c`). Teal-ul se folosește **DOAR pe fundaluri/secțiuni/grafică — NICIODATĂ pe butoane sau iconițe**. Fără al 3-lea ton viu (`#008f9f` `--color-teal` există ca token dar NU se aplică pe suprafețe mari).
- Accent = **portocaliu** `--color-orange: #f26c00` (butoane/CTA-uri). Carduri de conținut = **albe** (ies pe turcoaz). Chip-urile de iconițe = **închise** (`bg-zinc-900`). Text = `--color-ink`. Tokenii `--color-brand-*` (griuri neutre) rămân. Fără dark mode (site light-only, consecvent).
- Mobile-first, totul responsive. Spațiere cu utilitare `gap`, nu margini între frați.
- Animații: GSAP + ScrollTrigger via atribute `data-animate` / `data-animate-group`; parallax izometric via Alpine (`coworkAnimation`). Mereu respectă `prefers-reduced-motion` și ascunde efectele grele pe mobil.

## Mobile-first & performanță (PRIORITATE MAXIMĂ)
Experiența pe smartphone este prioritatea #1 a proiectului AddWrap. Majoritatea traficului unei agenții de marketing vine de pe mobil, deci fiecare pagină, secțiune și componentă se gândește, se structurează și se stilizează ÎNTÂI pentru mobil (~360–390px), apoi se îmbogățește pentru ecrane mari. Țintă: rapid, curat, fără bug-uri de layout și cu micro-interacțiuni plăcute („entertaining"), dar ușoare.

**Structură & layout**
- Mobile-first real: stilurile de bază (fără prefix) vizează telefonul; folosește `sm:`/`lg:` doar pentru a adăuga complexitate, nu pentru a o repara. Verifică mereu la 360 / 390 / 414px.
- Zero scroll orizontal. Fără lățimi fixe pe mobil; folosește `w-full`, `max-w-*`, `gap`, nu margini între frați. Conținutul se stivuiește pe o coloană, în ordinea logică de citire.
- Tipografie scalabilă: titluri mari dar nu uriașe pe mobil (`text-3xl` → `sm:text-4xl` → `lg:text-5xl`), `text-balance` pe titluri, lungime de rând confortabilă.

**Touch & UX**
- Ținte de atingere ≥ 44px, spațiere generoasă, CTA-uri ușor de apăsat cu degetul. Nu te baza pe `hover` (pe mobil nu există) — starea de bază trebuie să fie completă; `hover:` doar ca bonus pe desktop.
- Navigație: meniu mobil clar, switch de limbă accesibil, butoane importante la îndemână.

**Performanță pe smartphone**
- Ascunde sau simplifică efectele grele pe mobil (ex: planul izometric e ascuns sub `lg`). Animații GSAP/Alpine subtile, scurte, accelerate GPU (`transform`/`opacity`), cu `requestAnimationFrame` și `passive` listeners. Respectă MEREU `prefers-reduced-motion`.
- Media: `loading="lazy"` + `decoding="async"` la imagini, dimensiuni/format optimizate, fără asset-uri mari. Evită DOM excesiv (atenție la liste/marquee lungi).
- Menține bundle-ul mic: doar GSAP + Alpine (din Livewire); fără librării JS noi. Fonturi cu weight-uri limitate și `display: swap`. Țintă Core Web Vitals bune (LCP/INP/CLS) pe 4G.

**Experiență „entertaining" (cu măsură)**
- Reveal-uri la scroll discrete (`data-animate`), tranziții fine pe CTA-uri, feedback vizual la interacțiune — dar niciodată în detrimentul vitezei sau al lizibilității. Pe reduced-motion totul rămâne static și complet funcțional.

**Verificare (obligatoriu)**
- Pentru ORICE pagină/secțiune nouă sau modificată, verifică explicit aspectul și comportamentul pe mobil înainte de a considera task-ul gata: stivuire corectă, fără overflow, ținte de atingere ok, animații ușoare, fără cost de performanță inutil.

## Livewire (v4)
- Componente single-file (SFC) în `resources/views/components/` cu prefix `⚡`; randate ca `<livewire:nume />` (prefixul ⚡ e ignorat). Urmează convenția existentă a proiectului.
- `wire:key` pe toate buclele; `wire:model.live` pentru update instant; validează și autorizează în acțiuni (ca la HTTP). Tag-uri auto-închise.

## Cod (Boost best practices)
- Creează fișiere cu `php artisan make:*` când e posibil; respectă structura fișierelor surori.
- Form Request + `validated()` pentru validare; notație array pentru reguli.
- Controllere subțiri (logica în Action/Service classes); dependency injection prin constructor.
- Convenții nume: Controller/Model singular, rute plural, **nume rute snake_case cu puncte** (ex: `users.show_active`, nu `show-active`), view-uri kebab-case, metode camelCase.
- Preferă helperele `Str`, `Arr`, `Number`, `Uri` și sintaxa scurtă (`session()`, `now()`, `back()`, `->latest()`).
- Fără JS/CSS inline în Blade (excepție: stiluri 3D one-off care nu se pot exprima în Tailwind); fără HTML în clase PHP; fără comentarii inutile (excepție: fișiere de config).
- `vendor/bin/pint --dirty` după modificări PHP.

## Mediu de lucru al asistentului
- **Uneltele rulează DIRECT pe Windows-ul clientului** (Laragon): `php.exe`, `npm`, `git`, `python`, `magick` — toate funcționează. Deci build-ul, comenzile artisan/pint, testele, git și procesarea de imagini le rulează asistentul, NU clientul. (Nota veche „în sandbox nu există PHP/Composer / `npm run build` nu rulează aici" era ÎNVECHITĂ pentru acest setup — a fost corectată.)
- Site-ul local e servit la `https://addwrap.test` (Laragon/Apache) — folosește-l pentru verificări de render cu `curl -sk`. Pentru măsurători de layout pe mobil, pornește dev-server-ul prin Claude Preview (`.claude/launch.json`, config `laravel` pe :8000). Dacă portul 8000 e ocupat de o sesiune anterioară, adaugă temporar o config alt-port (`--port=8010`) și revino `.claude/launch.json` la loc după.
- Mount-ul bash poate fi out-of-sync pentru fișiere scrise prin file tools — Read tool e autoritativ.

## Automatizare după fiecare task (cerință explicită a clientului)
După FIECARE task încheiat cu succes, asistentul rulează singur (nu clientul), în ordine:
1. **`npm run build`** — DOAR dacă s-au atins fișiere frontend (`resources/css`, `resources/js`, `vite.config.js`, `tailwind.config.js`, `package.json`/`package-lock.json`, sau orice `.blade.php` care introduce clase Tailwind noi). Regenerează `public/build` (tracked în git pentru shared hosting). Dacă build-ul eșuează, oprește-te și raportează eroarea — nu comite build stricat.
2. **`php artisan optimize:clear`** — golește cache-urile stale (config/rute/view/compiled/event), ca local-ul să reflecte mereu ultimele modificări. NU rula `php artisan optimize` complet pe local — acela cache-uiește config/rute/view și BLOCHEAZĂ reflectarea editărilor Blade/`.env` până la următorul clear (optimizarea reală de producție se face pe SERVER, la deploy).
3. **Validare** — după modificări PHP: `vendor/bin/pint --dirty`. După modificări Blade: `php artisan view:cache`, apoi `php -l` pe fiecare `storage/framework/views/*.php`, apoi `php artisan view:clear` (IMPORTANT: `view:cache` compilează dar NU validează sintaxa PHP rezultată — erorile apar abia la render, deci `php -l` e obligatoriu). Rulează testele: `php artisan test --compact`.

## Deploy: automat vs. gated
Fluxul de deploy e shortcut-ul „update live" de mai sus (build dacă e nevoie → `git add` fișiere specifice → commit cu mesaj relevant bazat pe modificările reale → `git push origin main`).

- **Automat, fără să întrebi:** schimbări mici, sigure, deja verificate (fix-uri, config, conținut, refactor mic, optimizări responsive verificate cu măsurători).
- **GATED — clientul verifică local întâi, apoi dă „push":** schimbări vizuale mari (rebrand, sistem de culoare, pagini noi / redesign, layout major, conținut real despre firme identificabile). La astea, prezintă rezultatul + verificarea și AȘTEAPTĂ confirmarea înainte de push.
- **Staging chirurgical:** când clientul are editări proprii necomise în working tree, stage DOAR fișierele tale (`git add <fișiere>`, niciodată `git add -A` / `git add .`) ca să nu-i înghiți munca în progres. Excepție: dacă cere explicit „tot împreună". Dacă `npm run build` a recompilat un bundle din sursa necomisă a clientului (ex: JS), semnalează-i și întreabă cum procedezi.
- Niciodată `git push --force`, niciodată `--no-verify`. Dacă git raportează conflicte, oprește-te și explică.

## Corectitudine peste complezență (se aplică și aici)
Dacă o cerință are o problemă reală (tehnică, de securitate, SEO, UX, legal — ex: metrici inventate atribuite unor firme reale), spune-i clar clientului ÎNAINTE de a implementa și propune varianta corectă, argumentat. Nu împacheta corecțiile în complimente. Dacă cererea e corectă, „ok, fac" și mergi mai departe.