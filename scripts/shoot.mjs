// Screenshot helper: node scripts/shoot.mjs <url> <outdir>
import { chromium } from 'playwright-core';
import { mkdirSync } from 'node:fs';
import { homedir } from 'node:os';
const [url = 'http://localhost:5173/', out = '.impeccable/review'] = process.argv.slice(2);
mkdirSync(out, { recursive: true });
const exe = `${homedir()}/.cache/ms-playwright/chromium-1228/chrome-linux64/chrome`;
const browser = await chromium.launch({ executablePath: exe, args: ['--no-sandbox'] });

async function shoot(name, viewport, spec) {
  const page = await browser.newPage({ viewport, deviceScaleFactor: 1 });
  page.on('pageerror', (e) => console.log(`[${name}] pageerror`, e.message));
  page.on('console', (m) => { if (m.type() === 'error') console.log(`[${name}] console.error`, m.text()); });
  await page.goto(url, { waitUntil: 'networkidle' });
  await page.waitForTimeout(1500);
  const positions = await page.evaluate((spec) => {
    const vh = innerHeight;
    const top = (sel) => document.querySelector(sel).getBoundingClientRect().top + scrollY;
    const hero = document.querySelector('.hero');
    const heroDist = hero.offsetHeight - vh;
    const work = document.querySelector('.work__viewport');
    const track = document.querySelector('.work__track');
    const workDist = Math.max(0, track.scrollWidth - work.clientWidth);
    return spec.map(([label, kind, v]) => {
      if (kind === 'hero') return [label, v * heroDist];
      if (kind === 'sel') return [label, top(v) - 70];
      if (kind === 'work') return [label, top('.work__viewport') + v * workDist];
      if (kind === 'end') return [label, 1e7];
      return [label, v];
    });
  }, spec);
  for (const [label, y] of positions) {
    await page.evaluate((yy) => window.scrollTo(0, yy), y);
    await page.waitForTimeout(1000);
    await page.screenshot({ path: `${out}/${name}-${label}.png` });
  }
  console.log(`[${name}] done`);
  await page.close();
}
await shoot('desktop', { width: 1440, height: 900 }, [
  ['00-hero', 'hero', 0], ['01-hero-30', 'hero', 0.3], ['02-hero-62', 'hero', 0.62], ['03-hero-90', 'hero', 0.9],
  ['04-thesis', 'sel', '#thesis'], ['05-quote', 'sel', '.quote'], ['06-work', 'sel', '#work'],
  ['07-work-0', 'work', 0], ['08-work-40', 'work', 0.4], ['09-work-100', 'work', 1],
  ['10-oss', 'sel', '#open-source'], ['11-writing', 'sel', '#writing'], ['12-about', 'sel', '#about'], ['13-contact', 'sel', '#contact'], ['14-foot', 'end'],
]);
await shoot('mobile', { width: 390, height: 844 }, [
  ['00-hero', 'hero', 0], ['01-hero-30', 'hero', 0.3], ['02-hero-62', 'hero', 0.62], ['03-hero-90', 'hero', 0.9],
  ['04-thesis', 'sel', '#thesis'], ['05-quote', 'sel', '.quote'], ['06-work', 'sel', '#work'], ['07-panel1', 'sel', '#greenlight'], ['08-panel5', 'sel', '#reclaim'],
  ['09-oss', 'sel', '#open-source'], ['10-writing', 'sel', '#writing'], ['11-about', 'sel', '#about'], ['12-contact', 'sel', '#contact'], ['13-foot', 'end'],
]);
await browser.close();
