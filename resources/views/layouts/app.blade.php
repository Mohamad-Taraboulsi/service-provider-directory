<?php

declare(strict_types=1);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Service Directory')</title>
    <style>
        .header-gradient {
            background: linear-gradient(105deg, #07296a, #081028 85%);
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-50 text-gray-900">

    <header class="header-gradient text-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-6 flex items-center space-x-6">
            <a href="{{ route('providers.index') }}" class="flex items-center space-x-3">
                <img src="https://www.designrush.com/topbest/images/svg/designrush-white-logo.svg" alt="Logo"
                    class="object-fill">
            </a>
        </div>
    </header>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-10 py-4 text-center text-sm text-gray-500">
        &copy; {{ now()->year }} Service Directory. All rights reserved.
    </footer>

</body>

</html>
<?php 
