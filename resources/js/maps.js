import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import 'leaflet.markercluster';
import 'leaflet.markercluster/dist/MarkerCluster.css';
import 'leaflet.markercluster/dist/MarkerCluster.Default.css';
import 'maplibre-gl/dist/maplibre-gl.css';
import * as maplibregl from 'maplibre-gl';
import '@maplibre/maplibre-gl-leaflet';

// El plugin busca maplibregl en window
window.maplibregl = maplibregl;

// Mapa vectorial gratuito y sin llave de API (OpenFreeMap sobre datos de OpenStreetMap)
const STYLE = 'https://tiles.openfreemap.org/styles/positron';
const ATTRIBUTION = '<a href="https://openfreemap.org" target="_blank" rel="noopener">OpenFreeMap</a> &copy; <a href="https://openmaptiles.org/" target="_blank" rel="noopener">OpenMapTiles</a> Datos de <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap</a>';

const esc = (s) => String(s ?? '').replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const touch = window.matchMedia('(pointer: coarse)').matches;

function baseMap(el, { center, zoom, theme = 'light' }) {
    const map = L.map(el, {
        center,
        zoom,
        zoomControl: false,
        scrollWheelZoom: false,
        dragging: !touch,
        tap: false,
        attributionControl: true,
        minZoom: 9,
        maxZoom: 18,
    });
    const glLayer = L.maplibreGL({ style: STYLE, attribution: ATTRIBUTION }).addTo(map);
    el._gl = glLayer.getMaplibreMap();
    el._gl.on('error', (e) => console.warn('[mapa]', e.error?.message ?? e));
    el.classList.add(theme === 'dark' ? 'map-dark' : 'map-light');
    L.control.zoom({ position: 'bottomright', zoomInTitle: 'Acercar', zoomOutTitle: 'Alejar' }).addTo(map);

    // Evita secuestrar el scroll de la página: el mapa se activa con clic/toque
    const hint = document.createElement('div');
    hint.className = 'map-hint';
    hint.textContent = touch ? 'Toca para explorar el mapa' : 'Haz clic para explorar el mapa';
    el.appendChild(hint);
    const activate = () => {
        map.scrollWheelZoom.enable();
        map.dragging.enable();
        hint.classList.add('is-hidden');
    };
    el.addEventListener('pointerdown', activate, { once: true });
    el.addEventListener('focusin', activate, { once: true });
    return map;
}

const directionsUrl = (lat, lng) => `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;

/* ------------------------------------------------------------------ */
/* Mapa de ubicación de la funeraria                                    */
/* ------------------------------------------------------------------ */

function funeralPin() {
    return L.divIcon({
        className: 'pin-wrap',
        iconSize: [56, 68],
        iconAnchor: [28, 62],
        popupAnchor: [0, -58],
        html: `<span class="pin-pulse"></span>
            <svg class="pin-svg" viewBox="0 0 56 68" aria-hidden="true">
                <defs><linearGradient id="gp" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#f59e0b"/><stop offset="1" stop-color="#b45309"/></linearGradient></defs>
                <path d="M28 66C28 66 6 40 6 25a22 22 0 0144 0c0 15-22 41-22 41z" fill="url(#gp)" stroke="#fff" stroke-width="3"/>
                <circle cx="28" cy="25" r="10" fill="#fff"/>
                <path d="M28 18v14M21 25h14" stroke="#b45309" stroke-width="3" stroke-linecap="round"/>
            </svg>`,
    });
}

export function initFuneralMap(el) {
    const lat = parseFloat(el.dataset.lat);
    const lng = parseFloat(el.dataset.lng);
    const theme = el.dataset.theme || 'light';
    const map = baseMap(el, { center: [lat, lng], zoom: 16, theme });

    const phone = el.dataset.phone ? `<a class="pop-link" href="tel:${esc(el.dataset.phone.replace(/[^0-9+]/g, ''))}">☎ ${esc(el.dataset.phone)}</a>` : '';
    const html = `<div class="pop">
        <p class="pop-kicker">Estamos aquí</p>
        <p class="pop-title">${esc(el.dataset.name)}</p>
        <p class="pop-text">${esc(el.dataset.address)}</p>
        ${phone}
        <a class="pop-btn" href="${directionsUrl(lat, lng)}" target="_blank" rel="noopener noreferrer">Cómo llegar →</a>
    </div>`;

    const marker = L.marker([lat, lng], { icon: funeralPin(), title: el.dataset.name, keyboard: true }).addTo(map).bindPopup(html, { maxWidth: 260, closeButton: false, autoPanPadding: [20, 70] });
    void marker;
    // La tarjeta informativa ya acompaña al mapa; el popup se abre al tocar el pin
    return map;
}

/* ------------------------------------------------------------------ */
/* Mapa de panteones y crematorios                                      */
/* ------------------------------------------------------------------ */

const KIND = {
    panteon: { label: 'Panteón', cls: 'dot-panteon', glyph: '<path d="M12 5v14M7 10h10" stroke="#fff" stroke-width="2.4" stroke-linecap="round"/>' },
    crematorio: { label: 'Crematorio', cls: 'dot-crema', glyph: '<path d="M12 4c0 4-5 5-5 10a5 5 0 0010 0c0-5-5-6-5-10z" fill="#fff"/>' },
};

function dot(type) {
    const k = KIND[type];
    return L.divIcon({
        className: 'dot-wrap',
        iconSize: [34, 34],
        iconAnchor: [17, 17],
        popupAnchor: [0, -16],
        html: `<span class="dot ${k.cls}"><svg viewBox="0 0 24 24" aria-hidden="true">${k.glyph}</svg></span>`,
    });
}

function distanceKm(a, b) {
    const R = 6371;
    const rad = (d) => (d * Math.PI) / 180;
    const dLat = rad(b[0] - a[0]);
    const dLng = rad(b[1] - a[1]);
    const h = Math.sin(dLat / 2) ** 2 + Math.cos(rad(a[0])) * Math.cos(rad(b[0])) * Math.sin(dLng / 2) ** 2;
    return 2 * R * Math.asin(Math.sqrt(h));
}

function popupHtml(p) {
    const k = KIND[p.type];
    const sector = p.sector ? ` · ${p.sector === 'publico' ? 'Público' : 'Privado'}` : '';
    const phone = p.phone ? `<a class="pop-link" href="tel:${esc(p.phone.replace(/[^0-9+]/g, ''))}">☎ ${esc(p.phone)}</a>` : '';
    return `<div class="pop">
        <p class="pop-kicker">${k.label}${sector}</p>
        <p class="pop-title">${esc(p.name)}</p>
        ${p.address ? `<p class="pop-text">${esc(p.address)}</p>` : ''}
        <p class="pop-text pop-muted">${esc(p.alcaldia)}</p>
        ${phone}
        <a class="pop-btn" href="${directionsUrl(p.lat, p.lng)}" target="_blank" rel="noopener noreferrer">Cómo llegar →</a>
    </div>`;
}

export function initPlacesMap(root) {
    const places = JSON.parse(root.dataset.places);
    const home = root.dataset.home ? JSON.parse(root.dataset.home) : null;
    const canvas = root.querySelector('[data-map-canvas]');
    const list = root.querySelector('[data-map-list]');
    const count = root.querySelector('[data-map-count]');
    const search = root.querySelector('[data-map-search]');
    const select = root.querySelector('[data-map-alcaldia]');
    const chips = root.querySelectorAll('[data-map-type]');
    const nearBtn = root.querySelector('[data-map-near]');
    const status = root.querySelector('[data-map-status]');

    const map = baseMap(canvas, { center: [19.3907, -99.1332], zoom: 10, theme: 'light' });
    const cluster = L.markerClusterGroup({
        showCoverageOnHover: false,
        maxClusterRadius: 48,
        spiderfyOnMaxZoom: true,
        iconCreateFunction: (c) => L.divIcon({ html: `<span>${c.getChildCount()}</span>`, className: 'cluster-icon', iconSize: [42, 42] }),
    });
    map.addLayer(cluster);

    if (home) {
        L.marker([home.lat, home.lng], { icon: funeralPin(), title: home.name, zIndexOffset: 1000 })
            .addTo(map)
            .bindPopup(`<div class="pop"><p class="pop-kicker">Nuestra sede</p><p class="pop-title">${esc(home.name)}</p><p class="pop-text">${esc(home.address)}</p></div>`, { closeButton: false });
    }

    const state = { type: 'all', q: '', alcaldia: '', origin: null };
    const items = places.map((p) => {
        const marker = L.marker([p.lat, p.lng], { icon: dot(p.type), title: p.name, keyboard: true }).bindPopup(popupHtml(p), { maxWidth: 270, closeButton: false });
        return { p, marker, text: `${p.name} ${p.address ?? ''} ${p.alcaldia}`.toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g, '') };
    });

    const norm = (s) => s.toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g, '').trim();

    function render({ fit = true } = {}) {
        const q = norm(state.q);
        let visible = items.filter(({ p, text }) =>
            (state.type === 'all' || p.type === state.type) &&
            (!state.alcaldia || p.alcaldia === state.alcaldia) &&
            (!q || text.includes(q)));

        if (state.origin) {
            visible = visible
                .map((it) => ({ ...it, d: distanceKm(state.origin, [it.p.lat, it.p.lng]) }))
                .sort((a, b) => a.d - b.d);
        }

        cluster.clearLayers();
        cluster.addLayers(visible.map((v) => v.marker));
        count.textContent = `${visible.length} ${visible.length === 1 ? 'lugar' : 'lugares'}`;

        list.innerHTML = visible.length
            ? visible.map((v, i) => `<li>
                <button type="button" data-i="${i}" class="place-row">
                    <span class="dot ${KIND[v.p.type].cls} dot-sm"><svg viewBox="0 0 24 24" aria-hidden="true">${KIND[v.p.type].glyph}</svg></span>
                    <span class="place-info">
                        <span class="place-name">${esc(v.p.name)}</span>
                        <span class="place-meta">${esc(v.p.alcaldia)}${v.d != null ? ` · a ${v.d < 1 ? Math.round(v.d * 1000) + ' m' : v.d.toFixed(1) + ' km'}` : ''}</span>
                    </span>
                </button></li>`).join('')
            : '<li class="place-empty">No encontramos lugares con ese criterio. Prueba otra búsqueda o limpia los filtros.</li>';

        list.querySelectorAll('.place-row').forEach((btn) => {
            btn.addEventListener('click', () => {
                const v = visible[Number(btn.dataset.i)];
                cluster.zoomToShowLayer(v.marker, () => v.marker.openPopup());
                if (window.matchMedia('(max-width: 1023px)').matches) canvas.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'center' });
            });
        });

        if (fit && visible.length) {
            const pts = visible.slice(0, state.origin ? 6 : visible.length).map((v) => [v.p.lat, v.p.lng]);
            if (state.origin) pts.push(state.origin);
            map.fitBounds(L.latLngBounds(pts).pad(0.15), { animate: !reduceMotion, maxZoom: 15 });
        }
    }

    chips.forEach((chip) => chip.addEventListener('click', () => {
        state.type = chip.dataset.mapType;
        chips.forEach((c) => c.setAttribute('aria-pressed', String(c === chip)));
        render();
    }));
    let t;
    search?.addEventListener('input', () => { clearTimeout(t); t = setTimeout(() => { state.q = search.value; render(); }, 180); });
    select?.addEventListener('change', () => { state.alcaldia = select.value; render(); });

    nearBtn?.addEventListener('click', () => {
        if (!navigator.geolocation) { status.textContent = 'Tu navegador no permite ubicarte.'; return; }
        status.textContent = 'Buscando tu ubicación…';
        navigator.geolocation.getCurrentPosition((pos) => {
            state.origin = [pos.coords.latitude, pos.coords.longitude];
            L.circleMarker(state.origin, { radius: 8, color: '#fff', weight: 3, fillColor: '#2563eb', fillOpacity: 1 }).addTo(map).bindTooltip('Estás aquí');
            status.textContent = 'Ordenados del más cercano al más lejano.';
            render();
        }, () => { status.textContent = 'No pudimos obtener tu ubicación. Revisa los permisos del navegador.'; }, { enableHighAccuracy: false, timeout: 10000 });
    });

    render();
    // Leaflet necesita recalcular el tamaño si el contenedor aparece/cambia
    new ResizeObserver(() => map.invalidateSize()).observe(canvas);
    return map;
}
