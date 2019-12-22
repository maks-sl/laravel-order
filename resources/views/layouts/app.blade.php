<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @section('title', config('app.name', 'Laravel'))
    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css', 'hot') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="my-auto">
    <main class="app-content py-3">
        <div class="container">
            @include('layouts.partials.flash')
            @yield('content')
        </div>
    </main>
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js', 'hot') }}"></script>
</body>
</html>
