<nav class="flex-1 px-2 py-4 text-sm overflow-x-hidden">

    {{-- SECTION : TABLEAU DE BORD --}}
    <div class="px-3 pt-2 pb-1 text-xs font-bold tracking-widest text-slate-500 uppercase"
         x-show="!sidebarCollapsed" x-transition.opacity>
        Tableau de bord
    </div>

    <a href="{{ route('dashboard') }}"
       class="{{ request()->routeIs('dashboard') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 11.5l9-7 9 7M5 10.5V20h14v-9.5" />
        </svg>

        <span x-show="!sidebarCollapsed"
              x-transition:enter="transition opacity duration-150"
              x-transition:leave="duration-0"
              class="ml-3 font-medium truncate">
            Tableau de bord
        </span>
    </a>

    {{-- SECTION : ACTIVITÉ --}}
    <div class="mt-4 px-3 pt-3 pb-1 text-xs font-bold tracking-widest text-slate-500 uppercase"
         x-show="!sidebarCollapsed" x-transition.opacity>
        Activité
    </div>

    <a href="{{ route('client.seances.index') }}"
       class="{{ request()->routeIs('client.seances.index') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2z" />
        </svg>

        <span x-show="!sidebarCollapsed"
              x-transition:enter="transition opacity duration-150"
              x-transition:leave="duration-0"
              class="ml-3 font-medium truncate">
            Catalogue des séances
        </span>
    </a>

    <a href="{{ route('client.programmes') }}"
       class="{{ request()->routeIs('client.programmes') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h8M8 10h8M8 14h5M6 4h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z" />
        </svg>

        <span x-show="!sidebarCollapsed"
              x-transition:enter="transition opacity duration-150"
              x-transition:leave="duration-0"
              class="ml-3 font-medium truncate">
            Programmes
        </span>
    </a>

    <a href="{{ route('client.nutrition') }}"
       class="{{ request()->routeIs('client.nutrition') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20c4.418 0 8-3.582 8-8 0-4.5-4.5-8-8-8-4.5 0-8 3.5-8 8 0 4.418 3.582 8 8 8z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c1.5 0 3 1.5 3 3s-1.5 3-3 3-3-1.5-3-3" />
        </svg>

        <span x-show="!sidebarCollapsed"
              x-transition:enter="transition opacity duration-150"
              x-transition:leave="duration-0"
              class="ml-3 font-medium truncate">
            Nutrition
        </span>
    </a>

    <a href="{{ route('client.contrats') }}"
       class="{{ request()->routeIs('client.contrats') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v5h5" />
        </svg>

        <span x-show="!sidebarCollapsed"
              x-transition:enter="transition opacity duration-150"
              x-transition:leave="duration-0"
              class="ml-3 font-medium truncate">
            Contrats
        </span>
    </a>

    {{-- SECTION : SUIVI & PROGRESSION --}}
    <div class="mt-4 px-3 pt-3 pb-1 text-xs font-bold tracking-widest text-slate-500 uppercase"
         x-show="!sidebarCollapsed" x-transition.opacity>
        Suivi & progression
    </div>

    <a href="{{ route('client.performances') }}"
       class="{{ request()->routeIs('client.performances') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 20h16M7 16l4-4 3 3 4-6" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16v4M11 12v8M14 15v5M18 9v11" />
        </svg>

        <span x-show="!sidebarCollapsed"
              x-transition:enter="transition opacity duration-150"
              x-transition:leave="duration-0"
              class="ml-3 font-medium truncate">
            Mes performances
        </span>
    </a>

    <a href="{{ route('client.my-profile') }}"
       class="{{ request()->routeIs('client.my-profile') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-7-4.5-7-9a4 4 0 0 1 7-2 4 4 0 0 1 7 2c0 4.5-7 9-7 9z" />
        </svg>

        <span x-show="!sidebarCollapsed"
              x-transition:enter="transition opacity duration-150"
              x-transition:leave="duration-0"
              class="ml-3 font-medium truncate">
            Mon suivi santé
        </span>
    </a>
       {{-- SECTION : COMMERCE --}}
    <div class="mt-4 px-3 pt-3 pb-1 text-xs font-bold tracking-widest text-slate-500 uppercase"
         x-show="!sidebarCollapsed" x-transition.opacity>
        Commerce
    </div>

    <a href="{{ route('boutique.index') }}"
       class="{{ request()->routeIs('boutique.index') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h2l2.5 11h9L19 8H7" />
            <circle cx="9" cy="20" r="1.5" />
            <circle cx="17" cy="20" r="1.5" />
        </svg>

        <span x-show="!sidebarCollapsed"
              x-transition:enter="transition opacity duration-150"
              x-transition:leave="duration-0"
              class="ml-3 font-medium truncate">
            Boutique
        </span>
    </a>
    {{-- SECTION : COMMUNICATION --}}
    <div class="mt-4 px-3 pt-3 pb-1 text-xs font-bold tracking-widest text-slate-500 uppercase"
         x-show="!sidebarCollapsed" x-transition.opacity>
        Communication
    </div>

    <a href="{{ route('messages.index') }}"
       class="{{ request()->routeIs('messages.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}
              flex items-center p-2 rounded-xl transition-all duration-200 group relative"
       :class="sidebarCollapsed ? 'justify-center' : 'px-3'">
        <svg class="h-5 w-5 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a8 8 0 0 1-8 8H7l-4 3 1.5-5A8 8 0 1 1 21 12z" />
        </svg>

        <span x-show="!sidebarCollapsed"
              x-transition:enter="transition opacity duration-150"
              x-transition:leave="duration-0"
              class="ml-3 font-medium truncate">
            Messagerie
        </span>

        {{-- L'AJOUT DU BADGE EST ICI --}}
        <span id="badge-global">
            @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                <span class="absolute top-1 right-2 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white shadow-sm border-2 border-slate-900 animate-pulse">
                    {{ $unreadMessagesCount }}
                </span>
            @endif
        </span>
    </a>

    {{-- SECTION : COMPTE --}}
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
