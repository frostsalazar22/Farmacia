<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    <!-- ✅ Cabeçalho Topo -->
    <nav class="bg-white dark:bg-gray-800 shadow p-4 flex justify-between items-center">
        <div class="text-lg font-semibold text-gray-800 dark:text-white">
            {{ config('app.name', 'Sistema de Remédios') }}
        </div>

        @auth
            <div class="flex items-center space-x-4">
                <span class="text-gray-700 dark:text-gray-300">
                    Bem-vindo, <strong>{{ Auth::user()->name }}</strong>
                </span>

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('funcionarios.create') }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-1 px-3 rounded">
                        Gerenciar Funcionários
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-4 rounded">
                        Logout
                    </button>
                </form>
            </div>
        @endauth
    </nav>

    <!-- Corpo da Página -->
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
