<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name', 'Laravel'))</title>

        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
        @stack('css')
    </head>
    <body>
        @include('includes.header')
        <main>
            <div class="container">
                <aside class="row">
                    <div class="col-md-3">
                        <h4>Разделы каталога</h4>
                        <p>Здесь будут корневые разделы</p>
                        <h4>Популярные бренды</h4>
                        <p>Здесь будут популярные бренды</p>
                    </div>
                    <div class="col-md-9">
                        @yield('content')
                    </div>
                </aside>
            </div>
        </main>
        @include('includes.footer')
        @vite('resources/js/app.js')
        @stack('js')
    </body>
</html>
