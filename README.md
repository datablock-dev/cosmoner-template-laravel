# Laravel on Cosmoner

[![Deploy to Cosmoner](https://cosmoner.com/deploy-button.svg)](https://cosmoner.com/deploy?repo=https://github.com/datablock-dev/cosmoner-template-laravel)

A [Laravel](https://laravel.com) app that stores its data in SQLite, so there
is no database to set up. Ready to run as a web service on
[Cosmoner](https://cosmoner.com).

It is the standard Laravel skeleton, with Vite and Tailwind CSS for the
front end, set up to deploy as it is:

- Sessions, cache and queued jobs use the SQLite database, as Laravel does by
  default.
- `bootstrap/app.php` trusts the platform's proxy headers, so links and assets
  use `https://`.
- `GET /up` is Laravel's health check.

## What happens on deploy

The app is built automatically: Composer installs the PHP dependencies from
`composer.lock`, npm builds the front end from `package-lock.json`, and the
app is served by FrankenPHP on the port in the `PORT` environment variable,
which Cosmoner sets for you. Each time the app starts it runs
`php artisan migrate --force`, which also creates the SQLite database file if
it is not there yet, and then caches its configuration, routes and views.

## Deploy

Select the button above, copy the template to your GitHub account, and deploy
your copy. The wizard can fill in every setting from
`.cosmoner/deployment.yaml`, and asks you for one value:

| Variable | What to enter |
|----------|---------------|
| `APP_KEY` | Laravel's encryption key. Generate one with `php artisan key:generate --show`, or with `echo "base64:$(openssl rand -base64 32)"`. |

## About the SQLite database

The database is a file, `database/database.sqlite`, inside the running app.
That keeps the app self-contained, and it comes with limits worth knowing:

- **It starts empty on every deploy.** Each deploy and each restart runs a
  fresh copy of the app, so anything stored in the database, including
  sessions, is gone afterwards. Use it for data you can lose: demos, caches,
  prototypes.
- **Each instance has its own copy.** Keep the app at one instance, or
  visitors will see different data depending on which instance answers.

When your data needs to last, create a
[PostgreSQL database](https://cosmoner.com/docs/guides/databases), store its
connection string as a [secret](https://cosmoner.com/docs/guides/secrets)
named `DB_URL`, and add the variables `DB_CONNECTION=pgsql` and
`DB_URL` (linked to that secret) to the app. Laravel reads both, and the
migrations run against PostgreSQL on the next deploy.

## Run locally

Requires PHP 8.3 or newer, Composer, and Node.js 24.

```bash
composer setup
composer dev
```

`composer setup` installs the dependencies, creates `.env` with a fresh
`APP_KEY`, creates the SQLite database and runs the migrations. `composer dev`
starts the app on http://localhost:8000 with Vite and the queue worker.

## License

MIT
