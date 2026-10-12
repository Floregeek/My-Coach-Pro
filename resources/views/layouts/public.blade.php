<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'My Coach Pro' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-slate-50 text-slate-900">
    <header class="bg-white border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-2 font-bold text-lg">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 text-white">AW</span>
                <span>My Coach Pro</span>
            </a>
            <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                <a href="{{ route('prospect.index') }}" class="hover:text-indigo-600">Coachs</a>
                <a href="{{ route('prospect.contact') }}" class="hover:text-indigo-600">Contact</a>
                <a href="{{ route('login') }}" class="hover:text-indigo-600">Connexion</a>
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-bold">Inscription</a>
            </nav>
            <div class="md:hidden text-sm font-semibold">
                <a href="{{ route('prospect.index') }}" class="text-indigo-600">Coachs</a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-12">
        {{ $slot }}
    </main>

    <footer class="border-t border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-sm text-slate-500 flex flex-col md:flex-row items-center justify-between gap-3">
            <span>My Coach Pro 2026</span>
            <div class="flex items-center gap-4">
                <a href="{{ route('prospect.index') }}" class="hover:text-indigo-600">Coachs</a>
                <a href="{{ route('prospect.contact') }}" class="hover:text-indigo-600">Contact</a>
            </div>
        </div>
    </footer>
</body>
</html>
