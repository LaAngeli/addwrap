<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Localization
{
    /**
     * Sentinelă pentru opțiunea "Altceva" din formularul de contact — nu e un
     * serviciu real din config('site.services'), doar un fallback pentru
     * solicitări care nu se încadrează în lista de servicii.
     */
    public const OTHER_SERVICE = 'other';

    /**
     * Locale-ul curent al aplicației.
     */
    public static function current(): string
    {
        return app()->getLocale();
    }

    /**
     * Toate locale-urile disponibile.
     *
     * @return array<int, string>
     */
    public static function all(): array
    {
        return config('site.locales', ['ro']);
    }

    /**
     * Generează URL pentru o rută din locale-ul curent (sau cel indicat).
     * $name este numele de bază al rutei, fără prefixul de locale (ex: "services.index").
     *
     * @param  array<string, mixed>  $parameters
     */
    public static function route(string $name, array $parameters = [], ?string $locale = null): string
    {
        $locale ??= self::current();

        return route($locale.'.'.$name, $parameters);
    }

    /**
     * URL-ul paginii curente în locale-ul țintă (pentru language switcher).
     * Remapază slug-ul serviciului atunci când suntem pe o pagină de serviciu.
     */
    public static function switchUrl(string $target): string
    {
        $current = Route::current();
        $name = $current?->getName();

        if ($name === null) {
            return self::route('home', [], $target);
        }

        $baseName = Str::after($name, '.');
        $parameters = $current->parameters();

        if (isset($parameters['service'])) {
            $parameters['service'] = self::serviceSlugFor(
                self::serviceKeyFromSlug($parameters['service']),
                $target
            ) ?? $parameters['service'];
        }

        return self::route($baseName, $parameters, $target);
    }

    /**
     * Lista serviciilor din config.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function services(): array
    {
        return config('site.services', []);
    }

    /**
     * URL-ul unei subpagini de serviciu, după cheia internă.
     */
    public static function serviceUrl(string $key, ?string $locale = null): string
    {
        $locale ??= self::current();

        return self::route('services.show', [
            'service' => self::serviceSlugFor($key, $locale),
        ], $locale);
    }

    /**
     * Slug-ul unui serviciu pentru un locale dat.
     */
    public static function serviceSlugFor(?string $key, string $locale): ?string
    {
        if ($key === null) {
            return null;
        }

        return config("site.services.{$key}.slug.{$locale}");
    }

    /**
     * Cheia internă a serviciului pornind de la slug-ul din locale-ul curent.
     */
    public static function serviceKeyFromSlug(string $slug, ?string $locale = null): ?string
    {
        $locale ??= self::current();

        foreach (self::services() as $key => $service) {
            if (($service['slug'][$locale] ?? null) === $slug) {
                return $key;
            }
        }

        return null;
    }

    /**
     * Eticheta de afișare a unui serviciu selectat în formular, inclusiv
     * sentinela OTHER_SERVICE (care nu există în site.services).
     */
    public static function serviceName(string $key): string
    {
        if ($key === self::OTHER_SERVICE) {
            return (string) trans('contact.service_other');
        }

        return (string) trans('services.items.'.$key.'.name');
    }
}
