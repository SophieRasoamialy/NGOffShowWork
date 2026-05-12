# NGOffShowWork

NGOffShowWork is a web platform for connecting clients, CDO partners, administrators, and developers around project work. The application lets administrators publish and manage projects, developers discover projects and submit work, and CDO users follow validation, participation, and project activity through dedicated dashboards.

## What the platform does

- **Project management**: create, list, validate, archive, and review projects.
- **Developer workspace**: developer registration requests, profile management, project discovery, participation, and deliverable submission.
- **CDO workspace**: CDO account requests, validation flows, dashboard access, project follow-up, and archives.
- **Administration**: manage categories, skills, developers, CDO partners, participants, project submissions, commissions, and application settings.
- **Submissions and results**: developers can submit Git links and administrators/CDO users can review, score, accept, and proclaim results.
- **Notifications**: application notifications support project, user, participation, deletion, validation, and response events.
- **Payments and subscriptions**: Stripe-powered payment flow and subscription records for premium developer/CDO/project features.

## Main user roles

| Role | Purpose |
| --- | --- |
| Admin | Oversees the platform, validates users/projects, manages reference data, reviews submissions, and configures settings. |
| Developer | Builds a profile, discovers projects, participates, submits deliverables, and tracks results. |
| CDO | Uses a partner dashboard to manage or follow projects, developers, participations, archives, and validations. |
| Guest/client | Can access the public landing page and register/login to start using the platform. |

## Tech stack

- **Backend**: PHP 7.3+/8.x with Laravel 8
- **Frontend**: Blade templates, Laravel Livewire 2, Bootstrap, Tailwind CSS, Flowbite, and Laravel Mix
- **Database**: MySQL-compatible database
- **Authentication**: Laravel UI authentication with email verification
- **Payments**: Stripe PHP SDK
- **Realtime/websocket support**: BeyondCode Laravel WebSockets
- **Deployment**: Docker image based on Nginx + PHP-FPM

## Project structure

```text
app/Http/Livewire/      Livewire components for dashboards, projects, users, payments, submissions, and settings
app/Models/             Eloquent models for users, developers, CDOs, projects, participations, submissions, subscriptions, and reference data
app/Notifications/      Notification classes used by the platform workflows
database/migrations/    Database schema for the application domain
resources/views/        Blade and Livewire views for public pages and role-specific dashboards
routes/web.php          Web routes grouped by role middleware
public/                 Public assets and compiled frontend files
Dockerfile              Production container definition
start.sh                Container startup script for PHP-FPM, storage link, permissions, and Nginx
```

## Requirements

- PHP compatible with the Laravel version used by this project (`^7.3` or `^8.0`)
- Composer
- Node.js and npm
- MySQL or a compatible database
- Stripe credentials if payment features are enabled

## Local setup

1. **Install PHP dependencies**

   ```bash
   composer install
   ```

2. **Install frontend dependencies**

   ```bash
   npm install
   ```

3. **Create the environment file**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure the environment**

   Update `.env` with your local database, mail, queue, websocket, and payment settings. At minimum, confirm these values:

   ```env
   APP_NAME=NGOffShowWork
   APP_URL=http://localhost:8000
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ngoffshowwork
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run database migrations and seed the default administrator**

   ```bash
   php artisan migrate --seed
   ```

6. **Link storage for uploaded/public files**

   ```bash
   php artisan storage:link
   ```

7. **Build frontend assets**

   ```bash
   npm run dev
   ```

8. **Start the development server**

   ```bash
   php artisan serve
   ```

   The application will be available at `http://localhost:8000` unless you use a different host or port.

## Common commands

```bash
# Run the PHP test suite
php artisan test

# Watch frontend assets during development
npm run watch

# Build production frontend assets
npm run prod

# Clear cached Laravel configuration/views/routes
php artisan optimize:clear

# List registered routes
php artisan route:list
```

## Docker deployment

The repository includes a `Dockerfile` and `start.sh` for an Nginx/PHP-FPM deployment. The container startup script starts PHP-FPM, creates the public storage symlink when needed, fixes storage/cache permissions, and runs Nginx in the foreground.

When deploying with Docker, provide production-ready environment variables for the application key, database, mail, queue, websocket, and payment integrations. The Docker image exposes ports `80` and `9000`.

## Notes for maintainers

- Keep secrets, payment keys, database passwords, and API tokens out of source control; use environment variables instead.
- Review seeded credentials before using this project in a shared or production environment.
- Payment code should use environment-based Stripe keys before production use.
- Several workflows are role-protected, so test changes with admin, developer, and CDO accounts when possible.

## License

No project-specific license file is currently included in this repository. Add a license before distributing or open-sourcing the application.
