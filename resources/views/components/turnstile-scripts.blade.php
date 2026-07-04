@use('App\Support\Turnstile')

@if (Turnstile::enabled())
    {{-- Încărcat prin @push('scripts') din paginile cu formulare (contact, home).
         Paginile se randează complet la load, deci scriptul e prezent din prima și
         supraviețuiește schimbărilor de pas Livewire (project-starter). --}}
    @once
        <script>
            window.awTsReady = false;
            window.awTsQueue = [];
            window.awTsOnload = function () {
                window.awTsReady = true;
                window.awTsQueue.forEach(function (fn) { fn(); });
                window.awTsQueue = [];
            };
            document.addEventListener('alpine:init', function () {
                window.Alpine.data('awTurnstile', function () {
                    return {
                        id: null,
                        mount() {
                            var self = this;
                            var render = function () {
                                if (! window.turnstile || ! self.$refs.widget) { return; }
                                self.id = window.turnstile.render(self.$refs.widget, {
                                    sitekey: @js(config('site.turnstile.site_key')),
                                    theme: 'light',
                                    callback: function (token) { self.$wire.set('turnstileToken', token, false); },
                                    'error-callback': function () { self.$wire.set('turnstileToken', '', false); },
                                    'expired-callback': function () { self.$wire.set('turnstileToken', '', false); },
                                });
                            };
                            window.awTsReady ? render() : window.awTsQueue.push(render);
                            self.$wire.on('turnstile-reset', function () {
                                if (self.id !== null && window.turnstile) {
                                    window.turnstile.reset(self.id);
                                    self.$wire.set('turnstileToken', '', false);
                                }
                            });
                        },
                    };
                });
            });
        </script>
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?onload=awTsOnload&render=explicit" async defer></script>
    @endonce
@endif
