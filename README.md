<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="360" alt="Laravel" />
</p>

<p align="center">
  <b>Simple Reports</b> — a minimal Laravel app showcasing auth, roles, and a small review workflow with file uploads.
  <br/>
  <a href="#-features">Features</a> · <a href="#-stack">Stack</a> · <a href="#-quick-start">Quick Start</a> · <a href="#-routes">Routes</a> · <a href="#-notes">Notes</a>
</p>

---

### Overview

This is a compact Laravel 12 project that demonstrates:

- Signup/Login using Laravel's auth guard (session-based)
- Three roles: `USER`, `ADMIN1`, `ADMIN2`
- Users can submit reports with an optional file (stored in `storage/app/public/reports`)
- Admins can review and advance report status through a basic workflow

The UI is intentionally minimal (plain Blade templates) to keep the focus on backend flow and correctness.

### Features

- Auth with basic middleware-protected dashboard
- Role-based dashboards:
  - `USER`: submit report (title, text, optional PDF)
  - `ADMIN1`: see reports with status `0` (new) and mark as `1` (checked)
  - `ADMIN2`: see reports with status `1` and mark as `2` (finalized)
- File upload and public download via `storage` symlink
- SQLite-ready by default (repo includes `database/database.sqlite`); Docker option for MySQL/Redis/phpMyAdmin

### Stack

- PHP 8.2, Laravel 12
- Sanctum installed (not actively used in this demo)
- Blade, Eloquent
- Docker images: `webdevops/php-nginx:8.2`, `mysql:8.0`, `phpmyadmin/phpmyadmin`, `redis:alpine`

### Data Model

- `users_tbls`: `id, name, family, username, password, start_datetime, last_edit_datetime, role`
- `reports_tbls`: `id, title, text, file_addres, status, datetime`

Statuses: `0` = new, `1` = checked by `ADMIN1`, `2` = finalized by `ADMIN2`.

---

## Quick Start

You can run locally (Composer + PHP) or via Docker. Choose one.

### Local (SQLite)

Requirements: PHP 8.2+, Composer, Node 18+, npm

```bash
composer install
cp .env.example .env
php artisan key:generate

# Use SQLite (already included)
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan migrate --force

# Make storage files publicly accessible
php artisan storage:link

# (optional) Frontend
npm install
npm run dev

# Run the server
php artisan serve
```

Open: `http://127.0.0.1:8000`

Signup a user and choose a role (`USER`, `ADMIN1`, or `ADMIN2`).

### Docker (MySQL + phpMyAdmin + Redis)

```bash
docker compose up -d
```

Then exec into the app container (or use your host if Composer is available) to install and migrate:

```bash
docker exec -it laravel_app bash
composer install
cp .env.example .env
php artisan key:generate

# Configure DB in .env to match docker-compose (host=db, user=laravel, pass=laravel, db=laravel)
php artisan migrate --force
php artisan storage:link
exit
```

Services:
- App: `http://localhost:8080`
- phpMyAdmin: `http://localhost:8081` (host: `db`, user: `root`, pass: `root`)

---

## Routes

- `GET /` — login form
- `POST /` — authenticate
- `GET /Signup` — signup form
- `POST /Signup` — create user and login
- `GET /Dashboard` — protected dashboard (role-aware)
- `POST /NReport` — create report (USER)
- `GET /Report/Check/{id}` — advance report status (ADMIN1/ADMIN2)

Middleware: `App\Http\Middleware\UserLoginMiddleware` protects the dashboard group.

---

## Development Notes

- Passwords are hashed using SHA-256 with a static salt in controllers. For production, prefer Laravel's `bcrypt`/`argon2id` via `Hash::make()` and migrations with `timestamps` and proper `datetime` columns.
- Files are stored on the `public` disk under `reports/`. Ensure `php artisan storage:link` is executed to enable downloads.
- Roles are selected at signup and used for conditional dashboards.

---

## Testing

```bash
php artisan test
```

---

## Project Structure (high-level)

- `routes/web.php` — route definitions
- `app/Http/Controllers` — auth, dashboard, reports controllers
- `app/Http/Middleware/UserLoginMiddleware.php` — auth gate for dashboard
- `app/Models` — Eloquent models `users_tbl`, `reports_tbl`
- `resources/views` — Blade templates for login, signup, dashboards
- `database/migrations` — schema for `users_tbls`, `reports_tbls`
- `storage/app/public` — uploaded files (via `public` disk)

---

## License

MIT
