/* Live pull-request state from GitHub. Unauthenticated search API, cached for
   ten minutes in localStorage; falls back to the snapshot in data/projects.js. */

import { PR_SNAPSHOT } from './data/projects.js';

const USER = 'SAI-HARISH2007';
const KEY = 'gh-prs-v2';
const TTL = 10 * 60 * 1000;
const esc = (s) => String(s).replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

const words = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve'];
const word = (n) => (n < words.length ? words[n] : String(n));
const cap = (s) => s.charAt(0).toUpperCase() + s.slice(1);

async function fetchLive() {
  const url = `https://api.github.com/search/issues?q=author:${USER}+is:pr&sort=created&order=desc&per_page=40`;
  const res = await fetch(url, { headers: { Accept: 'application/vnd.github+json' } });
  if (!res.ok) throw new Error(`GitHub ${res.status}`);
  const json = await res.json();
  return json.items.map((it) => ({
    repo: it.repository_url.replace('https://api.github.com/repos/', ''),
    number: it.number,
    title: it.title,
    state: it.pull_request?.merged_at ? 'merged' : it.state,
    url: it.html_url,
    created: it.created_at,
  }));
}

function readCache() {
  try {
    const c = JSON.parse(localStorage.getItem(KEY) || 'null');
    if (c && Date.now() - c.at < TTL) return c;
  } catch { /* no storage */ }
  return null;
}
function writeCache(items) {
  try { localStorage.setItem(KEY, JSON.stringify({ at: Date.now(), items })); } catch { /* no storage */ }
}

function render(list, items) {
  const order = { open: 0, merged: 1, closed: 2 };
  const sorted = [...items].sort((a, b) => (order[a.state] - order[b.state]) || (b.number - a.number));
  list.innerHTML = sorted.map((pr, i) => `
    <li class="pr" style="--i:${i}">
      <a class="pr__title" href="${pr.url}">${esc(pr.title)}</a>
      <p class="pr__meta mono"><span>${esc(pr.repo)}</span><span>#${pr.number}</span></p>
      <span class="pr__state" data-state="${pr.state}">${pr.state}</span>
    </li>`).join('');
}

export async function initGithub() {
  const root = document.querySelector('[data-oss]');
  if (!root) return;
  const list = root.querySelector('[data-oss-list]');
  const status = root.querySelector('[data-oss-status]');
  const headline = root.querySelector('[data-oss-headline]');

  const apply = (items, source) => {
    render(list, items);
    const merged = items.filter((p) => p.state === 'merged').length;
    const total = items.length;
    headline.textContent = `${cap(word(total))} pull request${total === 1 ? '' : 's'}. ${cap(word(merged))} merged.`;
    if (source === 'live') {
      status.dataset.state = 'live';
      status.textContent = `Live from api.github.com · ${new Date().toLocaleTimeString('en-IN', { hour: '2-digit', minute: '2-digit' })}`;
    } else {
      status.dataset.state = 'snapshot';
      status.textContent = `GitHub unreachable · showing snapshot from ${PR_SNAPSHOT.asOf}`;
    }
  };

  const cached = readCache();
  if (cached) { apply(cached.items, 'live'); return; }

  // Only hit the API once the section is close to the viewport.
  await new Promise((resolve) => {
    const io = new IntersectionObserver((entries) => {
      if (entries.some((e) => e.isIntersecting)) { io.disconnect(); resolve(); }
    }, { rootMargin: '600px 0px' });
    io.observe(root);
  });

  try {
    const items = await fetchLive();
    if (!items.length) throw new Error('empty');
    writeCache(items);
    apply(items, 'live');
  } catch {
    apply(PR_SNAPSHOT.items, 'snapshot');
  }
}
