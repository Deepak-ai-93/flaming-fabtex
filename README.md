# Fleming Fabtex

Laravel storefront for Fleming Fabtex, with a Vite-built responsive interface and product, cart, quote, contact, and account pages.

## Local development

Requirements: PHP 8.2+, Composer 2, Node.js 24+, and npm.

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
npm ci
npm run build
php artisan serve
```

## Vercel deployment

The project uses Vercel's container runtime with FrankenPHP. Import this repository into Vercel with the project root set to the repository root. The `vercel.json` routes requests to `Dockerfile.vercel`; that image builds the frontend assets and installs production PHP dependencies.

Set these project environment variables in Vercel:

- `APP_KEY`: generate a dedicated key with `php artisan key:generate --show` and add it in Vercel. Do not commit it or reuse the local `.env` key.
- `APP_URL`: the production Vercel URL.
- `APP_ENV=production` and `APP_DEBUG=false` (also set as container defaults).

The default container uses cookie sessions, in-memory cache, synchronous jobs, and stderr logging. Vercel container files are not durable. Before enabling account login or other database-backed features, configure a persistent external database, set its `DB_*` environment variables, and run migrations against it. Do not deploy the local SQLite database. Store any future user uploads in external object storage.

The Vercel container runtime is currently in beta. Build and deployment also require a Vercel account and a configured Vercel project.
