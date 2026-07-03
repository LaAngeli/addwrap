<?php

declare(strict_types=1);

namespace App\Support;

class Media
{
    /**
     * URL cu cache-busting pentru un logo de partener din public/images/partners.
     * Versiunea = mtime-ul fișierului; astfel, la orice reprocesare a logo-ului
     * (păstrând același nume de fișier), browserele și vizitatorii revenind pe site
     * primesc automat versiunea nouă, fără hard-refresh.
     */
    public static function partnerLogo(string $slug, bool $color = false): string
    {
        $path = 'images/partners/'.$slug.($color ? '-color' : '').'.png';
        $version = @filemtime(public_path($path));

        return asset($path).($version ? '?v='.$version : '');
    }
}
