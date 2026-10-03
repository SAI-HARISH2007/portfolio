import './styles/fonts.css';
import './styles/site.css';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';
import { initHero } from './hero.js';
import { initWork } from './work.js';
import { initArchive } from './archive.js';
import { initGithub } from './github.js';
import { initContact } from './contact.js';
import { WRITING } from './data/projects.js';

document.documentElement.classList.add('js');
gsap.registerPlugin(ScrollTrigger);

const reduced = matchMedia('(prefers-reduced-motion: reduce)').matches;

/* ---------- smooth scroll, driving ScrollTrigger ---------- */
let lenis = null;
if (!reduced) {
  lenis = new Lenis({ lerp: 0.11, wheelMultiplier: 1, smoothWheel: true });
  lenis.on('scroll', ScrollTrigger.update);
  gsap.ticker.add((t) => lenis.raf(t * 1000));
  gsap.ticker.lagSmoothing(0);
  document.documentElement.classList.add('lenis');
}

/* ---------- nav ---------- */
const nav = document.querySelector('[data-nav]');
const onScroll = () => { nav.dataset.scrolled = String(scrollY > 8); };
addEventListener('scroll', onScroll, { passive: true });
onScroll();

const toggle = document.querySelector('[data-nav-toggle]');
const menu = document.querySelector('[data-menu]');
const setMenu = (open) => {
  toggle.setAttribute('aria-expanded', String(open));
  menu.hidden = !open;
  if (lenis) open ? lenis.stop() : lenis.start();
};
toggle.addEventListener('click', () => setMenu(menu.hidden));
menu.addEventListener('click', (e) => { if (e.target.closest('a')) setMenu(false); });
addEventListener('keydown', (e) => { if (e.key === 'Escape' && !menu.hidden) setMenu(false); });

// Section highlight in the nav
const links = [...document.querySelectorAll('.nav__links a')];
const sections = links.map((a) => document.querySelector(a.getAttribute('href'))).filter(Boolean);
const spy = new IntersectionObserver((entries) => {
  for (const e of entries) {
    if (!e.isIntersecting) continue;
    links.forEach((a) => a.toggleAttribute('aria-current', a.getAttribute('href') === `#${e.target.id}`));
  }
}, { rootMargin: '-40% 0px -55% 0px' });
sections.forEach((s) => spy.observe(s));

// Hyderabad clock
const clock = document.querySelector('[data-clock]');
const fmt = new Intl.DateTimeFormat('en-GB', { hour: '2-digit', minute: '2-digit', hour12: false, timeZone: 'Asia/Kolkata' });
const tick = () => { clock.textContent = `HYD ${fmt.format(new Date())}`; };
tick(); setInterval(tick, 15000);

// Anchor links go through Lenis so the pinned sections resolve correctly
document.addEventListener('click', (e) => {
  const a = e.target.closest('a[href^="#"]');
  if (!a || !lenis || e.defaultPrevented) return;
  const target = document.querySelector(a.getAttribute('href'));
  if (!target) return;
  e.preventDefault();
  lenis.scrollTo(target, { offset: 0, duration: 1.1 });
});

/* ---------- reveals ---------- */
const io = new IntersectionObserver((entries) => {
  for (const e of entries) {
    if (!e.isIntersecting) continue;
    e.target.classList.add('is-in');
    io.unobserve(e.target);
  }
}, { rootMargin: '0px 0px -10% 0px', threshold: 0.1 });
document.querySelectorAll('[data-reveal]').forEach((el, i) => {
  // siblings inside one block get a short stagger
  const prev = el.previousElementSibling;
  if (prev && prev.hasAttribute('data-reveal')) el.style.setProperty('--d', `${Math.min(3, i % 4) * 60}ms`);
  io.observe(el);
});

/* ---------- lazy ambient video ---------- */
for (const v of document.querySelectorAll('[data-lazy-video]')) {
  if (reduced) { v.remove(); continue; }
  const vio = new IntersectionObserver((entries) => {
    for (const e of entries) {
      if (e.isIntersecting) { if (v.preload === 'none') { v.preload = 'auto'; v.load(); } v.play().catch(() => {}); }
      else v.pause();
    }
  }, { rootMargin: '200px 0px' });
  vio.observe(v);
}

/* ---------- writing list ---------- */
const writing = document.querySelector('[data-writing-list]');
if (writing) {
  writing.innerHTML = WRITING.map((w) => `
    <li class="piece"><a href="${w.url}"><h3>${w.title}</h3><p>${w.line}</p></a></li>`).join('');
}

/* ---------- magnetic primary button ---------- */
if (!reduced && matchMedia('(hover: hover) and (pointer: fine)').matches) {
  for (const el of document.querySelectorAll('[data-magnetic]')) {
    const qx = gsap.quickTo(el, 'x', { duration: 0.5, ease: 'power3' });
    const qy = gsap.quickTo(el, 'y', { duration: 0.5, ease: 'power3' });
    el.addEventListener('pointermove', (e) => {
      const r = el.getBoundingClientRect();
      qx((e.clientX - (r.left + r.width / 2)) * 0.25);
      qy((e.clientY - (r.top + r.height / 2)) * 0.25);
    });
    el.addEventListener('pointerleave', () => { qx(0); qy(0); });
  }
}

/* ---------- sections ---------- */
initHero({ reduced });
initWork({ reduced });
initArchive();
initGithub();
initContact();
document.querySelector('[data-year]').textContent = String(new Date().getFullYear());

// Fonts and lazy content can shift heights; let ScrollTrigger measure again.
document.fonts?.ready.then(() => ScrollTrigger.refresh());
addEventListener('load', () => ScrollTrigger.refresh());
