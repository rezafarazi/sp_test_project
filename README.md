<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="360" alt="Laravel" />
</p>

<p align="center">
  <b>Simple Reports</b> — a small Laravel app that demonstrates authentication, role‑based dashboards, and a lightweight report review workflow with file uploads.
  <br/>
  <a href="#-what-you-get">What you get</a> · <a href="#-stack">Stack</a> · <a href="#-quick-start">Quick Start</a> · <a href="#-routes">Routes</a> · <a href="#-development-notes">Notes</a>
</p>

---

## What you get

- **Authentication**: session-based login/signup using Laravel guards
- **Roles**: `USER`, `ADMIN1`, `ADMIN2`
- **Reports**: users submit a report (title, text, optional PDF)
- **Workflow**:
  - `USER`: create reports
  - `ADMIN1`: lists reports with status `0` (new) and marks them `1` (checked)
  - `ADMIN2`: lists reports with status `1` and marks them `2` (finalized)
- **File uploads**: stored on the `public` disk and downloadable via a public link
- **SQLite by default** for easy local setup; **Docker** provided for MySQL/Redis/phpMyAdmin

## Stack

- PHP 8.2, Laravel 12
- Blade, Eloquent ORM
- Laravel Sanctum installed (not used in this demo)
- Docker images: `webdevops/php-nginx:8.2`, `mysql:8.0`, `phpmyadmin/phpmyadmin`, `redis:alpine`

## Data model

- `users_tbls` — `id, name, family, username, password, start_datetime, last_edit_datetime, role`
- `reports_tbls` — `id, title, text, file_addres, status, datetime`

Status legend: `0` new → `1` checked by `ADMIN1` → `2` finalized by `ADMIN2`.

---

## Quick Start

Choose one path: Local (SQLite) or Docker (MySQL).

### Local (SQLite)

Requirements: PHP 8.2+, Composer, Node 18+, npm

```bash
composer install
cp .env.example .env
php artisan key:generate

# Ensure SQLite file exists and run migrations
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan migrate --force

# Expose uploaded files
php artisan storage:link

# (optional) Frontend dev server (Vite)
npm install
npm run dev

# Start the app
php artisan serve
```

Visit `http://127.0.0.1:8000`. Use Signup to create a user and choose a role.

### Docker (MySQL + phpMyAdmin + Redis)

```bash
docker compose up -d
```

Then initialize the app (inside the container or on host if Composer is available):

```bash
docker exec -it laravel_app bash
composer install
cp .env.example .env
php artisan key:generate

# Update .env to match docker-compose
# DB_HOST=db
# DB_DATABASE=laravel
# DB_USERNAME=laravel
# DB_PASSWORD=laravel

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
- `GET /Dashboard` — role-aware dashboard (protected)
- `POST /NReport` — create a report (USER)
- `GET /Report/Check/{id}` — advance report status (ADMIN1/ADMIN2)

Protected by `App\Http\Middleware\UserLoginMiddleware`.

---

## Project structure (high level)

- `routes/web.php` — route definitions
- `app/Http/Controllers` — `LoginController`, `SignupController`, `DashboardController`, `ReportsController`
- `app/Http/Middleware/UserLoginMiddleware.php` — enforces auth for dashboard group
- `app/Models` — `users_tbl`, `reports_tbl`
- `resources/views` — Blade views for login, signup, dashboards
- `database/migrations` — schema for `users_tbls`, `reports_tbls`
- `storage/app/public/reports` — uploaded files (via `public` disk)

---

## Development notes

- The demo hashes passwords with SHA‑256 + static salt inside controllers. For production, replace with Laravel `Hash::make()`/`Hash::check()` and proper password column length.
- Timestamps are kept as strings in this demo to keep the schema simple. Prefer proper `timestamp`/`datetime` types and Eloquent `$timestamps = true` in real apps.
- File downloads require `php artisan storage:link`.

## Testing

```bash
php artisan test
```

## License

MIT


