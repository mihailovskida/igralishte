<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Laravel')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <!-- Century for titles -->
    <link href="https://fonts.googleapis.com/css2?family=Century&display=swap" rel="stylesheet">
    <!-- Cormorant Infant for small titles -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Infant&display=swap" rel="stylesheet">
    <!-- Cormorant Garamont for body text -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&display=swap" rel="stylesheet">

    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    @auth
                        <div class="p-5 min-vh-100">
                            @yield('content')
                        </div>
                    @endauth
                </div>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://kit.fontawesome.com/3b2a155ba0.js" crossorigin="anonymous"></script>
</body>
</html>
