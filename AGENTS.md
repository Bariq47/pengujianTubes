# EraTrans — Car Rental Management System

## Stack
- **Laravel 10** + PHP 8.1+ (MySQL `eratrans`)
- **Livewire 3** full-page components (SPA via `wire:navigate`)
- Bootstrap 5 + SASS + Vite (`npm run dev` / `npm run build`)
- Midtrans (WhatsApp redirect only — no Snap UI), DomPDF, Maatwebsite/Laravel-Excel
- Docker: PHP 8.3 FPM + nginx + MySQL 8.0

## Roles & Auth
- `role_id = 1` → admin, `role_id = 2` → member
- Middleware aliases: `admin-only`, `member-only`
- Routes: `/` is **public** (no middleware); guest-only: `/auth/*`; `auth` → `admin-only` (prefix `admin/`) or `member-only` (prefix `member/`)
- Livewire layouts: `layouts.guest-layout` (auth), `layouts.home-layout` (home), `layouts.app-layout` (admin, member, profile)
- Login redirect: no profile → `profile-create`; role_id=1 → `admin-dashboard`; else → `member-dashboard`
- `RouteServiceProvider::HOME = '/'` (fallback redirect when authenticated user hits guest route)

## Key structure
- `app/Livewire/` — 19 components: Admin(9), Member(5), Auth(2), Home(1), Profile(2)
- `app/Http/Controllers/` — `DomPdfController` (invoice PDF), `MidtransController` (Midtrans callback), `OrderController` (Excel export), `PaymentController` (WhatsApp + confirm)
- `routes/web.php` — `GET /orders/export` is **public** (no middleware); duplicate `redirect-to-payment` route defined at lines 98 and 102; `/` is public
- `routes/api.php` — Midtrans callback `POST /api/pesanan/callback` (no auth)
- Admin view dirs use **kebab-case** (`jenis-mobil/`); member dirs use single words (`pesanan/`)
- Seeder order: Role → User → Profile → JenisMobil → MerekMobil → Kantor → Supir → Mobil
- Factories: only `UserFactory.php`

## Dev commands
```
composer install
npm install
npm run dev             # Vite dev server
npm run build           # Vite build
php artisan serve       # Laravel dev server
php artisan migrate:fresh --seed
php artisan storage:link    # Required for image uploads
./vendor/bin/pint           # Formatter only
```

## Testing
- `./vendor/bin/phpunit` — single/filter tests (`--filter TestName`)
- Unit: `PHPUnit\Framework\TestCase` (no Laravel boot)
- Feature: `Tests\TestCase` (needs DB)
- `phpunit.xml`: DB config **commented out** — feature tests need MySQL or uncomment sqlite lines
- Only ExampleTest stubs exist (no real tests written)

## Payments
- **WhatsApp redirect only** (no Midtrans Snap UI): `PaymentController@redirectToPayment` hardcodes `6285731021898`
- **Midtrans callback** (`POST /api/pesanan/callback`): updates `status_bayar`; signature verification (`hash('sha512', ...)`) is **commented out**
- **Admin confirm** (`/member/confirm-payment/{id}`): sets `status_bayar = konfirmasi`, creates `Pengembalian` record (under member prefix but redirects to admin-pesanan)
- **Invoice PDF** (`/member/export/pdf/{id}`): DomPdfController (member-only)
- `config/midtrans.php` reads `MIDTRANS_MERCHANT_ID/CLIENT_KEY/SERVER_KEY` from env — **none set in `.env` or `.env.example`**

## Quirks
- **`.env.example` exists** and is used as deploy template (`.env` is gitignored); update `APP_URL`, DB, etc. before copying
- **`MemberOnly` middleware** has **empty if-block** — non-members silently pass through (no redirect)
- **`AdminOnly` middleware** redirects back on mismatch
- **No CI** — no `.github/` directory

## Docker deploy
```
docker-compose up -d --build
```
- **Dockerfile**: `composer install --no-dev`; `npm ci && npm run build && rm -rf node_modules` (vite is devDependency, so `--omit=dev` would fail). `libicu-dev` required for `intl` PHP extension.
- **`docker-entrypoint.sh`**: `php artisan migrate --force` + `db:seed --force`; caches config/route/view only in production (`APP_ENV=production`)
- **`docker-compose.yml`**: MySQL host port `3307`; mounts `./public/images` on app, `./public` on web
- **`docker.sh`** (VPS script): uses `docker-compose` v1 commands
- **SSL**: nginx listens on `:80` only — terminate HTTPS via reverse proxy on host

## Do not modify
- `vendor/`, `node_modules/`, `eratrans.sql`, `public/build/`
