# Core Module Foundation

## Goal

M1A-04 introduces `modules/Core` as the first official Prisma Commerce module.

The Core module owns foundational contracts and registries used by later modules. It does not implement commerce features, routes, migrations, admin resources, plugin behavior, or theme behavior.

## Architecture

The Core module belongs to the Core Layer.

Responsibilities:

- Core service provider.
- Version registry contract and in-memory foundation implementation.
- Health check contract and registry foundation.
- Diagnostics probe contract and repository foundation.
- Event registration contract.
- Hook registration contract.
- Permission registry placeholder contract.

Boundaries:

- No database ownership in M1A-04.
- No API ownership in M1A-04.
- No Filament resource ownership in M1A-04.
- No commerce domain ownership in M1A-04.

## Database Schema

No migrations are included.

## APIs

No routes or API endpoints are included.

## Permissions

The Core module includes `PermissionRegistryContract` and `PermissionRegistry` as placeholders only.

No permissions are seeded, synchronized, or hardcoded into Spatie Permission in M1A-04.

## Admin UI

No Filament resources, pages, widgets, or navigation entries are included.

## Tests

Tests are included under:

```text
modules/Core/Tests/Unit/
```

Run:

```bash
php artisan test modules/Core/Tests/Unit
```

## Implementation Steps

1. Copy `safe-copy/modules/Core` into the project root.
2. Apply `manual-merge/composer-json.md`.
3. Run `composer dump-autoload`.
4. Run Core module tests.

## Acceptance Criteria

- `modules/Core/module.json` is valid and discoverable by the M1A-03 module registry.
- Core provider binds only foundation contracts.
- Provider is not auto-executed by Laravel boot in M1A-04.
- No migrations, routes, APIs, Filament resources, or commerce features are added.
