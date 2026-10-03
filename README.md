# haresh.acadnet.net

Personal portfolio — Sai Haresh Anand S.
B.Tech CS (AI & ML), IcfaiTech Hyderabad. Builds agent systems, then tries to break them.

## How it is built

Static site, no framework. Vite bundles one HTML file, one CSS file and two JS chunks.

| Piece | What it does |
|---|---|
| `index.html` | The whole page. Content for projects, PRs and writing lives in `src/data/projects.js`. |
| `src/hero.js` | Scroll-scrubbed chrome sequence: 101 WebP frames drawn to a canvas, the name knocked out of a white plate with `mix-blend-mode: screen`. |
| `src/work.js` | Project panels rendered from data; pinned horizontal track on wide screens (GSAP ScrollTrigger). |
| `src/diagrams.js` | One SVG mechanism diagram per project. |
| `src/github.js` | Reads live PR state from `api.github.com` (cached 10 min); falls back to the snapshot in the data file. |
| `src/contact.js` + `public/contact.php` | Contact form. Works without JS (plain POST + redirect) and with it (fetch + JSON). |
| `cdn/` | Frames, fonts, video, photo, OG image. **Never uploaded to the web host** — see Deploy. |

Motion: Lenis for smooth scroll, GSAP for the two scroll-driven moments. Everything honours `prefers-reduced-motion`.

## Develop

```bash
npm install
npm run dev        # http://localhost:5173
npm run build      # writes dist/
npm run preview
```

## Deploy

The web host has a weak FTP, so it only receives the small files. Heavy media is served
from this repository through jsDelivr, a free CDN that mirrors public GitHub repos:

```
https://cdn.jsdelivr.net/gh/SAI-HARISH2007/portfolio@main/cdn/...
```

That URL is set in `.env.production` (`VITE_ASSET_BASE`). So a deploy is:

1. `git push` (so jsDelivr can see anything new in `cdn/`).
2. `npm run build`.
3. Drag the **contents** of `dist/` into the web root in WinSCP. That is about ten files, under 200 KB:
   `index.html`, `404.html`, `contact.php`, `.htaccess`, `favicon.svg`, `robots.txt`, `sitemap.xml`, and the `assets/` folder with the hashed JS/CSS.

Old hashed files in `assets/` can be deleted on the host whenever; the new `index.html` only references the new ones.

jsDelivr caches `@main` for up to 12 hours. If a media file must change immediately, commit it under a new name.

## Rebuilding the frame sequence

```bash
node scripts/frames.mjs path/to/clip.mp4 10
```

Writes `cdn/frames/lg` (1280 px, 16:9) and `cdn/frames/sm` (540 px, 9:16 centre crop for portrait phones) plus the poster. If the frame count changes, update `FRAME_COUNT` in `src/hero.js`.

`node scripts/og.mjs` re-renders the Open Graph card (needs the dev server running).
`node scripts/shoot.mjs` captures review screenshots into `.impeccable/review/`.

## Credits

Chrome footage: [Pachon in Motion](https://www.pexels.com/@pachon-in-motion-426015731) via Pexels (video 30345905).
Waveform loop: [Chandresh Uike](https://www.pexels.com/video/34645278/) via Pexels.
Type: Archivo (Omnibus-Type) and Geist Mono (Vercel), both OFL, self-hosted.
