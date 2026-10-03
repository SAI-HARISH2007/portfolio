import { defineConfig, loadEnv } from 'vite';

/* Heavy media (frames, fonts, video) lives in ./cdn and is served from the
   GitHub repo through jsDelivr in production, so the web host only receives
   the handful of small files that Vite writes to ./dist. In dev, Vite serves
   ./cdn straight from the project root. */

export default defineConfig(({ mode }) => {
  const env = loadEnv(mode, process.cwd(), '');
  const assetBase = env.VITE_ASSET_BASE ?? '/cdn';

  return {
    base: env.VITE_BASE ?? '/',
    plugins: [
      {
        name: 'asset-base-in-css',
        enforce: 'pre',
        transform(code, id) {
          if (/\.css(\?|$)/.test(id) && code.includes('__ASSET_BASE__')) {
            return { code: code.replaceAll('__ASSET_BASE__', assetBase), map: null };
          }
        },
      },
    ],
    build: {
      outDir: 'dist',
      assetsDir: 'assets',
      target: 'es2020',
      rollupOptions: {
        output: { manualChunks: { vendor: ['gsap', 'gsap/ScrollTrigger', 'lenis'] } },
      },
    },
    // /mnt/c under WSL gets no inotify events; poll so edits are picked up.
    server: { port: 5173, host: true, watch: { usePolling: true, interval: 300 } },
  };
});
