<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Link Shortener</title>
    <link rel="shortcut icon" type="image/png" sizes="64x64" href="./favicon.png">
    @vite('resources/css/app.css')
</head>

<body class="bg-light">
    <div id="app"></div>
    @vite('resources/js/app.js')
</body>

</html>
