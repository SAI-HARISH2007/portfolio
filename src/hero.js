/* Scroll-scrubbed chrome sequence.
   80 WebP frames at 12 fps, drawn to a canvas as scroll progress moves.
   Frames load in two passes (every 8th first, then the rest) so the scrub is
   usable within a second on a normal connection. */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

const FRAME_COUNT = 80;
const pad = (n) => String(n).padStart(3, '0');
const smooth = (a, b, x) => {
  const t = Math.min(1, Math.max(0, (x - a) / (b - a)));
  return t * t * (3 - 2 * t);
};

export function initHero({ reduced }) {
  const root = document.querySelector('[data-hero]');
  if (!root) return;

  const canvas = root.querySelector('[data-hero-canvas]');
  const knockout = root.querySelector('[data-hero-knockout]');
  const name = root.querySelector('[data-hero-name]');
  const ui = root.querySelector('[data-hero-ui]');
  const meta = root.querySelector('[data-hero-meta]');
  const sheet = root.querySelector('[data-hero-sheet]');
  const bar = root.querySelector('[data-hero-progress]');
  const readout = document.querySelector('[data-readout]');
  const ctx = canvas.getContext('2d', { alpha: false });

  // Portrait phones get a 9:16 centre crop of the same clip so cover-fit stays sharp.
  const size = matchMedia('(max-width: 899px) and (orientation: portrait)').matches ? 'sm' : 'lg';
  const frames = new Array(FRAME_COUNT).fill(null);
  const BASE = import.meta.env.VITE_ASSET_BASE ?? '/cdn';
  const src = (i) => `${BASE}/frames/${size}/${pad(i + 1)}.webp`;

  let current = -1;
  let dpr = Math.min(devicePixelRatio || 1, 1.5);
  let w = 0, h = 0;

  function resize() {
    const r = canvas.getBoundingClientRect();
    w = Math.round(r.width); h = Math.round(r.height);
    canvas.width = Math.round(w * dpr);
    canvas.height = Math.round(h * dpr);
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    ctx.imageSmoothingQuality = 'high';
    draw(current < 0 ? 0 : current, true);
  }

  function nearest(i) {
    if (frames[i]) return frames[i];
    for (let d = 1; d < FRAME_COUNT; d++) {
      if (frames[i - d]) return frames[i - d];
      if (frames[i + d]) return frames[i + d];
    }
    return null;
  }

  function draw(i, force = false) {
    if (i === current && !force) return;
    const img = nearest(i);
    if (!img) return;
    current = i;
    // cover-fit
    const s = Math.max(w / img.naturalWidth, h / img.naturalHeight);
    const dw = img.naturalWidth * s, dh = img.naturalHeight * s;
    ctx.drawImage(img, (w - dw) / 2, (h - dh) / 2, dw, dh);
    if (!canvas.dataset.ready) canvas.dataset.ready = 'true';
  }

  function load(i) {
    return new Promise((res) => {
      const img = new Image();
      img.decoding = 'async';
      img.onload = () => { frames[i] = img; res(img); };
      img.onerror = () => res(null);
      img.src = src(i);
    });
  }

  async function preload() {
    await load(0);
    draw(0, true);
    const pass1 = [];
    for (let i = 8; i < FRAME_COUNT; i += 8) pass1.push(load(i));
    await Promise.all(pass1);
    draw(current < 0 ? 0 : current, true);
    // Fill the gaps in small batches to keep the network polite.
    const rest = [];
    for (let i = 1; i < FRAME_COUNT; i++) if (!frames[i]) rest.push(i);
    for (let k = 0; k < rest.length; k += 6) {
      await Promise.all(rest.slice(k, k + 6).map(load));
      draw(current < 0 ? 0 : current, true);
    }
  }

  resize();
  addEventListener('resize', resize, { passive: true });
  preload();

  if (reduced) {
    if (readout) readout.textContent = 'F 001 / 080';
    return;
  }

  // Pointer parallax on the plate, decorative and springy.
  if (matchMedia('(hover: hover) and (pointer: fine)').matches) {
    const qx = gsap.quickTo(canvas, 'x', { duration: 0.9, ease: 'power3' });
    const qy = gsap.quickTo(canvas, 'y', { duration: 0.9, ease: 'power3' });
    gsap.set(canvas, { scale: 1.04 });
    root.addEventListener('pointermove', (e) => {
      qx((e.clientX / innerWidth - 0.5) * -18);
      qy((e.clientY / innerHeight - 0.5) * -12);
    });
  }

  let raf = 0;
  let state = { p: 0 };

  function render() {
    raf = 0;
    const p = state.p;
    draw(Math.round(p * (FRAME_COUNT - 1)));

    const scale = 1 + 2.6 * smooth(0, 0.56, p);
    name.style.transform = `scale(${scale.toFixed(4)})`;
    knockout.style.opacity = (1 - smooth(0.36, 0.52, p)).toFixed(3);

    const uiOut = smooth(0.04, 0.26, p);
    ui.style.opacity = (1 - uiOut).toFixed(3);
    ui.style.transform = `translate3d(0, ${(-36 * uiOut).toFixed(1)}px, 0)`;
    if (meta) meta.style.opacity = (1 - uiOut).toFixed(3);

    const sheetIn = smooth(0.74, 0.94, p);
    sheet.style.transform = `translate3d(0, ${((1 - sheetIn) * 100).toFixed(2)}%, 0)`;

    if (bar) bar.style.transform = `scaleX(${p.toFixed(3)})`;
    if (readout) readout.textContent = `F ${pad(Math.round(p * (FRAME_COUNT - 1)) + 1)} / ${FRAME_COUNT}`;
  }

  ScrollTrigger.create({
    trigger: root,
    start: 'top top',
    end: 'bottom bottom',
    scrub: true,
    onUpdate: (self) => {
      state.p = self.progress;
      if (!raf) raf = requestAnimationFrame(render);
    },
  });
  render();
}
