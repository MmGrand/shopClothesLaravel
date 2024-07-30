<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name', 'Laravel'))</title>

        @vite('resources/css/app.css')
        @stack('css')
    </head>
    <body>
        <main>
            @yield('content')
        </main>
        @stack('js')
    </body>
</html>
