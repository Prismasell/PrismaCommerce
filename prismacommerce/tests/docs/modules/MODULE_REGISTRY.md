# Prisma Module Registry Foundation

## Architecture

M1A-03 introduces the Prisma-owned module registry contract. It uses filesystem discovery of `module.json` manifests inside `modules/` and exposes typed manifest data through `ModuleRegistryContract`.

The registry is intentionally independent from `nwidart/laravel-modules`. That package may be used later as an internal helper, but Prisma Commerce owns the public module contract.

Core files:

- `config/prisma-modules.php`
- `app/Prisma/Modules/Contracts/ModuleRegistryContract.php`
- `app/Prisma/Modules/Data/ModuleManifest.php`
- `app/Prisma/Modules/ModuleManifestLoader.php`
- `app/Prisma/Modules/ModuleRegistry.php`
- `app/Prisma/Modules/Providers/ModuleRegistryServiceProvider.php`

## Database Schema

No database changes are introduced in M1A-03.

The registry is filesystem-first. Admin activation state, install logs, lifecycle events, and database-backed module state are later milestones.

## APIs

No public API endpoints are introduced in M1A-03.

Future API exposure must remain versioned under `/api/v1` and protected according to admin or integration API rules.

## Permissions

No permissions are created by M1A-03.

The manifest supports a `permissions` array so future permission seeding can be module-owned, but this milestone does not seed or hardcode permissions.

## Admin UI

No Filament resources are introduced in M1A-03.

Future admin module listing, enable/disable controls, and health checks belong to later M1A work.

## Tests

M1A-03 adds unit tests for:

- Valid manifest hydration.
- Invalid slug rejection.
- Unknown layer rejection.
- Enabled module discovery.
- Disabled module filtering.
- Invalid manifest skipping during registry discovery.
- Missing module directory handling.
- Invalid manifest loader failures.

## Implementation Steps

1. Add `config/prisma-modules.php`.
2. Register `ModuleRegistryServiceProvider`.
3. Bind `ModuleRegistryContract` to `ModuleRegistry`.
4. Discover enabled module manifests from the configured `modules/` path.
5. Cache discovery results with a short configurable TTL.
6. Add test fixture manifests under `tests/Fixtures/modules`.
7. Add unit tests for manifest validation and registry discovery.

## Acceptance Criteria

- Registry can discover enabled module manifests.
- Registry ignores disabled module manifests.
- Registry skips invalid manifests during broad discovery so one bad module cannot break the platform boot path.
- Direct manifest loading validates required fields, slugs, and layers strictly.
- Registry can return a manifest by slug.
- No commerce, CMS, plugin, theme, or admin UI features are implemented.
- No database tables or migrations are introduced.
