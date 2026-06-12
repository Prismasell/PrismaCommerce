# Prisma Commerce M1A-03 Patch Package

This package contains only the additive M1A-03 work:

**Core Modular Directory and Prisma Module Registry Foundation**

It is intended to be applied to the already validated M1A-02 repository. Do not replace the existing repository with this package.

## Contents

- `M1A-03.patch` - unified patch from the M1A-02 reference to M1A-03.
- `changed-files/` - changed and newly added files only, preserving repository-relative paths.

## Safe Apply Option

From the root of the existing Prisma Commerce repository:

```bash
git status
git apply --check /path/to/M1A-03.patch
git apply /path/to/M1A-03.patch
composer dump-autoload
php artisan config:clear
php artisan test --filter=ModuleManifestTest
php artisan test --filter=ModuleRegistryTest
```

If the existing SiteGround repository differs from the reference package, inspect the patch first and copy the matching files from `changed-files/` manually.

## Added Architecture

- `App\Prisma\Modules\Contracts\ModuleRegistryContract`
- `App\Prisma\Modules\Data\ModuleManifest`
- `App\Prisma\Modules\ModuleManifestLoader`
- `App\Prisma\Modules\ModuleRegistry`
- `App\Prisma\Modules\Providers\ModuleRegistryServiceProvider`
- `config/prisma-modules.php`
- `modules/README.md`
- M1A-03 registry documentation and tests

## Explicit Non-Goals

- M1A-04 was not started.
- No commerce features were implemented.
- No official module skeleton internals were implemented.
- No database migrations were added.
- No public APIs were added.
- No Filament admin resources were added.
- No permission seeding was added.
