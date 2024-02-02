<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app" style='min-height:100vh' class='d-flex flex-column'>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            @include('partials.navbar')
        </nav>

        <main class="py-4 mb-5 flex-grow-1">
            @yield('content')
        </main>
        <footer class="footer bg-secondary text-light p-1 mt-3">
            @include('partials.footer')
        </footer>
    </div>
</body>

</html>
