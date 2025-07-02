<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido a ClassCraft') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center mb-8">
                        <h3 class="title-font text-xl font-bold text-black-600 mb-2 floating-animation">Selecciona tu clase de personaje</h3>
                        <p class="text-black-600 text-lg">Cada clase tiene habilidades y características únicas</p>
                    </div>

                    <div class="flex flex-wrap justify-center gap-8 md:flex-nowrap">
                        <!-- Guerreros -->
                        <div onclick="window.location.href='{{ route('personaje.guerreros') }}'"
                             class="role-card warrior-card group cursor-pointer bg-gradient-to-b from-amber-50 to-amber-100 border-2 border-amber-200 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 hover:border-amber-300 w-full md:w-1/3 max-w-sm relative overflow-hidden">
                            <!-- Particles -->
                            <div class="particle" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
                            <div class="particle" style="top: 60%; right: 15%; animation-delay: 1s;"></div>
                            <div class="particle" style="bottom: 30%; left: 20%; animation-delay: 2s;"></div>
                            
                            <div class="p-6 text-center relative z-10">
                                <div class="mb-4 h-32 bg-amber-200 rounded-lg flex items-center justify-center group-hover:bg-amber-300 transition-colors duration-300">
                                    <img src="/images/image.png" alt="Guerrero" class="h-24 character-icon">
                                </div>
                                <h4 class="text-xl font-bold text-amber-800 mb-4 text-center w-full">Guerreros</h4>
                                <div class="space-y-1 text-sm text-center">
                                    <div class="flex justify-center gap-4">
                                        <span class="text-red-600 font-semibold px-3 py-1 bg-white/80 rounded-full shadow-sm stat-badge">80 HP</span>
                                        <span class="font-semibold pp-azul px-3 py-1 bg-white/80 rounded-full shadow-sm stat-badge">30 PP</span>
                                    </div>
                                </div>
                                <div class="mt-4 selection-hint">
                                    <span class="text-amber-700 font-medium">⚔️ Hacer clic para seleccionar →</span>
                                </div>
                            </div>
                        </div>

                        <!-- Magos -->
                        <div onclick="window.location.href='{{ route('personaje.magos') }}'"
                             class="role-card mage-card group cursor-pointer bg-gradient-to-b from-purple-50 to-purple-100 border-2 border-purple-200 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 hover:border-purple-300 w-full md:w-1/3 max-w-sm relative overflow-hidden">
                            <!-- Particles -->
                            <div class="particle" style="top: 25%; right: 10%; animation-delay: 0.5s; background: #a855f7;"></div>
                            <div class="particle" style="top: 70%; left: 15%; animation-delay: 1.5s; background: #a855f7;"></div>
                            <div class="particle" style="bottom: 20%; right: 20%; animation-delay: 2.5s; background: #a855f7;"></div>
                            
                            <div class="p-6 text-center relative z-10">
                                <div class="mb-4 h-32 bg-purple-200 rounded-lg flex items-center justify-center group-hover:bg-purple-300 transition-colors duration-300">
                                    <img src="/images/personajes.png" alt="Mago" class="h-32 character-icon">
                                </div>
                                <h4 class="text-xl font-bold text-purple-800 mb-4 text-center w-full">Magos</h4>
                                <div class="space-y-1 text-sm text-center">
                                    <div class="flex justify-center gap-4">
                                        <span class="text-red-600 font-semibold px-3 py-1 bg-white/80 rounded-full shadow-sm stat-badge">30 HP</span>
                                        <span class="font-semibold pp-azul px-3 py-1 bg-white/80 rounded-full shadow-sm stat-badge">50 PP</span>
                                    </div>
                                </div>
                                <div class="mt-4 selection-hint">
                                    <span class="text-purple-700 font-medium">🔮 Hacer clic para seleccionar →</span>
                                </div>
                            </div>
                        </div>

                        <!-- Sanadores -->
                        <div onclick="window.location.href='{{ route('personaje.sanadores') }}'"
                             class="role-card healer-card group cursor-pointer bg-gradient-to-b from-green-50 to-green-100 border-2 border-green-200 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 hover:border-green-300 w-full md:w-1/3 max-w-sm relative overflow-hidden">
                            <!-- Particles -->
                            <div class="particle" style="top: 15%; left: 25%; animation-delay: 1s; background: #10b981;"></div>
                            <div class="particle" style="top: 50%; right: 10%; animation-delay: 2s; background: #10b981;"></div>
                            <div class="particle" style="bottom: 35%; left: 15%; animation-delay: 3s; background: #10b981;"></div>
                            
                            <div class="p-6 text-center relative z-10">
                                <div class="mb-4 h-32 bg-green-200 rounded-lg flex items-center justify-center group-hover:bg-green-300 transition-colors duration-300">
                                    <img src="/images/sanadores.png" alt="Sanador" class="h-32 character-icon">
                                </div>
                                <h4 class="text-xl font-bold text-green-800 mb-4 text-center w-full">Sanadores</h4>
                                <div class="space-y-1 text-sm text-center">
                                    <div class="flex justify-center gap-4">
                                        <span class="text-red-600 font-semibold px-3 py-1 bg-white/80 rounded-full shadow-sm stat-badge">50 HP</span>
                                        <span class="font-semibold pp-azul px-3 py-1 bg-white/80 rounded-full shadow-sm stat-badge">35 PP</span>
                                    </div>
                                </div>
                                <div class="mt-4 selection-hint">
                                    <span class="text-green-700 font-medium">✨ Hacer clic para seleccionar →</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 text-center">
                        <p class="text-black-600 text-xl text-sm">
                            Tu elección determinará tus habilidades y estilo de juego
                        </p>
                        <p class="mt-12 text-red-600 text-2xl text-sm warning-text">
                            Una vez forjado tu camino, no habrá retorno
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap');
        
        .title-font {
            font-family: 'Cinzel', serif;
        }

        .pp-azul {
            color: #2563eb !important; 
        }

        .role-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .role-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
            z-index: 1;
        }

        .role-card:hover::before {
            left: 100%;
        }

        .role-card:hover {
            transform: translateY(-8px) scale(1.03);
            animation: float 2s ease-in-out infinite;
        }

        .warrior-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15), 
                        0 0 20px rgba(251, 191, 36, 0.3);
        }

        .mage-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15), 
                        0 0 20px rgba(168, 85, 247, 0.3);
        }

        .healer-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15), 
                        0 0 20px rgba(16, 185, 129, 0.3);
        }

        .stat-badge {
            transition: all 0.3s ease;
        }

        .role-card:hover .stat-badge {
            background: rgba(255, 255, 255, 1);
            transform: scale(1.05);
        }

        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        .character-icon {
            transition: all 0.4s ease;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }

        .role-card:hover .character-icon {
            transform: scale(1.1) rotate(5deg);
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.3));
        }

        .selection-hint {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .role-card:hover .selection-hint {
            opacity: 1;
            transform: translateY(0);
        }

        .warning-text {
            background: linear-gradient(45deg, #ef4444, #dc2626);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #D4AF37;
            border-radius: 50%;
            animation: particle-float 4s infinite ease-in-out;
            z-index: 2;
        }

        @keyframes particle-float {
            0%, 100% { transform: translateY(0px) translateX(0px); opacity: 0; }
            50% { transform: translateY(-20px) translateX(10px); opacity: 1; }
        }
    </style>
</x-app-layout>