<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Verificare Cloudflare Turnstile pentru formulare.
 *
 * Config-driven: activ doar când ambele chei (site + secret) sunt setate în env.
 * Când e inactiv, verify() întoarce true (nu blochează nimic) — formularele rămân
 * protejate de honeypot + rate limiting.
 */
class Turnstile
{
    private const SITEVERIFY_URL = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

    /**
     * Turnstile e activ doar dacă ambele chei sunt configurate.
     */
    public static function enabled(): bool
    {
        return filled(config('site.turnstile.site_key'))
            && filled(config('site.turnstile.secret_key'));
    }

    /**
     * Validează token-ul la Cloudflare.
     *
     * - Dezactivat -> true (nu blochează).
     * - Token gol -> false (bot / widget nerezolvat).
     * - Eroare de rețea către Cloudflare -> fail-open (true) + log, ca un hiccup
     *   tranzitoriu al API-ului să nu blocheze clienți legitimi; honeypot +
     *   rate limiting rămân active ca plasă de siguranță.
     */
    public static function verify(?string $token, ?string $ip = null): bool
    {
        if (! self::enabled()) {
            return true;
        }

        if (blank($token)) {
            return false;
        }

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->post(self::SITEVERIFY_URL, array_filter([
                    'secret' => config('site.turnstile.secret_key'),
                    'response' => $token,
                    'remoteip' => $ip,
                ]));

            return $response->successful() && $response->json('success') === true;
        } catch (\Throwable $e) {
            Log::warning('Turnstile verify failed (fail-open)', ['error' => $e->getMessage()]);

            return true;
        }
    }
}
