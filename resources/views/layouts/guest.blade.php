<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <title>{{ config('app.name', 'ArqueoRD') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">
        <!-- FontAwesome para iconos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', sans-serif; }
            .font-serif { font-family: 'Playfair Display', serif; }
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans text-stone-800 antialiased bg-white">
        <div class="min-h-screen">
            <!-- El contenido ocupará todo el espacio disponible sin contenedores pequeños -->
            {{ $slot }}
        </div>
    </body>
</html>
