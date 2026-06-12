# Prisma Commerce

Prisma Commerce is an API-first Laravel commerce platform foundation.

This package includes **M1A-02: Laravel + Filament Baseline** and the additive **M1A-03: Core Modular Directory and Prisma Module Registry Foundation** changes.

## M1A-02 Scope

- Laravel application baseline targeting PHP 8.3+.
- Filament admin panel registered at `/admin`.
- Sanctum installed for API-token readiness.
- Redis-ready cache, queue, and session configuration.
- Versioned API base path under `/api/v1`.
- Foundation endpoints:
  - `GET /api/v1/health`
  - `GET /api/v1/metadata`
- Baseline migrations:
  - users, password reset tokens, sessions
  - cache and cache locks
  - jobs, job batches, failed jobs
  - personal access tokens
- Pest/PHPUnit test suite.
- GitHub Actions CI workflow.
- Empty top-level extension folders retained for platform structure:
  - `modules/`
  - `plugins/`
  - `themes/`

## M1A-03 Scope

- Prisma-owned module registry contract.
- Filesystem discovery of `module.json` manifests from `modules/`.
- Typed module manifest validation.
- Registry service provider binding.
- Module registry configuration.
- Module architecture documentation.
- Unit tests using fixture manifests.

## Out of Scope

M1A-04 has not been started. This deliverable does not implement commerce features, official module skeleton internals, admin module management UI, database-backed module state, route auto-loading, migration auto-loading, or permission seeding.

## Quick Install

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run build
php artisan serve
```

Open:

- App: `http://127.0.0.1:8000`
- Admin: `http://127.0.0.1:8000/admin`
- API health: `http://127.0.0.1:8000/api/v1/health`

For complete instructions, see [docs/INSTALLATION.md](docs/INSTALLATION.md).

## Test Commands

```bash
composer test
composer format
npm run build
```

See [docs/TEST_RESULTS.md](docs/TEST_RESULTS.md) for the verification performed for this package.
