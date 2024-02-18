<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Yummy Tummy') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="bg-white">
        <div class="font-sans text-gray-900 antialiased ">
            {{ $slot }}
        </div>

        @livewireScripts

        <style>
                        .navbar {
                position: relative;
                width: 90%;
                margin:auto;
                background: #F3F4F6;
                padding: 10px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .navbar-logo {
                font-size: 24px;
                font-weight: bold;
                color: #333;
                margin: auto;
                width:50%;
                display: flex;
            }
            *{
                background-color: white;
            }
        </style>
    </body>
</html>