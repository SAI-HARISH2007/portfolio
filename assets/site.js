/* haresh.acadnet.net — scroll-driven 3D.
   All motion runs on transform/opacity only. Honours prefers-reduced-motion. */
(() => {
  'use strict';
  const reduced = matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- nav: condense once scrolled ---------- */
  const nav = document.querySelector('.nav');
  if (nav) {
    const onScroll = () => nav.dataset.scrolled = String(scrollY > 12);
    addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  if (reduced) {
    document.querySelectorAll('.r').forEach(el => el.classList.add('in'));
    return;
  }

  /* ---------- reveal on entry ---------- */
  const io = new IntersectionObserver((entries) => {
    for (const e of entries) {
      if (!e.isIntersecting) continue;
      e.target.classList.add('in');
      io.unobserve(e.target);
    }
  }, { rootMargin: '0px 0px -12% 0px', threshold: 0.08 });
  document.querySelectorAll('.r').forEach(el => io.observe(el));

  /* ---------- scroll-driven depth ----------
     Each .stage child gets --p: 0 at the far edge of the viewport,
     1 when it reaches the comfortable reading band. The CSS maps that
     onto translateZ + rotateX, so cards physically rotate up to face
     you as they arrive. */
  const staged = [...document.querySelectorAll('.stage .card')];
  const parallax = [...document.querySelectorAll('[data-depth]')];
  let ticking = false;

  const frame = () => {
    ticking = false;
    const vh = innerHeight;

    for (const el of staged) {
      const r = el.getBoundingClientRect();
      if (r.bottom < -200 || r.top > vh + 200) continue;
      // progress: 0 when the top edge is a full viewport down, 1 at 62% up the screen
      const p = 1 - Math.min(1, Math.max(0, (r.top - vh * 0.20) / (vh * 0.68)));
      el.style.setProperty('--p', p.toFixed(4));
    }

    for (const el of parallax) {
      const depth = parseFloat(el.dataset.depth) || 0;
      const r = el.getBoundingClientRect();
      const mid = r.top + r.height / 2 - vh / 2;
      el.style.transform = `translate3d(0, ${(-mid * depth).toFixed(2)}px, 0)`;
    }
  };

  const request = () => { if (!ticking) { ticking = true; requestAnimationFrame(frame); } };
  addEventListener('scroll', request, { passive: true });
  addEventListener('resize', request, { passive: true });
  frame();

  /* ---------- cursor spotlight on cards ---------- */
  if (matchMedia('(hover: hover) and (pointer: fine)').matches) {
    for (const card of document.querySelectorAll('.card')) {
      card.addEventListener('pointermove', (e) => {
        const r = card.getBoundingClientRect();
        card.style.setProperty('--mx', `${e.clientX - r.left}px`);
        card.style.setProperty('--my', `${e.clientY - r.top}px`);
      });
    }
  }
})();
