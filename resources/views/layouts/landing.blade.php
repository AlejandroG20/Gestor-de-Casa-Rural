<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/landing_styles.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/icons/favicon.ico') }}">

    @yield('styles')

    <title>
        @yield('title')
    </title>

</head>

<body>
    <!-- Navbar -->
    @include('layouts.partials.menu')

    <!-- Body -->
    @yield('content')

    <!-- Footer -->
    @include('layouts.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>

</html>
