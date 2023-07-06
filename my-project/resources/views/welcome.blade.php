<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css'])
        <title>Books Vue App test</title>

    </head>
    <body class="antialiased">
        <div id="app"></div>
        @vite('resources/js/app.js')
    </body>
</html>
