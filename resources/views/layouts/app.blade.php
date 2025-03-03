<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Студия маникюра</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    @include('parts.menu')
    <div class="container mt-4">
        @yield('content')
    </div>

</body>

</html>