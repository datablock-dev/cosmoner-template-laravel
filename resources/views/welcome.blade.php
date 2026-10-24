<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel on Cosmoner</title>

        @fonts

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            {{-- Before `npm run build`, keep the page readable without the stylesheet. --}}
            <style>body { max-width: 40rem; margin: 3rem auto; padding: 0 1.5rem; font-family: system-ui, sans-serif; line-height: 1.6; }</style>
        @endif
    </head>
    <body class="bg-stone-50 text-stone-900 dark:bg-stone-950 dark:text-stone-100">
        <main class="mx-auto max-w-2xl px-6 py-16 leading-relaxed">
            <h1 class="text-3xl font-semibold tracking-tight">Laravel on Cosmoner</h1>

            <p class="mt-4 text-stone-600 dark:text-stone-400">
                This app stores its sessions, cache and jobs in SQLite. Edit
                <code class="font-mono text-sm">resources/views/welcome.blade.php</code>
                and push to redeploy.
            </p>

            <dl class="mt-8 grid grid-cols-[max-content_1fr] gap-x-6 gap-y-2 rounded-lg border border-stone-200 p-5 dark:border-stone-800">
                <dt class="font-medium">Laravel</dt>
                <dd class="font-mono text-sm">{{ app()->version() }}</dd>
                <dt class="font-medium">PHP</dt>
                <dd class="font-mono text-sm">{{ PHP_VERSION }}</dd>
                <dt class="font-medium">Database</dt>
                <dd class="font-mono text-sm">{{ config('database.default') }}</dd>
            </dl>

            <ul class="mt-8 space-y-2">
                <li><a class="text-blue-600 underline dark:text-blue-400" href="https://laravel.com/docs">Laravel documentation</a></li>
                <li><a class="text-blue-600 underline dark:text-blue-400" href="https://cosmoner.com/docs/guides/deploy-an-app">Deploying apps on Cosmoner</a></li>
            </ul>
        </main>
    </body>
</html>
