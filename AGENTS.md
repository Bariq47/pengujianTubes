# EraTrans — Car Rental Management System

## Stack
- **Laravel 10** + PHP 8.1+ (MySQL `eratrans`)
- **Livewire 3** full-page components (SPA via `wire:navigate`)
- Bootstrap 5 + SASS + Vite (`npm run dev` / `npm run build`)
- Midtrans (WhatsApp redirect only — no Snap UI), DomPDF, Maatwebsite/Laravel-Excel
- Docker: PHP 8.3 FPM + nginx + MySQL 8.0

## Roles & Auth
- `role_id = 1` → admin, `role_id = 2` → member
- Middleware aliases (`app/Http/Kernel.php`): `admin-only`, `member-only`
- Routes: `/` is **public** (no middleware); guest-only: `/auth/*`; `auth` → `admin-only` (prefix `admin/`) or `member-only` (prefix `member/`)
- Livewire layouts: `layouts.guest-layout` (auth), `layouts.home-layout` (home), `layouts.app-layout` (admin, member, profile)
- Login redirect: no profile → `profile-create`; role_id=1 → `admin-dashboard`; else → `member-dashboard`
- `RouteServiceProvider::HOME = '/'` (fallback redirect when authenticated user hits guest route)

## Key structure
- `app/Livewire/` — 19 components: Admin(9), Member(5), Auth(2), Home(1), Profile(2)
- `app/Http/Controllers/` — `DomPdfController` (invoice PDF), `MidtransController` (Midtrans callback), `OrderController` (Excel export), `PaymentController` (WhatsApp + confirm)
- `app/Models/` — 11 models (JenisMobil, Kantor, MerekMobil, Mobil, Pengembalian, Pesanan, Profile, Role, Supir, TransaksiPembayaran, User)
- `routes/web.php` — `GET /orders/export` is **public** (no middleware); duplicate `redirect-to-payment` route defined twice; `/` is **public** (not behind guest middleware)
- `routes/api.php` — Midtrans callback `POST /api/pesanan/callback` (no auth)
- `resources/views/livewire/` — admin dirs use **kebab-case** (`jenis-mobil/`); member dirs use single words (`pesanan/`)
- `database/migrations/` — 19 migrations
- `database/seeders/` — 8 data seeders + `DatabaseSeeder` orchestrator (order: Role → User → Profile → JenisMobil → MerekMobil → Kantor → Supir → Mobil)
- Factories: only `UserFactory.php`

## Dev commands
```
composer install
npm install
npm run dev             # Vite dev server
npm run build           # Vite build
php artisan serve       # Laravel dev server
php artisan db:seed     # Seed DB (after migrate:fresh)
php artisan migrate:fresh --seed
php artisan storage:link    # Required for image uploads
./vendor/bin/pint           # Only formatter (no php-cs-fixer)
```

## Testing
```
./vendor/bin/phpunit                     # All tests
./vendor/bin/phpunit tests/Unit/
./vendor/bin/phpunit tests/Feature/
./vendor/bin/phpunit --filter TestName
```
- Unit: `PHPUnit\Framework\TestCase` (no Laravel app boot)
- Feature: `Tests\TestCase` (needs DB)
- `phpunit.xml`: DB config **commented out** — feature tests need MySQL or uncomment sqlite lines
- Only ExampleTest stubs exist (no real tests written)

## Payments
- **WhatsApp redirect** (no Midtrans Snap): `PaymentController@redirectToPayment` hardcodes `6285731021898`
- **Midtrans callback** (`POST /api/pesanan/callback`): updates `status_bayar`. Signature verification (`hash('sha512', ...)`) is **commented out**
- **Admin confirm** (`/member/confirm-payment/{id}`): sets `status_bayar = konfirmasi`, creates `Pengembalian` (under member prefix but redirects to admin-pesanan)
- **Invoice PDF** (`/member/export/pdf/{id}`): DomPdfController generates invoice PDF (member-only)
- `config/midtrans.php` reads `MIDTRANS_MERCHANT_ID/CLIENT_KEY/SERVER_KEY` from env — **none set in `.env`**

## Setup quirks
- **No `.env.example`** (create one before deploy) — `.env` is gitignored
- **Midtrans env vars missing** from `.env`
- **`GET /orders/export`** is publicly accessible (no middleware) — OrderController exports all Pesanan to Excel
- **`MemberOnly` middleware** (`app/Http/Middleware/MemberOnly.php`) has **empty if-block** — non-members silently pass through (no redirect)
- **`AdminOnly` middleware** redirects back on mismatch
- **No CI** — no `.github/` directory

## Docker deploy
```
docker-compose up -d --build
```
- `Dockerfile`: PHP 8.3 FPM + Node 20 + Composer; `composer install --no-dev`; `npm ci && npm run build` (vite is devDependency, so `--omit=dev` would fail)
- Requires `nginx.conf`, `docker-entrypoint.sh`, `.dockerignore` at repo root
- `docker-entrypoint.sh`: `php artisan migrate --force` + `db:seed --force`; caches config/route/view in production
- `docker-compose.yml` mounts: `./public/images` on app (image uploads persist), `./public` on web (nginx serves files)
- `.dockerignore` excludes: `vendor`, `node_modules`, `.git`, `public/storage`, `eratrans.sql` — `.env` is intentionally included (needed for `APP_KEY`)
- **Build quirk**: `libicu-dev` required for `intl` PHP extension
- MySQL host port: `3307`

## VPS deploy (Docker)
```
git clone <repo> && cd <repo>
cp .env.example .env
./docker.sh
```
- `.env` is **gitignored** — `.env.example` serves as template (update `APP_URL`, DB, etc. before `cp`)
- Set `nginx.conf` `server_name` to domain before pushing
- **SSL**: current nginx only listens on `:80`. Handle HTTPS via reverse proxy (e.g., nginx/caddy on host with Let's Encrypt) or mount certs into container

## Do not modify
- `vendor/`, `node_modules/`, `eratrans.sql`
- `public/build/` (regenerated by `npm run build`)
