# Copilot / AI helper guidance for this repository

This file contains concise, repo-specific instructions to help an AI coding assistant be productive immediately.

## Quick context
- Framework: Laravel 12 (PHP backend) with Vite + Tailwind/Alpine frontend.
- Main tech: PHP ^8.2, MySQL (development), SQLite in-memory for tests, Node/Vite for assets.

## Quick start (common developer commands)
- Install PHP deps: `composer install`
- Install JS deps: `npm install`
- Local build (prod style): `npm run build`
- Dev (assets + server + queue): run `composer dev` — it uses `concurrently` to start `php artisan serve`, `php artisan queue:listen`, `php artisan pail` and `npm run dev`.
- Run migrations: `php artisan migrate` (the repo also ships migrations under `database/migrations`).
- Run tests: `composer test` or `php artisan test` (phpunit config uses an in-memory SQLite DB).

## Important files & where to look
- Routes and role-based dashboard routing: `routes/web.php` (see the `/dashboard` route that redirects based on `Auth::user()->role->name`).
- Role enforcement middleware: `app/Http/Middleware/RoleMiddleware.php` — used across dashboard routes.
- Models: `app/Models/` (e.g. `User.php`, `Role.php`). Note relationships are set on models (e.g. `User::role()` and `Role::users()`).
- Controllers: `app/Http/Controllers/` — add new request handling logic here.
- Views: `resources/views/` — blade templates and dashboards.
- Migrations and seeders: `database/migrations/` and `database/seeders/`.
- Frontend assets: `resources/js`, `resources/css` and `vite.config.js` / `tailwind.config.js`.

## Project-specific conventions & gotchas
- Role checks are string-based: middleware compares `Auth::user()->role->name` to literal role names (e.g. `Administrativo`). When adding roles, keep database `roles.name` values consistent.
- Tests expect an in-memory SQLite DB (see `phpunit.xml`). Preserve this when writing/adjusting tests — do not assume a MySQL test DB.
- Dev helper script: `composer dev` orchestrates multiple processes with `concurrently`. Use it for a full dev environment.
- Background jobs: dev script runs `php artisan queue:listen`. Many features expect synchronous processing in tests (`QUEUE_CONNECTION=sync`) but background workers run in dev.
- User model uses a `role()` relationship; update factories and seeders accordingly (see `database/factories` and migration files that add roles to users).
- Note: `User.php` defines casts via a `protected function casts(): array` instead of the more common `protected $casts` property — be mindful when changing model attributes or refactoring casting behavior.

## Integration points & external deps
- Auth scaffolding: Breeze/Fortify (auth routes come from `routes/auth.php`).
- Frontend: Vite + Tailwind + Alpine.
- Useful composer/dev packages in the repo: `laravel/pail` (runtime helper used in dev script), `laravel/pint`, `laravel/sail`.

## Working on features & tests — concrete examples
- Add a role-protected route:

  - Update `routes/web.php` and add `->middleware(['auth', 'role:MyRole'])` or use `RoleMiddleware` if you prefer explicit middleware class usage.

- To write an integration test for a dashboard redirect:

  - Create a user with the appropriate `role_id` via the factories in `database/factories`, `actingAs($user)` and `get('/dashboard')` expecting redirect to the role route.

## When to look at these files for PRs
- Structural/auth changes: `routes/`, `app/Http/Middleware/`, `app/Models/`, `database/migrations/`
- Build / assets issues: `package.json`, `vite.config.js`, `resources/js`, `resources/css`, `tailwind.config.js`
- CI / tests problems: `phpunit.xml`, `composer.json` (scripts), `tests/`

## Safety & style notes for AI assistants
- Preserve literal role names stored in DB when updating authentication/authorization logic.
- Do not assume test DB is MySQL; use the current `phpunit.xml` settings for tests.
- Keep migrations and model `$fillable` fields in sync when generating new seeder/factory code.

If any of these sections are incomplete or you'd like me to expand examples (e.g., an example test or a small task scaffold), tell me which area to expand.
