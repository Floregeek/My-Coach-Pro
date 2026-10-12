<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'My Coach Pro') }} - Client</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-50">
<div x-data="{ sidebarOpen: false, sidebarCollapsed: false }" 
     x-on:toggle-collapse.window="sidebarCollapsed = !sidebarCollapsed"
     class="min-h-screen">

    <div x-show="sidebarOpen" x-transition.opacity
         class="fixed inset-0 z-40 bg-black/40 lg:hidden"
         @click="sidebarOpen=false"></div>

    <aside x-show="sidebarOpen"
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="-translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="-translate-x-full"
           class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 lg:hidden overflow-y-auto">
        <div class="flex items-center justify-between h-16 px-4 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <div class="h-9 w-9 rounded-xl bg-emerald-600/20 flex items-center justify-center">
                    <svg class="h-5 w-5 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <circle cx="12" cy="7" r="4" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 11v9l4-2 4 2v-9" />
                    </svg>
                </div>
                <span class="text-white text-lg font-bold">Espace Client</span>
            </div>
            <button @click="sidebarOpen=false" class="text-white/80 hover:text-white" aria-label="Fermer le menu">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6l-12 12" />
                </svg>
            </button>
        </div>
        @include('layouts.partials.client-sidebar', ['closeOnClick' => true])
    </aside>

    <div class="flex">
        <aside class="hidden lg:block lg:shrink-0 transition-all duration-300 ease-in-out"
               :class="sidebarCollapsed ? 'w-20' : 'w-72'">
            <div class="h-screen sticky top-0 bg-slate-900 border-r border-slate-800 flex flex-col overflow-hidden">
                
                <div class="flex items-center h-16 px-4 border-b border-slate-800 shrink-0"
                     :class="sidebarCollapsed ? 'justify-center' : ''">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="h-9 w-9 rounded-xl bg-emerald-600/20 flex items-center justify-center shrink-0">
                            <svg class="h-5 w-5 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <circle cx="12" cy="7" r="4" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 11v9l4-2 4 2v-9" />
                            </svg>
                        </div>
                        <span x-show="!sidebarCollapsed" 
                              x-transition:enter="transition opacity duration-150"
                              x-transition:leave="duration-0" 
                              class="text-white text-lg font-bold truncate">Espace Client</span>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto overflow-x-hidden">
                    @include('layouts.partials.client-sidebar', ['closeOnClick' => false])
                </div>

                <div class="mt-auto p-4 border-t border-slate-800 shrink-0">
                    <div class="flex items-center" :class="sidebarCollapsed ? 'justify-center' : 'gap-3'">
                        <div class="h-10 w-10 rounded-full bg-slate-700 shrink-0 flex items-center justify-center text-white font-bold border border-slate-600">
                            {{ substr(Auth::user()->name ?? 'C', 0, 1) }}
                        </div>
                        <div x-show="!sidebarCollapsed" x-transition:leave="duration-0" class="truncate min-w-0">
                            <div class="text-white font-semibold leading-5 truncate">{{ Auth::user()->name ?? 'Client' }}</div>
                            <div class="text-slate-400 text-sm">Membre</div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 min-w-0 flex flex-col">
            <header class="h-16 bg-white/80 backdrop-blur border-b border-slate-200 sticky top-0 z-30">
                <div class="h-full px-4 sm:px-6 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <button class="lg:hidden p-2 rounded-lg hover:bg-slate-100" @click="sidebarOpen=true" aria-label="Ouvrir le menu">
                            <svg class="h-5 w-5 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        
                        <button class="hidden lg:flex p-2 rounded-lg hover:bg-slate-100 text-slate-500 transition-colors"
                                @click="$dispatch('toggle-collapse')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="9" y1="3" x2="9" y2="21"></line>
                            </svg>
                        </button>

                        <div class="hidden sm:flex items-center gap-2 text-slate-500 text-sm">
                            <span>Espace Client</span>
                            <span class="text-slate-300">/</span>
                            <span class="text-slate-900 font-semibold">{{ $pageTitle ?? 'Dashboard' }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="px-4 sm:px-6 lg:px-8 py-6">
                <div class="max-w-7xl mx-auto w-full">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</div>
</body>
</html>
