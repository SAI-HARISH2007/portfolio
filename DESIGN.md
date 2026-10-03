# DESIGN.md — haresh.acadnet.net

Recorded from the built site, September 2026. Tokens live in `src/styles/site.css` (`@layer tokens`).

## World

Bright chrome lab. A cool-white ground (`#f5f6f8`) with pure-white plates, near-black ink, hairline rules, and one accent. Chrome (a monochrome lattice of mirrored cubes) exists only where the footage is: inside the letters of the name in the hero, in the one full-bleed flood, and in the Open Graph card. Nothing else is gradient, glass, or glow.

Light because the visitor is a recruiter, mentor, or maintainer reading at a desk in daylight. The chrome sequence needs a white plate to read as material rather than as a dark-mode effect.

## Colour

| Token | Value | Role |
|---|---|---|
| `--bg` | `#f5f6f8` | page ground |
| `--white` | `#ffffff` | plates: hero, panels, quote band, inputs |
| `--ink` / `--ink-2` / `--ink-3` / `--ink-4` | `#0b0d12` / `#363b47` / `#626877` / `#8e94a3` | headings / body / secondary / disabled |
| `--line` / `--line-2` | `#d5d9e1` / `#e5e8ee` | rules and borders |
| `--accent` | `#2b3cff` | the only colour: live state, hover, the guaranteeing part of each diagram |
| `--ok` / `--warn` | `#0f7b4a` / `#b4520a` | PR open / snapshot-and-error states only |

Strategy: restrained. The accent is reserved for things that are live or interactive, so it always means something.

## Type

**Archivo** (variable, width 62–125) for everything except numbers. Width carries the hierarchy: 125 for the name and project names, 112 for section headings, 100 for body, 84–94 for labels and buttons. Weight 800 for the name, 600–700 for display, 400–500 for text. Tracking −0.035 to −0.05em on display, none on body.

**Geist Mono** only for measurements: metrics, frame readout, clock, PR numbers, section indices, diagram labels. Never as decoration.

Scale: `--step--1` to `--step-4`, fluid clamps. Body measure 66ch.

## Space and surfaces

Gutter `clamp(1.25rem, 4vw, 4rem)`, content width 1440. Section padding `clamp(6rem, 12vh + 2rem, 11rem)`; sections separated by a 1px `--line-2` rule. Corner radius 14 on plates, 10 on inputs and figures, 999 on pills. Shadows are soft and offset (`--shadow-1/2/3`); no zero-offset halos.

Two-column sections (thesis, open source, writing, about, contact) share a 5/7 or 4/8 split with the header sticky at `top: 6.5rem` on wide screens.

## Motion

Two authored moments, both scroll-driven and scrubbed, so they never run ahead of the visitor:

1. **Hero.** 80 frames at 12 fps on a canvas. The name is a black knockout on a white plate with `mix-blend-mode: screen`. Progress 0–0.56 scales the name ×3.6; 0.36–0.52 fades the plate so the chrome floods; 0.74–0.94 slides the thesis sheet up. Pinned for 420vh (340vh on phones). Frame readout in the nav is real.
2. **Work.** Six panels on a pinned horizontal track (`scrub: 0.6`) at ≥1024px; a vertical stack below that.

Everything else is quiet: one reveal (`opacity + 22px + 6px blur`, 700ms, `cubic-bezier(0.23, 1, 0.32, 1)`), a 45ms stagger on PR rows, `scale(.97)` on press, a 12–18px springy parallax and a magnetic primary button on pointer devices only. Lenis smooths the scroll at `lerp: 0.11`.

`prefers-reduced-motion`: the hero becomes a single still, the horizontal track becomes a stack, reveals become opacity-only, the ambient video is removed.

## Components

- **Buttons**: pill, black on white; hover turns ultramarine; ghost variant with a hairline border.
- **Tags**: 6px radius, hairline, ground-coloured.
- **Metric row**: mono value in a 7ch column, label in `--ink-3`, hairline dividers.
- **PR row**: title, mono repo + number, state pill (open green outline / merged filled accent / closed grey).
- **Diagrams**: 320×200 SVG, 1.2px ink stroke, mono labels, the accent marks the one guaranteeing part.
- **Form**: white inputs, hairline border, accent focus ring at 4px `--accent-soft`; status line above the fields.

## Browser surfaces

Selection is black on white. Focus ring is 2px accent, 3px offset. Scrollbars are thin and `--line`-coloured. Caret is accent. Link underlines are 1px `background-image` lines that thicken to 2px on hover.

## Content rules

Every number on the page is measured in the linked repo; nothing is rounded up. Open-source state is read live from GitHub. Team work says it was team work. Unconfirmed competition outcomes are listed as entries, not wins.
