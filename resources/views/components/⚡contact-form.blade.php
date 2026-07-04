<?php

use App\Mail\ContactConfirmationMail;
use App\Mail\ContactFormMail;
use App\Support\Localization;
use App\Support\Turnstile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Livewire\Component;

new class extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $service = '';

    public string $message = '';

    public bool $consent = false;

    /** Honeypot anti-spam: trebuie să rămână gol. */
    public string $website = '';

    /** Token Cloudflare Turnstile (setat client-side de widget, verificat în submit). */
    public string $turnstileToken = '';

    /**
     * Pre-completează formularul din parametrii primiți de la calculatorul de buget
     * (ex: /contact?services=web-development,seo-aeo-geo&months=6).
     */
    public function mount(): void
    {
        $valid = array_keys(config('site.services'));

        $services = collect(explode(',', (string) request()->query('services', '')))
            ->map(fn (string $s): string => trim($s))
            ->filter(fn (string $s): bool => in_array($s, $valid, true))
            ->unique()
            ->values();

        if ($services->isEmpty()) {
            return;
        }

        $this->service = $services->first();

        $names = $services->map(fn (string $k): string => __('services.items.'.$k.'.name'))->implode(', ');
        $lines = [__('contact.prefill_intro').' '.$names.'.'];

        $months = (int) request()->query('months', 0);
        if (in_array($months, [3, 6, 12], true)) {
            $lines[] = __('contact.prefill_duration').': '.$months.' '.__('calculator.months_unit').'.';
        }

        $this->message = implode("\n", $lines);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:120', 'regex:/^[\p{L}\p{M}\s.\'-]+$/u'],
            'email' => ['required', 'string', 'email:rfc,strict', 'max:180'],
            'phone' => ['required', 'string', 'regex:/^\+?[0-9\s().-]{7,20}$/'],
            'service' => ['nullable', Rule::in(array_merge([''], array_keys(config('site.services')), [Localization::OTHER_SERVICE]))],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
            'consent' => ['accepted'],
            'website' => ['prohibited'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'name.regex' => __('contact.errors.name_invalid'),
            'phone.regex' => __('contact.errors.phone_invalid'),
            'service.in' => __('contact.errors.service_invalid'),
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function validationAttributes(): array
    {
        return [
            'name' => __('contact.fields.name'),
            'email' => __('contact.fields.email'),
            'phone' => __('contact.fields.phone'),
            'service' => __('contact.fields.service'),
            'message' => __('contact.fields.message'),
            'consent' => __('contact.fields.consent'),
        ];
    }

    public function submit()
    {
        // Honeypot: dacă a fost completat, e bot.
        if ($this->website !== '') {
            $this->addError('form', __('contact.spam_detected'));

            return null;
        }

        // Rate limiting per IP (5 trimiteri / minut).
        $key = 'contact-form:'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('form', __('contact.rate_limited'));

            return null;
        }

        $validated = $this->validate();

        // Anti-spam Turnstile (verificat după validare, ca token-ul să fie consumat
        // doar când restul formularului e valid). Inactiv dacă nu sunt chei în env.
        if (! Turnstile::verify($this->turnstileToken, request()->ip())) {
            $this->addError('form', __('contact.errors.turnstile'));
            $this->dispatch('turnstile-reset');

            return null;
        }

        RateLimiter::hit($key, 60);

        $locale = Localization::current();

        // Mesajul către business — prioritar. Dacă acesta cade, e o eroare reală
        // și o lăsăm să propage (utilizatorul rămâne pe formular cu state intact).
        Mail::to(config('site.company.email'))->send(new ContactFormMail($validated));

        // Confirmare către expeditor — best-effort. Dacă SMTP-ul refuză adresa
        // (typo, mailbox plin), nu invalidăm lead-ul: îl logăm și mergem mai departe.
        try {
            Mail::to($validated['email'])
                ->locale($locale)
                ->send(new ContactConfirmationMail($validated));
        } catch (\Throwable $e) {
            Log::warning('Contact confirmation email failed', [
                'email' => $validated['email'],
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->to(Localization::route('thank_you'));
    }
};
?>

<form wire:submit="submit" class="space-y-5" novalidate>
    {{-- Honeypot (ascuns pentru utilizatori, momeală pentru boți) --}}
    <div class="hidden" aria-hidden="true">
        <label>Website<input type="text" wire:model="website" tabindex="-1" autocomplete="off"></label>
    </div>

    @error('form')
        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ $message }}</div>
    @enderror

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <div>
            <label for="cf-name" class="block text-sm font-medium text-ink">{{ __('contact.fields.name') }}</label>
            <input type="text" id="cf-name" wire:model="name" autocomplete="name" maxlength="120" placeholder="{{ __('contact.placeholders.name') }}" class="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-900 focus:ring-2 focus:ring-zinc-200 focus:outline-none">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="cf-email" class="block text-sm font-medium text-ink">{{ __('contact.fields.email') }}</label>
            <input type="email" id="cf-email" wire:model="email" autocomplete="email" inputmode="email" maxlength="180" placeholder="{{ __('contact.placeholders.email') }}" class="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-900 focus:ring-2 focus:ring-zinc-200 focus:outline-none">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="cf-phone" class="block text-sm font-medium text-ink">{{ __('contact.fields.phone') }}</label>
            <input type="tel" id="cf-phone" wire:model="phone" autocomplete="tel" inputmode="tel" maxlength="30" placeholder="{{ __('contact.placeholders.phone') }}" class="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-900 focus:ring-2 focus:ring-zinc-200 focus:outline-none">
            @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="cf-service" class="block text-sm font-medium text-ink">{{ __('contact.fields.service') }}</label>
            <select id="cf-service" wire:model="service" class="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-900 focus:ring-2 focus:ring-zinc-200 focus:outline-none">
                <option value="">{{ __('contact.service_default') }}</option>
                @foreach (App\Support\Localization::services() as $key => $service)
                    <option wire:key="cf-opt-{{ $key }}" value="{{ $key }}">{{ __('services.items.'.$key.'.name') }}</option>
                @endforeach
                <option wire:key="cf-opt-other" value="{{ App\Support\Localization::OTHER_SERVICE }}">{{ __('contact.service_other') }}</option>
            </select>
            @error('service') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="cf-message" class="block text-sm font-medium text-ink">{{ __('contact.fields.message') }}</label>
        <textarea id="cf-message" wire:model="message" rows="5" maxlength="3000" placeholder="{{ __('contact.placeholders.message') }}" class="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-zinc-900 focus:ring-2 focus:ring-zinc-200 focus:outline-none"></textarea>
        @error('message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="flex items-start gap-3 text-sm text-zinc-700">
            <input type="checkbox" wire:model="consent" class="mt-0.5 h-4 w-4 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-500">
            <span>{!! __('contact.consent_label', ['privacy' => '<a href="'.App\Support\Localization::route('privacy').'" class="text-zinc-900 underline hover:text-black">'.__('contact.consent_link').'</a>']) !!}</span>
        </label>
        @error('consent') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <x-turnstile />

    <button type="submit" wire:loading.attr="disabled" class="inline-flex items-center gap-2 rounded-lg bg-orange px-6 py-3 text-base font-semibold text-white transition hover:bg-orange-deep disabled:opacity-60">
        <span wire:loading.remove wire:target="submit">{{ __('contact.submit') }}</span>
        <span wire:loading wire:target="submit">{{ __('contact.sending') }}</span>
    </button>
</form>
