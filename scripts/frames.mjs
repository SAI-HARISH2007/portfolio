#!/usr/bin/env node
/* Rebuild the hero frame sequence from a source clip.
   Usage: node scripts/frames.mjs path/to/clip.mp4 [fps]
   Needs ffmpeg with libwebp. Writes cdn/frames/{lg,sm}/NNN.webp and
   cdn/media/poster.webp. Keep FRAME_COUNT in src/hero.js in sync. */

import { execSync } from 'node:child_process';
import { mkdirSync, rmSync, readdirSync } from 'node:fs';

const [src, fpsArg] = process.argv.slice(2);
if (!src) { console.error('usage: node scripts/frames.mjs <clip.mp4> [fps=10]'); process.exit(1); }
const fps = Number(fpsArg || 10);

const sizes = { lg: [1280, 60], sm: [540, 58] };
for (const [name, [width, q]] of Object.entries(sizes)) {
  const dir = `cdn/frames/${name}`;
  rmSync(dir, { recursive: true, force: true });
  mkdirSync(dir, { recursive: true });
  const vf = name === 'sm' ? `fps=${fps},crop=ih*9/16:ih,scale=${width}:-2` : `fps=${fps},scale=${width}:-2`;
  execSync(`ffmpeg -v error -i "${src}" -vf "${vf}" -c:v libwebp -quality ${q} -compression_level 6 ${dir}/%03d.webp`, { stdio: 'inherit' });
  console.log(`${name}: ${readdirSync(dir).length} frames`);
}
execSync(`ffmpeg -v error -y -i "${src}" -vf "select=eq(n\\,0),scale=1440:-2" -frames:v 1 -c:v libwebp -quality 80 cdn/media/poster.webp`, { stdio: 'inherit' });
console.log('poster written');
