/* "Everything else" list, rendered from data. Same data-first approach as work.js. */

import { ARCHIVE, SCRATCH } from './data/projects.js';

const esc = (s) => String(s).replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

export function initArchive() {
  const list = document.querySelector('[data-archive-list]');
  if (!list) return;
  list.innerHTML = ARCHIVE.map((p) => `
    <li class="arow">
      <a href="${p.repo}">
        <span class="arow__year mono">${esc(p.year)}</span>
        <span class="arow__body">
          <h3>${esc(p.name)}</h3>
          <p>${esc(p.line)}</p>
          <span class="tags">${p.tags.map((t) => `<span class="tag">${esc(t)}</span>`).join('')}</span>
        </span>
      </a>
    </li>`).join('');

  const scratch = document.querySelector('[data-archive-scratch]');
  if (scratch) {
    scratch.innerHTML = SCRATCH.map(([n, u]) => `<li><a class="tag" href="${u}">${esc(n)}</a></li>`).join('');
  }
}
