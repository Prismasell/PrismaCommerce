# Prisma Commerce Modules

This directory is reserved for official Prisma Commerce modules.

M1A-03 establishes the module registry foundation only. It does not create official module skeletons or commerce features.

## Required Manifest

Each future module must provide a `module.json` file at its module root.

```json
{
  "name": "Core",
  "slug": "core",
  "version": "1.0.0",
  "layer": "core",
  "enabled": true,
  "description": "Core platform services.",
  "providers": [
    "Modules\\Core\\Providers\\CoreServiceProvider"
  ],
  "dependencies": [],
  "permissions": [],
  "routes": {
    "web": "Routes/web.php",
    "admin": "Routes/admin.php",
    "api": "Routes/api.php"
  },
  "migrations_path": "Database/Migrations"
}
```

## Approved Module Layers

- `core`
- `commerce`
- `cms`
- `integration`
- `extension`

## Approved Future Module Shape

```text
modules/Example/
├── Config/
├── Database/
│   ├── Migrations/
│   └── Seeders/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Resources/
├── Models/
├── Services/
├── Repositories/
├── Filament/
│   ├── Resources/
│   └── Widgets/
├── Routes/
│   ├── web.php
│   ├── admin.php
│   └── api.php
├── Providers/
├── Tests/
└── docs/
```
