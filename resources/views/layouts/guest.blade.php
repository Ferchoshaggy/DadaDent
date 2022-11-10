<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    style="background-image: url(./img/fondo.png); background-size: 50rem;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>DadaDent</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        <link rel="icon" type="image/jpg" href="{{url('favicon.ico')}}"/>
    </head>
    <body class="font-sans antialiased" style="background-color: rgba(0, 0, 0, 0);">
        {{ $slot }}
    </body>
</html>
