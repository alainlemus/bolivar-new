import './bootstrap';

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

/* ------------------------------------------------------------------ */
/* Revelado al hacer scroll: [data-reveal], con escalonado vía --i      */
/* ------------------------------------------------------------------ */

const revealObserver = 'IntersectionObserver' in window && !reduceMotion
    ? new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            revealObserver.unobserve(entry.target);
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' })
    : null;

function scanReveal(root = document) {
    root.querySelectorAll('[data-reveal]:not(.is-visible):not([data-reveal-bound])').forEach((el) => {
        if (!revealObserver) {
            el.classList.add('is-visible');
            return;
        }
        el.setAttribute('data-reveal-bound', '');
        revealObserver.observe(el);
    });
}

/* ------------------------------------------------------------------ */
/* Contadores: [data-count="50"] data-suffix="+"                       */
/* ------------------------------------------------------------------ */

const countObserver = 'IntersectionObserver' in window
    ? new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            countObserver.unobserve(entry.target);
            animateCount(entry.target);
        });
    }, { threshold: 0.6 })
    : null;

function animateCount(el) {
    const target = Number(el.dataset.count);
    const suffix = el.dataset.suffix ?? '';
    const prefix = el.dataset.prefix ?? '';
    const div = Number(el.dataset.divide) || 1;
    const fmt = (n) => (el.dataset.format === 'money' ? n.toLocaleString('es-MX') : div > 1 ? (n / div).toFixed(1) : String(n));
    if (reduceMotion || Number.isNaN(target)) {
        el.textContent = `${prefix}${fmt(target)}${suffix}`;
        return;
    }
    // Reserva el ancho final para que el conteo no desplace el contenido (CLS)
    el.style.display = 'inline-block';
    el.style.minWidth = `${el.getBoundingClientRect().width}px`;
    const duration = 1600;
    const start = performance.now();
    const tick = (now) => {
        const t = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - t, 4);
        el.textContent = `${prefix}${fmt(Math.round(target * eased))}${suffix}`;
        if (t < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
}

function scanCounters(root = document) {
    root.querySelectorAll('[data-count]:not([data-count-bound])').forEach((el) => {
        el.setAttribute('data-count-bound', '');
        countObserver ? countObserver.observe(el) : (el.textContent = `${el.dataset.prefix ?? ''}${el.dataset.count}${el.dataset.suffix ?? ''}`);
    });
}

/* ------------------------------------------------------------------ */
/* Mapas (Leaflet se descarga solo cuando el mapa está por verse)       */
/* ------------------------------------------------------------------ */

let mapsModule = null;
const mapObserver = 'IntersectionObserver' in window
    ? new IntersectionObserver((entries) => {
        entries.forEach(async (entry) => {
            if (!entry.isIntersecting) return;
            mapObserver.unobserve(entry.target);
            mapsModule ??= import('./maps.js');
            const m = await mapsModule;
            const el = entry.target;
            el.hasAttribute('data-places-map') ? m.initPlacesMap(el) : m.initFuneralMap(el);
            el.classList.add('map-ready');
        });
    }, { rootMargin: '300px 0px' })
    : null;

function scanMaps(root = document) {
    root.querySelectorAll('[data-funeral-map]:not([data-map-bound]), [data-places-map]:not([data-map-bound])').forEach((el) => {
        el.setAttribute('data-map-bound', '');
        mapObserver?.observe(el);
    });
}

function scan(root) {
    scanReveal(root);
    scanCounters(root);
    scanMaps(root);
}

/* ------------------------------------------------------------------ */
/* Scroll: progreso, parallax y botón "volver arriba"                  */
/* ------------------------------------------------------------------ */

const cssScroll = CSS.supports('animation-timeline: scroll()');
let ticking = false;

// Respaldo para navegadores sin scroll-driven animations (Firefox)
function onScroll() {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(() => {
        const y = window.scrollY;
        const max = document.documentElement.scrollHeight - window.innerHeight;
        document.documentElement.style.setProperty('--progress', max > 0 ? (y / max).toFixed(4) : 0);

        if (!reduceMotion) {
            document.querySelectorAll('[data-parallax]').forEach((el) => {
                if (y > window.innerHeight * 1.5) return;
                el.style.transform = `translate3d(0, ${(y * Number(el.dataset.parallax)).toFixed(1)}px, 0)`;
            });
        }
        ticking = false;
    });
}

// "Volver arriba": un centinela a 600px del inicio, sin escuchar scroll
function watchScrolled() {
    if (!('IntersectionObserver' in window)) return;
    const sentinel = document.createElement('div');
    sentinel.setAttribute('aria-hidden', 'true');
    sentinel.style.cssText = 'position:absolute;top:600px;left:0;width:1px;height:1px;pointer-events:none';
    document.body.style.position ||= 'relative';
    document.body.prepend(sentinel);
    new IntersectionObserver(([entry]) => {
        document.documentElement.toggleAttribute('data-scrolled', !entry.isIntersecting && entry.boundingClientRect.top < 0);
    }).observe(sentinel);
}

/* ------------------------------------------------------------------ */
/* Punteros: spotlight en tarjetas y botones magnéticos                */
/* ------------------------------------------------------------------ */

if (finePointer && !reduceMotion) {
    document.addEventListener('pointermove', (e) => {
        const card = e.target.closest?.('.card-lift');
        if (card) {
            const r = card.getBoundingClientRect();
            card.style.setProperty('--mx', `${e.clientX - r.left}px`);
            card.style.setProperty('--my', `${e.clientY - r.top}px`);
        }

        const mag = e.target.closest?.('[data-magnetic]');
        if (mag) {
            const r = mag.getBoundingClientRect();
            const x = (e.clientX - (r.left + r.width / 2)) * 0.18;
            const y = (e.clientY - (r.top + r.height / 2)) * 0.28;
            mag.style.transform = `translate(${x.toFixed(1)}px, ${y.toFixed(1)}px)`;
        }
    }, { passive: true });

    document.addEventListener('pointerout', (e) => {
        const mag = e.target.closest?.('[data-magnetic]');
        if (mag && !mag.contains(e.relatedTarget)) mag.style.transform = '';
    }, { passive: true });
}

/* ------------------------------------------------------------------ */
/* Arranque                                                            */
/* ------------------------------------------------------------------ */

function init() {
    scan(document);
    if (!cssScroll) onScroll();

    // Livewire reemplaza fragmentos del DOM: observamos lo que se añada
    new MutationObserver((mutations) => {
        for (const m of mutations) {
            m.addedNodes.forEach((node) => {
                if (node.nodeType === 1) scan(node.parentElement ?? document);
            });
        }
    }).observe(document.body, { childList: true, subtree: true });
}

if (!cssScroll) {
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll, { passive: true });
}

watchScrolled();

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

/* Al volver con el botón "atrás" (bfcache) re-evaluamos el estado */
window.addEventListener('pageshow', (e) => {
    if (e.persisted) init();
});
