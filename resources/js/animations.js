import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

/**
 * Animații de reveal pentru elementele marcate cu [data-animate].
 * Variante: fade-up, fade-in, scale-in.
 * Respectă prefers-reduced-motion (CSS face deja fallback la opacity:1).
 */
document.addEventListener('DOMContentLoaded', () => {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const elements = gsap.utils.toArray('[data-animate]');

    if (prefersReducedMotion || elements.length === 0) {
        gsap.set(elements, { opacity: 1, clearProps: 'transform' });
        return;
    }

    const variants = {
        'fade-up': { opacity: 0, y: 28 },
        'fade-in': { opacity: 0 },
        'scale-in': { opacity: 0, scale: 0.96 },
    };

    elements.forEach((el) => {
        const type = el.dataset.animate || 'fade-up';
        const from = variants[type] || variants['fade-up'];
        const delay = parseFloat(el.dataset.animateDelay || '0');

        gsap.set(el, from);

        ScrollTrigger.create({
            trigger: el,
            start: 'top 88%',
            once: true,
            onEnter: () => {
                gsap.to(el, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 0.7,
                    delay,
                    ease: 'power2.out',
                });
            },
        });
    });

    // Reveal în grup pentru containere cu [data-animate-group] (stagger pe copii direcți)
    gsap.utils.toArray('[data-animate-group]').forEach((group) => {
        const children = gsap.utils.toArray(':scope > *', group);
        gsap.set(children, { opacity: 0, y: 24 });
        ScrollTrigger.create({
            trigger: group,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                gsap.to(children, {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    ease: 'power2.out',
                    stagger: 0.08,
                });
            },
        });
    });

    // Fonturile (Instrument Sans, self-hostate) se pot încărca după acest
    // moment și reflow-ui ușor layout-ul (lățimi de text ușor diferite
    // față de fallback-ul de sistem). Fără acest refresh, pozițiile de
    // trigger calculate mai sus rămân bazate pe layout-ul dinaintea
    // fontului final, ceea ce poate desincroniza reveal-urile de sub fold.
    if (document.fonts) {
        document.fonts.ready.then(() => ScrollTrigger.refresh());
    }
});
