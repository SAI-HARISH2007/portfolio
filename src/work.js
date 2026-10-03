/* Project panels, rendered from data, laid out as a pinned horizontal track on
   wide screens and a vertical stack elsewhere. */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { PROJECTS } from './data/projects.js';
import { DIAGRAMS } from './diagrams.js';

const esc = (s) => String(s).replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

function panel(p, i, total) {
  return `
  <article class="panel" id="${p.slug}" aria-labelledby="${p.slug}-h">
    <div class="panel__main">
      <p class="panel__meta mono">
        <span class="panel__index">${String(i + 1).padStart(2, '0')} / ${String(total).padStart(2, '0')}</span>
        <span>${esc(p.note)}</span>
      </p>
      <h3 class="panel__name" id="${p.slug}-h"><a href="${p.repo}">${esc(p.name)}</a></h3>
      <p class="panel__role">${esc(p.role)}</p>
      <p class="panel__blurb">${esc(p.blurb)}</p>
      <div class="panel__foot">
        <a class="link" href="${p.repo}">Source
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M5 11l6-6M6 5h5v5"/></svg>
        </a>
        <div class="tags">${p.tags.map((t) => `<span class="tag">${esc(t)}</span>`).join('')}</div>
      </div>
    </div>
    <div class="panel__side">
      <div class="panel__figure">${DIAGRAMS[p.diagram] || ''}</div>
      <dl class="metrics">
        ${p.metrics.map(([v, l]) => `<div class="metric"><dt class="visually-hidden">${esc(l)}</dt><dd><b>${esc(v)}</b></dd><dd><span>${esc(l)}</span></dd></div>`).join('')}
      </dl>
    </div>
  </article>`;
}

export function initWork({ reduced }) {
  const track = document.querySelector('[data-work-track]');
  const viewport = document.querySelector('[data-work-viewport]');
  if (!track) return;
  track.innerHTML = PROJECTS.map((p, i) => panel(p, i, PROJECTS.length)).join('');

  const mm = gsap.matchMedia();
  mm.add('(min-width: 1024px) and (prefers-reduced-motion: no-preference)', () => {
    const distance = () => track.scrollWidth - viewport.clientWidth;
    const tween = gsap.to(track, {
      x: () => -distance(),
      ease: 'none',
      scrollTrigger: {
        trigger: viewport,
        start: 'top top',
        end: () => `+=${distance()}`,
        pin: true,
        scrub: 0.6,
        anticipatePin: 1,
        invalidateOnRefresh: true,
      },
    });
    // Make in-page anchors to a panel land on that panel rather than at the pin start.
    const jump = (e) => {
      const a = e.target.closest('a[href^="#"]');
      if (!a) return;
      const el = document.getElementById(a.getAttribute('href').slice(1));
      if (!el || !track.contains(el)) return;
      e.preventDefault();
      const st = tween.scrollTrigger;
      const ratio = (el.offsetLeft - parseFloat(getComputedStyle(track).paddingLeft)) / distance();
      window.scrollTo({ top: st.start + Math.min(1, Math.max(0, ratio)) * (st.end - st.start), behavior: 'smooth' });
    };
    document.addEventListener('click', jump);
    return () => document.removeEventListener('click', jump);
  });
  void reduced;
}
