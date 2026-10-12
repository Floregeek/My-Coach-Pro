<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'My Coach Pro') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
<div x-data="{ sidebarOpen: false, sidebarCollapsed: false }"
     x-on:toggle-sidebar.window="sidebarOpen = !sidebarOpen"
     x-on:toggle-collapse.window="sidebarCollapsed = !sidebarCollapsed"
     class="flex h-screen overflow-hidden">

    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-black/40 md:hidden" @click="sidebarOpen = false"></div>

    <aside x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
           class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 md:hidden overflow-y-auto">
        <div class="flex items-center justify-between h-16 px-4 border-b border-slate-800">
            <span class="text-white text-xl font-bold italic">My Coach Pro</span>
            <button @click="sidebarOpen = false" class="text-white/80 hover:text-white" aria-label="Fermer le menu">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6l-12 12" />
                </svg>
            </button>
        </div>
        <nav class="px-2 py-4 space-y-1">
            @if(Auth::user()->role === 'coach')
                <a href="{{ route('coach.programmes.index') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">
                    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h8M8 10h8M8 14h5M6 4h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z" />
                    </svg>
                    <span>Programmes</span>
                </a>
                <a href="{{ route('coach.nutrition.index') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">
                    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20c4.418 0 8-3.582 8-8 0-4.5-4.5-8-8-8-4.5 0-8 3.5-8 8 0 4.418 3.582 8 8 8z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c1.5 0 3 1.5 3 3s-1.5 3-3 3-3-1.5-3-3" />
                    </svg>
                    <span>Nutrition</span>
                </a>
                <a href="{{ route('coach.offres.index') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">
                    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4.586a2 2 0 0 0 .586 1.414l7.414 7.414a2 2 0 0 0 2.828 0l6.586-6.586a2 2 0 0 0 0-2.828L13.828 3.586A2 2 0 0 0 12.414 3H7a4 4 0 0 0-4 4z" />
                    </svg>
                    <span>Offres</span>
                </a>
                <a href="{{ route('coach.contrats.index') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">
                    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v5h5" />
                    </svg>
                    <span>Contrats</span>
                </a>
                <a href="{{ route('coach.facturation.index') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">
                    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <rect x="3" y="5" width="18" height="14" rx="2" ry="2" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 15h4" />
                    </svg>
                    <span>Facturation</span>
                </a>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">
                    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 11.5l9-7 9 7M5 10.5V20h14v-9.5" />
                    </svg>
                    <span>Tableau de bord</span>
                </a>
                <a href="{{ route('messages.index') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">
                    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a8 8 0 0 1-8 8H7l-4 3 1.5-5A8 8 0 1 1 21 12z" />
                    </svg>
                    <span>Messagerie</span>
                </a>
                <a href="{{ route('coach.partenariats.index') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">
                    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 13a5 5 0 0 0 7.07 0l2.83-2.83a5 5 0 0 0-7.07-7.07L10 5" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 11a5 5 0 0 0-7.07 0L4.1 13.83a5 5 0 0 0 7.07 7.07L14 19" />
                    </svg>
                    <span>Partenariats</span>
                </a>
            @elseif(Auth::user()->role === 'responsable')
                <a href="{{ route('responsable.dashboard') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">Dashboard</a>
                <a href="{{ route('responsable.coachs') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">Coachs</a>
                <a href="{{ route('responsable.planning') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">Planning</a>
                    <a href="{{ route('responsable.occupation') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">Occupation</a>
                    <a href="{{ route('responsable.facturation') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">Facturation</a>
                    <a href="{{ route('responsable.contrats.index') }}" class="flex items-center gap-3 px-3 py-2 text-slate-300 rounded-md">Contrats salle</a>
            @else
                @include('layouts.partials.client-sidebar')
            @endif
        </nav>
    </aside>

    <aside class="hidden md:flex md:flex-shrink-0 h-full">
        <div :class="sidebarCollapsed ? 'w-20' : 'w-64'" class="flex flex-col bg-slate-900 transition-all duration-300 ease-in-out border-r border-slate-800">
            <div class="flex items-center h-16 px-4 border-b border-slate-800 justify-center">
                <span x-show="!sidebarCollapsed" class="text-white text-xl font-bold italic truncate">My Coach Pro</span>
                <span x-show="sidebarCollapsed" class="text-white text-xl font-bold italic">AW</span>
            </div>

            <nav class="flex-1 px-3 py-4 space-y-2 overflow-y-auto overflow-x-hidden">
                @if(Auth::user()->role === 'coach')
                    <a href="{{ route('dashboard') }}" class="flex items-center p-2 rounded-xl text-slate-300 hover:bg-slate-700" :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 11.5l9-7 9 7M5 10.5V20h14v-9.5" />
                        </svg>
                        <span x-show="!sidebarCollapsed" class="ml-3 font-medium">Tableau de bord</span>
                    </a>
                    <a href="{{ url('coach/clients') }}" class="flex items-center p-2 rounded-xl text-slate-300 hover:bg-slate-700" :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M22 20v-2a4 4 0 0 0-3-3.87" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 11a4 4 0 1 0-3-7" />
                        </svg>
                        <span x-show="!sidebarCollapsed" class="ml-3 font-medium">Mes Clients</span>
                    </a>
                    <a href="{{ route('coach.programmes.index') }}" class="flex items-center p-2 rounded-xl text-slate-300 hover:bg-slate-700" :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h8M8 10h8M8 14h5M6 4h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z" />
                        </svg>
                        <span x-show="!sidebarCollapsed" class="ml-3 font-medium">Programmes</span>
                    </a>
                    <a href="{{ route('coach.nutrition.index') }}" class="flex items-center p-2 rounded-xl text-slate-300 hover:bg-slate-700" :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20c4.418 0 8-3.582 8-8 0-4.5-4.5-8-8-8-4.5 0-8 3.5-8 8 0 4.418 3.582 8 8 8z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c1.5 0 3 1.5 3 3s-1.5 3-3 3-3-1.5-3-3" />
                        </svg>
                        <span x-show="!sidebarCollapsed" class="ml-3 font-medium">Nutrition</span>
                    </a>
                    <a href="{{ route('coach.offres.index') }}" class="flex items-center p-2 rounded-xl text-slate-300 hover:bg-slate-700" :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4.586a2 2 0 0 0 .586 1.414l7.414 7.414a2 2 0 0 0 2.828 0l6.586-6.586a2 2 0 0 0 0-2.828L13.828 3.586A2 2 0 0 0 12.414 3H7a4 4 0 0 0-4 4z" />
                        </svg>
                        <span x-show="!sidebarCollapsed" class="ml-3 font-medium">Offres</span>
                    </a>
                    <a href="{{ route('coach.contrats.index') }}" class="flex items-center p-2 rounded-xl text-slate-300 hover:bg-slate-700" :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v5h5" />
                        </svg>
                        <span x-show="!sidebarCollapsed" class="ml-3 font-medium">Contrats</span>
                    </a>
                    <a href="{{ route('coach.facturation.index') }}" class="flex items-center p-2 rounded-xl text-slate-300 hover:bg-slate-700" :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="14" rx="2" ry="2" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 15h4" />
                        </svg>
                        <span x-show="!sidebarCollapsed" class="ml-3 font-medium">Facturation</span>
                    </a>
                    <a href="{{ route('messages.index') }}" class="flex items-center p-2 rounded-xl text-slate-300 hover:bg-slate-700" :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a8 8 0 0 1-8 8H7l-4 3 1.5-5A8 8 0 1 1 21 12z" />
                        </svg>
                        <span x-show="!sidebarCollapsed" class="ml-3 font-medium">Messagerie</span>
                    </a>
                    <a href="{{ route('coach.partenariats.index') }}" class="flex items-center p-2 rounded-xl text-slate-300 hover:bg-slate-700" :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 13a5 5 0 0 0 7.07 0l2.83-2.83a5 5 0 0 0-7.07-7.07L10 5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 11a5 5 0 0 0-7.07 0L4.1 13.83a5 5 0 0 0 7.07 7.07L14 19" />
                        </svg>
                        <span x-show="!sidebarCollapsed" class="ml-3 font-medium">Partenariats</span>
                    </a>
                @elseif(Auth::user()->role === 'responsable')
                    @include('layouts.partials.responsable-sidebar')
                @else
                    @include('layouts.partials.client-sidebar')
                @endif
            </nav>

            <div class="p-4 border-t border-slate-800">
                <button type="button" @click="$dispatch('toggle-collapse')" class="w-full flex items-center text-slate-400 hover:text-white" :class="sidebarCollapsed ? 'justify-center' : ''">
                    <svg x-show="sidebarCollapsed" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6" />
                    </svg>
                    <svg x-show="!sidebarCollapsed" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6" />
                    </svg>
                </button>
            </div>
        </div>
    </aside>

    <div class="flex flex-col w-0 flex-1 overflow-hidden">
        @include('layouts.navigation')
        <main class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="max-w-7xl mx-auto w-full">
                {{ $slot }}
            </div>
        </main>
    </div>
</div>
</body>
</html>
