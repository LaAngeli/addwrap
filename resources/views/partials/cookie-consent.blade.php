@php use App\Support\Localization; @endphp

<div
    x-data="cookieConsent"
    x-show="open"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-y-6 opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    class="fixed inset-x-0 bottom-0 z-50 p-4 sm:p-6"
    role="dialog"
    aria-modal="true"
    aria-label="{{ __('messages.cookie.title') }}"
>
    <div class="mx-auto max-w-3xl rounded-2xl border border-zinc-200 bg-white p-5 shadow-2xl sm:p-6">

        <div class="flex items-start gap-3">
            <span class="mt-0.5 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-zinc-900 text-white">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 2a10 10 0 1010 10 4 4 0 01-5-5 4 4 0 01-5-5zm-3 9h.01M15 14h.01M10 16h.01" /></svg>
            </span>
            <div>
                <h2 class="text-base font-semibold text-ink">{{ __('messages.cookie.title') }}</h2>
                <p class="mt-1 text-sm leading-relaxed text-muted">
                    {!! __('messages.cookie.text', ['policy' => '<a href="'.Localization::route('cookies').'" class="font-medium text-ink underline underline-offset-2 hover:text-black">'.__('messages.cookie.policy').'</a>']) !!}
                </p>
            </div>
        </div>

        {{-- Preferințe granulare --}}
        <div x-show="showPrefs" x-collapse x-cloak class="mt-5 space-y-4 border-t border-zinc-200 pt-5">
            <p class="text-sm font-semibold uppercase tracking-wider text-muted">{{ __('messages.cookie.prefs_title') }}</p>

            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-ink">{{ __('messages.cookie.necessary') }}</p>
                    <p class="text-sm text-muted">{{ __('messages.cookie.necessary_desc') }}</p>
                </div>
                <span class="shrink-0 text-xs font-semibold text-muted">{{ __('messages.cookie.always_on') }}</span>
            </div>

            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-ink">{{ __('messages.cookie.analytics') }}</p>
                    <p class="text-sm text-muted">{{ __('messages.cookie.analytics_desc') }}</p>
                </div>
                <button type="button" role="switch" :aria-checked="prefs.analytics" @click="prefs.analytics = !prefs.analytics"
                    class="relative h-6 w-11 shrink-0 rounded-full transition" :class="prefs.analytics ? 'bg-zinc-900' : 'bg-zinc-300'">
                    <span class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white transition-transform" :class="prefs.analytics ? 'translate-x-5' : ''"></span>
                </button>
            </div>

            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-ink">{{ __('messages.cookie.marketing') }}</p>
                    <p class="text-sm text-muted">{{ __('messages.cookie.marketing_desc') }}</p>
                </div>
                <button type="button" role="switch" :aria-checked="prefs.marketing" @click="prefs.marketing = !prefs.marketing"
                    class="relative h-6 w-11 shrink-0 rounded-full transition" :class="prefs.marketing ? 'bg-zinc-900' : 'bg-zinc-300'">
                    <span class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white transition-transform" :class="prefs.marketing ? 'translate-x-5' : ''"></span>
                </button>
            </div>
        </div>

        {{-- Acțiuni --}}
        <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <button type="button" @click="showPrefs = !showPrefs" class="text-sm font-medium text-muted underline-offset-2 transition hover:text-ink hover:underline">
                {{ __('messages.cookie.settings') }}
            </button>

            <div class="flex flex-col gap-3 sm:flex-row">
                <button type="button" @click="rejectAll()" class="w-full rounded-lg border border-zinc-300 px-5 py-2.5 text-sm font-semibold text-ink transition hover:bg-zinc-50 sm:w-auto">
                    {{ __('messages.cookie.reject') }}
                </button>
                <button type="button" x-show="showPrefs" @click="savePrefs()" class="w-full rounded-lg border border-zinc-300 px-5 py-2.5 text-sm font-semibold text-ink transition hover:bg-zinc-50 sm:w-auto">
                    {{ __('messages.cookie.save') }}
                </button>
                <button type="button" @click="acceptAll()" class="w-full rounded-lg bg-zinc-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-black sm:w-auto">
                    {{ __('messages.cookie.accept') }}
                </button>
            </div>
        </div>
    </div>
</div>
