<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    @stack('css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    @include('includes.user.header')
    <main>
        <div class="container">
            @isset($breadcrumbs)
                <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
            @endisset
            <aside class="row">
                <div class="col-md-3">
                    @include('layouts.partials.categories')
                    @include('layouts.partials.brands')
                </div>
                <div class="col-md-9">
                    <x-alerts />
                    <x-errors />
                    @yield('content')
                </div>
            </aside>
        </div>
    </main>
    @include('includes.user.footer')
    @vite('resources/js/app.js')
    @vite('resources/js/site.js')
    @stack('js')
</body>

</html>
