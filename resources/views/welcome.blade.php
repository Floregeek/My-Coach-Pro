<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Archiweb - Plateforme de Coaching Sportif</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
        <style>
            @keyframes soft-bounce {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-12px); }
            }
            .animate-soft-bounce {
                animation: soft-bounce 2s ease-in-out infinite;
            }
            html { scroll-behavior: smooth; }
        </style>
    </head>
    <body class="antialiased font-sans bg-white text-slate-900 leading-normal">
        
        <nav class="flex items-center justify-between px-8 py-4 bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100">
            <div class="flex items-center gap-2">
                <div class="bg-indigo-600 p-2 rounded-lg text-white font-bold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <span class="text-xl font-bold tracking-tight">Archiweb</span>
            </div>
            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                <a href="#features" class="hover:text-indigo-600 transition">Fonctionnalités</a>
                <a href="{{ route('prospect.index') }}" class="hover:text-indigo-600 transition">Coachs</a>
                <a href="{{ route('prospect.contact') }}" class="hover:text-indigo-600 transition">Contact</a>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-indigo-600 transition">Connexion</a>
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">S'inscrire</a>
            </div>
        </nav>

        <header class="relative min-h-[80vh] flex items-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1540497077202-7c8a3999166f?q=80&w=2070&auto=format&fit=crop" 
                     class="w-full h-full object-cover" alt="Gym Background">
                <div class="absolute inset-0 bg-gradient-to-r from-white via-white/80 to-transparent"></div>
            </div>

            <div class="max-w-7xl mx-auto px-8 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center w-full">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 mb-6">
                        <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest italic tracking-tighter">Nouvelle version 2026 disponible</span>
                    </div>
                    <h1 class="text-7xl font-extrabold leading-tight mb-6 tracking-tight text-slate-900">
                        Le futur du <br>
                        <span class="text-indigo-600 italic">Coaching Sportif</span>
                    </h1>
                    <p class="text-xl text-slate-800 mb-8 leading-relaxed max-w-md font-semibold">
                        Centralisez votre activité, optimisez vos programmes et fidélisez vos clients avec la plateforme tout-en-un conçue pour l'excellence.
                    </p>
                    <div class="flex items-center gap-4 mb-10">
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-8 py-4 rounded-2xl font-bold shadow-2xl shadow-indigo-300 hover:bg-indigo-700 transition flex items-center gap-2 group">
                            Commencer maintenant
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                        <a href="{{ route('prospect.index') }}" class="bg-white/90 backdrop-blur-sm border border-slate-200 px-8 py-4 rounded-2xl font-bold hover:bg-white transition shadow-sm">
                            Voir les coachs
                        </a>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="bg-white/10 backdrop-blur-md rounded-[3rem] shadow-2xl border border-white/40 overflow-hidden aspect-video flex items-center justify-center relative group">
                        <img src="https://images.unsplash.com/photo-1593079831268-3381b0db4a77?q=80&w=2069&auto=format&fit=crop" 
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-slate-900/30"></div> 
                        <p class="relative z-10 text-white font-bold italic text-3xl uppercase tracking-tighter drop-shadow-2xl">App Dashboard Preview</p>
                    </div>

                    <div class="absolute -left-12 bottom-12 bg-white p-5 rounded-3xl shadow-2xl border border-slate-50 flex items-center gap-4 animate-soft-bounce">
                        <div class="bg-emerald-100 p-3 rounded-2xl text-emerald-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs uppercase font-bold text-slate-400 leading-none mb-1 tracking-widest">Progression Client</p>
                            <p class="text-2xl font-black text-slate-900">+24%</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section id="features" class="py-32 bg-slate-50 relative z-20 border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-8">
                <div class="text-center mb-20">
                    <h2 class="text-5xl font-extrabold tracking-tight mb-4 uppercase italic">Tout ce dont vous avez besoin</h2>
                    <p class="text-slate-500 text-xl font-medium max-w-2xl mx-auto">Une suite d'outils complète pour gérer chaque aspect de votre business.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-white">
                    <div class="relative p-8 min-h-[320px] rounded-[2.5rem] overflow-hidden shadow-xl hover:shadow-2xl transition-all group">
                        <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=600&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-indigo-900/70 group-hover:bg-indigo-900/60 transition"></div>
                        <div class="relative z-10 h-full flex flex-col justify-end">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold mb-3">CRM Clients</h3>
                            <p class="text-indigo-100 text-sm leading-relaxed font-medium">Gérez vos profils athlètes et objectifs dans une interface unifiée.</p>
                        </div>
                    </div>

                    <div class="relative p-8 min-h-[320px] rounded-[2.5rem] overflow-hidden shadow-xl hover:shadow-2xl transition-all group">
                        <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=600&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-purple-900/70 group-hover:bg-purple-900/60 transition"></div>
                        <div class="relative z-10 h-full flex flex-col justify-end">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold mb-3">Program builder</h3>
                            <p class="text-purple-100 text-sm leading-relaxed font-medium">Créez des plans d'entraînement avec notre bibliothèque d'exercices.</p>
                        </div>
                    </div>

                    <div class="relative p-8 min-h-[320px] rounded-[2.5rem] overflow-hidden shadow-xl hover:shadow-2xl transition-all group">
                        <img src="https://images.unsplash.com/photo-1594882645126-14020914d58d?q=80&w=600&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-amber-900/70 group-hover:bg-amber-900/60 transition"></div>
                        <div class="relative z-10 h-full flex flex-col justify-end">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold mb-3 font-italic">Suivi Performance</h3>
                            <p class="text-amber-100 text-sm leading-relaxed font-medium">Connectez les montres connectées pour un suivi en temps réel.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-white py-16 border-t border-slate-100 relative z-20">
            <div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-2">
                    <div class="bg-indigo-600 p-2 rounded-lg text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-900 italic">Archiweb</span>
                </div>
                <p class="text-slate-400 text-sm font-medium italic">© 2026 Archiweb Sport Solutions. Tous droits réservés.</p>
                <div class="flex gap-8 text-sm font-bold text-slate-400 italic">
                    <a href="#" class="hover:text-indigo-600 transition">Légal</a>
                    <a href="#" class="hover:text-indigo-600 transition">Confidentialité</a>
                    <a href="#" class="hover:text-indigo-600 transition">Contact</a>
                </div>
            </div>
        </footer>

    </body>
</html>
