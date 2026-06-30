@php
    use App\Support\Localization;
    $services = Localization::services();
    $company = config('site.company');
    $social = $company['social'] ?? [];
    $socialIcons = [
        'facebook' => '<path d="M22 12a10 10 0 10-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.78-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99A10 10 0 0022 12z" />',
        'instagram' => '<path fill="none" stroke="currentColor" stroke-width="1.8" d="M7 3h10a4 4 0 014 4v10a4 4 0 01-4 4H7a4 4 0 01-4-4V7a4 4 0 014-4z" /><circle cx="12" cy="12" r="3.2" fill="none" stroke="currentColor" stroke-width="1.8" /><circle cx="17.2" cy="6.8" r="1.1" />',
        'whatsapp' => '<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.71.306 1.263.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.885-9.885 9.885m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />',
    ];
@endphp

<footer class="border-t border-zinc-200 bg-paper">
    <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-16">
        <div class="grid grid-cols-2 gap-x-8 gap-y-10 lg:grid-cols-12 lg:gap-8">

            {{-- Brand + social --}}
            <div class="col-span-2 lg:col-span-4">
                <a href="{{ Localization::route('home') }}" class="flex items-center justify-center text-ink lg:justify-start" aria-label="{{ $company['name'] }}">
                    {{-- Desktop + mobil: lockup complet (marcă + wordmark) --}}
                    <img src="{{ asset('images/logo/addwrap-logo.png') }}" alt="{{ $company['name'] }}" width="900" height="422" loading="lazy" decoding="async" class="h-16 w-auto" />
                </a>
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-muted">{{ __('messages.footer.tagline') }}</p>

                @if (! empty($social))
                    <div class="mt-6 flex items-center gap-3">
                        @foreach ($social as $network => $url)
                            @continue(empty($socialIcons[$network]))
                            <a href="{{ $url }}" @if ($url !== '#') target="_blank" rel="noopener noreferrer" @endif
                                aria-label="{{ ucfirst($network) }}"
                                class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-zinc-200 text-zinc-600 transition hover:border-zinc-900 hover:bg-zinc-900 hover:text-white">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">{!! $socialIcons[$network] !!}</svg>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Servicii --}}
            <div class="lg:col-span-2">
                <h2 class="text-sm font-bold uppercase tracking-wider text-ink">{{ __('messages.footer.services_title') }}</h2>
                <ul class="mt-4 space-y-3 text-sm lg:space-y-2">
                    @foreach ($services as $key => $service)
                        <li><a href="{{ Localization::serviceUrl($key) }}" class="block text-zinc-600 transition hover:text-ink">{{ __('services.items.'.$key.'.name') }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Companie --}}
            <div class="lg:col-span-2">
                <h2 class="text-sm font-bold uppercase tracking-wider text-ink">{{ __('messages.footer.company_title') }}</h2>
                <ul class="mt-4 space-y-3 text-sm lg:space-y-2">
                    <li><a href="{{ Localization::route('about') }}" class="block text-zinc-600 transition hover:text-ink">{{ __('messages.nav.about') }}</a></li>
                    <li><a href="{{ Localization::route('portfolio') }}" class="block text-zinc-600 transition hover:text-ink">{{ __('messages.nav.portfolio') }}</a></li>
                    <li><a href="{{ Localization::route('blog') }}" class="block text-zinc-600 transition hover:text-ink">{{ __('messages.nav.blog') }}</a></li>
                    <li><a href="{{ Localization::route('pricing') }}" class="block text-zinc-600 transition hover:text-ink">{{ __('messages.nav.pricing') }}</a></li>
                    <li><a href="{{ Localization::route('faq') }}" class="block text-zinc-600 transition hover:text-ink">{{ __('messages.nav.faq') }}</a></li>
                    <li><a href="{{ Localization::route('contact') }}" class="block text-zinc-600 transition hover:text-ink">{{ __('messages.nav.contact') }}</a></li>
                </ul>
            </div>

            {{-- Legal --}}
            <div class="lg:col-span-2">
                <h2 class="text-sm font-bold uppercase tracking-wider text-ink">{{ __('messages.footer.legal_title') }}</h2>
                <ul class="mt-4 space-y-3 text-sm lg:space-y-2">
                    <li><a href="{{ Localization::route('terms') }}" class="block text-zinc-600 transition hover:text-ink">{{ __('seo.terms.title') }}</a></li>
                    <li><a href="{{ Localization::route('privacy') }}" class="block text-zinc-600 transition hover:text-ink">{{ __('seo.privacy.title') }}</a></li>
                    <li><a href="{{ Localization::route('cookies') }}" class="block text-zinc-600 transition hover:text-ink">{{ __('seo.cookies.title') }}</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="lg:col-span-2">
                <h2 class="text-sm font-bold uppercase tracking-wider text-ink">{{ __('messages.footer.contact_title') }}</h2>
                <ul class="mt-4 space-y-3 text-sm lg:space-y-2">
                    <li><a href="mailto:{{ $company['email'] }}" class="block break-all text-zinc-600 transition hover:text-ink">{{ $company['email'] }}</a></li>
                    <li><a href="tel:{{ preg_replace('/\s+/', '', $company['phone']) }}" class="block text-zinc-600 transition hover:text-ink">{{ $company['phone'] }}</a></li>
                </ul>
            </div>
        </div>

        {{-- Bara de jos --}}
        <div class="mt-12 border-t border-zinc-200 pt-8 text-center text-sm text-muted">
            <p>&copy; {{ date('Y') }} {{ $company['name'] }}. {{ __('messages.footer.rights') }}</p>
        </div>
    </div>
</footer>
