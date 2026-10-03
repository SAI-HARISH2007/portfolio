// Render the Open Graph card from scripts/og.html: node scripts/og.mjs  (dev server must be running)
import { chromium } from 'playwright-core';
import { homedir } from 'node:os';
const browser = await chromium.launch({ executablePath: `${homedir()}/.cache/ms-playwright/chromium-1228/chrome-linux64/chrome`, args: ['--no-sandbox'] });
const page = await browser.newPage({ viewport: { width: 1200, height: 630 } });
await page.goto('http://localhost:5173/scripts/og.html', { waitUntil: 'networkidle' });
await page.evaluate(() => document.fonts.ready);
await page.waitForTimeout(300);
await page.screenshot({ path: 'cdn/media/og.jpg', type: 'jpeg', quality: 86 });
await browser.close();
console.log('cdn/media/og.jpg written');
