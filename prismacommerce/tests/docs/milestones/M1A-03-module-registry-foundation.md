# M1A-03: Core Modular Directory and Prisma Module Registry Foundation

## Goal

Create the approved Prisma Commerce module architecture foundation without implementing commerce features or starting M1A-04.

## Scope

- Prisma-owned module manifest contract.
- Filesystem discovery from `modules/`.
- Typed module manifest value object.
- Module registry service and contract.
- Configurable cache settings.
- Laravel service provider binding.
- Module directory documentation.
- Unit tests using isolated fixture modules.

## Out of Scope

- M1A-04.
- Commerce features.
- Official module skeleton implementations.
- Module lifecycle commands.
- Admin module management UI.
- Database-backed module state.
- Permission seeding.
- Route auto-loading.
- Migration auto-loading.
- Plugin or theme lifecycle behavior.

## Architecture

The registry sits in the Core Layer and prepares later module work while keeping module ownership boundaries explicit.

Service boundaries:

- `ModuleManifest` owns manifest typing and validation.
- `ModuleManifestLoader` owns JSON loading.
- `ModuleRegistry` owns discovery and lookup.
- `ModuleRegistryServiceProvider` owns Laravel container binding.
- `config/prisma-modules.php` owns registry settings and approved layer names.

Extension points:

- Future modules add `module.json`.
- Future admin UI can read `ModuleRegistryContract`.
- Future route/migration loading can use manifest paths.
- Future permission seeding can use manifest permissions.

## Database Schema

No migrations or database changes are included.

## APIs

No API endpoints are included.

## Permissions

No permissions are registered or seeded.

## Admin UI

No Filament resources, pages, widgets, or navigation are included.

## Tests

Tests cover manifest validation, invalid manifest skipping during registry discovery, and direct loader failures with fixture modules only.

## Implementation Steps

1. Add the Prisma module namespace under `app/Prisma/Modules`.
2. Add module registry config.
3. Register the module registry provider in the Laravel bootstrap provider list.
4. Add `modules/README.md` documenting the required future module shape.
5. Add fixture manifests and unit tests.
6. Run static checks and PHP test commands on the target environment.

## Acceptance Criteria

- The registry is bound through `ModuleRegistryContract`.
- Enabled module manifests can be discovered.
- Disabled manifests are ignored.
- Invalid manifests are skipped during registry discovery.
- Invalid manifests fail validation when loaded directly through the manifest loader.
- No official module skeletons or commerce features are implemented.
- M1A-04 is untouched.
