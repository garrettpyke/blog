<!doctype html>

<head>
    <title>My Blog</title>
    <link rel="stylesheet" href="/app.css">
</head>

<body>
    <header>
        @yield('banner')
    </header>

    @yield('content') <!-- refers back to layout.blade.php template (more Blade) -->
</body>         