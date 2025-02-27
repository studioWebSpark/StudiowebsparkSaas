// Service Worker pour mettre en cache les ressources critiques
const CACHE_NAME = 'studiowebspark-cache-v1';
const CRITICAL_ASSETS = [
  '/fonts/figtree-600.woff2',
  '/css/app.css',
  '/js/app.js',
  '/favicon.svg'
];

// Installation du service worker
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        return cache.addAll(CRITICAL_ASSETS);
      })
  );
});

// Stratégie de mise en cache : network first, puis cache
self.addEventListener('fetch', (event) => {
  event.respondWith(
    fetch(event.request)
      .catch(() => {
        return caches.match(event.request);
      })
  );
}); 