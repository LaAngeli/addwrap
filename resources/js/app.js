// Clasa .js e adăugată sincron, inline, în <head> (layouts/app.blade.php) —
// nu aici, fiindcă acest bundle e type="module" (deferred) și ar rula prea
// târziu față de primul paint.

import './animations';

/**
 * Banner de consimțământ cookies (GDPR + Google Consent Mode v2).
 * Alpine este încărcat de Livewire; ne înregistrăm la evenimentul alpine:init.
 */
document.addEventListener('alpine:init', () => {
    window.Alpine.data('cookieConsent', () => ({
        storageKey: 'addwrap_consent',
        open: false,
        showPrefs: false,
        prefs: { analytics: false, marketing: false },

        init() {
            const stored = this.read();

            if (!stored) {
                this.open = true;
            } else {
                this.prefs = {
                    analytics: !!stored.analytics,
                    marketing: !!stored.marketing,
                };
            }
        },

        read() {
            try {
                return JSON.parse(window.localStorage.getItem(this.storageKey) || 'null');
            } catch (e) {
                return null;
            }
        },

        gtagUpdate(data) {
            if (typeof window.gtag === 'function') {
                window.gtag('consent', 'update', {
                    ad_storage: data.marketing ? 'granted' : 'denied',
                    ad_user_data: data.marketing ? 'granted' : 'denied',
                    ad_personalization: data.marketing ? 'granted' : 'denied',
                    analytics_storage: data.analytics ? 'granted' : 'denied',
                });
            }

            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: 'cookie_consent_update',
                consent: { analytics: data.analytics, marketing: data.marketing },
            });
        },

        persist(choice) {
            const data = {
                choice: choice,
                analytics: this.prefs.analytics,
                marketing: this.prefs.marketing,
                ts: Date.now(),
            };

            try {
                window.localStorage.setItem(this.storageKey, JSON.stringify(data));
            } catch (e) {
                // localStorage indisponibil — continuăm fără persistență
            }

            this.gtagUpdate(data);
            this.open = false;
            this.showPrefs = false;
        },

        acceptAll() {
            this.prefs = { analytics: true, marketing: true };
            this.persist('accepted');
        },

        rejectAll() {
            this.prefs = { analytics: false, marketing: false };
            this.persist('rejected');
        },

        savePrefs() {
            this.persist('custom');
        },
    }));
});
