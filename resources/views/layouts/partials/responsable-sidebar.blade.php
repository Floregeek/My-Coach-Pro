<nav class="flex-1 px-2 py-4 text-sm overflow-x-hidden">
    <div class="px-3 pt-2 pb-1 text-xs font-bold tracking-widest text-slate-500 uppercase"
         x-show="!sidebarCollapsed" x-transition.opacity>
        Responsable
    </div>

    <a href="{{ route('responsable.dashboard') }}"
       class="{{ request()->routeIs('responsable.dashboard') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 11.5l9-7 9 7M5 10.5V20h14v-9.5" />
        </svg>
        <span x-show="!sidebarCollapsed" class="ml-3 font-medium truncate">Dashboard</span>
    </a>

    <a href="{{ route('responsable.coachs') }}"
       class="{{ request()->routeIs('responsable.coachs') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M22 20v-2a4 4 0 0 0-3-3.87" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 11a4 4 0 1 0-3-7" />
        </svg>
        <span x-show="!sidebarCollapsed" class="ml-3 font-medium truncate">Coachs</span>
    </a>

    <a href="{{ route('responsable.planning') }}"
       class="{{ request()->routeIs('responsable.planning') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2z" />
        </svg>
        <span x-show="!sidebarCollapsed" class="ml-3 font-medium truncate">Planning salle</span>
    </a>

    <a href="{{ route('responsable.occupation') }}"
       class="{{ request()->routeIs('responsable.occupation') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 20h16" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16v4" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 12v8" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 8v12" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 4v16" />
        </svg>
        <span x-show="!sidebarCollapsed" class="ml-3 font-medium truncate">Occupation</span>
    </a>

    <a href="{{ route('responsable.facturation') }}"
       class="{{ request()->routeIs('responsable.facturation') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <rect x="3" y="5" width="18" height="14" rx="2" ry="2" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 15h4" />
        </svg>
        <span x-show="!sidebarCollapsed" class="ml-3 font-medium truncate">Facturation</span>
    </a>

    <a href="{{ route('responsable.contrats.index') }}"
       class="{{ request()->routeIs('responsable.contrats.index') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v5h5" />
        </svg>
        <span x-show="!sidebarCollapsed" class="ml-3 font-medium truncate">Contrats salle</span>
    </a>

    <div class="mt-4 px-3 pt-3 pb-1 text-xs font-bold tracking-widest text-slate-500 uppercase"
         x-show="!sidebarCollapsed" x-transition.opacity>
        Compte
    </div>

    <form method="POST" action="{{ route('logout') }}" class="mt-2">
        @csrf
        <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-xl
                       text-slate-400 hover:text-red-400 hover:bg-slate-800 transition"
                :class="sidebarCollapsed ? 'justify-center' : ''">
            <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 17l5-5-5-5" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H4" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 4h-6a2 2 0 0 0-2 2v3" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v3a2 2 0 0 0 2 2h6" />
            </svg>
            <span x-show="!sidebarCollapsed" x-transition.opacity>Déconnexion</span>
        </button>
    </form>
</nav>
