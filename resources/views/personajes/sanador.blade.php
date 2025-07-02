<x-app-layout>
    <x-slot name="header">
        <div class="text-center py-8">
            <h1 class="font-bold text-xl text-white leading-tight title-glow floating"
                style="font-family: 'Cinzel', serif;">
                 SANADORES ⚕️
            </h1>
        </div>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap');

        .hero-bg {
            background: #ffffff;
        }

        .glass-effect {
            background: #ffffff;
            border: 2px solid #e5e7eb;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-hover:hover {
            transform: translateY(-12px) scale(1.02);
        }

        .warrior-card {
            background: linear-gradient(145deg, #f8fafc, #e2e8f0);
            border: 2px solid #d1d5db;
            border-radius: 20px;
            padding: 32px;
            transition: all 0.3s ease;
        }

        .warrior-card.selected {
            background: linear-gradient(145deg, #dbeafe, #bfdbfe);
            border: 3px solid #3b82f6;
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.3);
        }

        .stats-badge {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
        }

        .btn-confirm {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed, #6366f1);
            background-size: 200% 200%;
            animation: shimmer 3s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }

        .btn-confirm::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-confirm:hover::before {
            left: 100%;
        }

        @keyframes shimmer {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }

        .title-glow {
            text-shadow: none;
            color: #374151;
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes sparkle {
            0% {
                opacity: 0;
                transform: scale(0);
            }
            50% {
                opacity: 1;
                transform: scale(1);
            }
            100% {
                opacity: 0;
                transform: scale(0);
            }
        }

        .stat-card {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .stat-card.health {
            border-left: 6px solid #f59e0b; /* Changed to amber for medium health */
            background: linear-gradient(135deg, #fffbeb, #fefce8); /* Changed to amber gradient */
        }

        .stat-card.ap {
            border-left: 6px solid #10b981; /* Green for high AP */
            background: linear-gradient(135deg, #ecfdf5, #f0fdf4);
        }

        .role-card {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            padding: 24px;
            border-left: 6px solid #3b82f6;
            background: linear-gradient(135deg, #eff6ff, #f0f9ff);
        }

        .character-selection-card {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .description-content {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            padding: 32px;
            margin-bottom: 24px;
        }

        .tip-card {
            background: white;
            border: 2px solid #f59e0b;
            border-left: 6px solid #f59e0b;
            border-radius: 12px;
            padding: 20px;
            background: linear-gradient(135deg, #fffbeb, #fefce8);
        }

        body {
            min-height: 100vh;
        }
    </style>

    <div class="hero-bg min-h-screen pb-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
            <form method="POST" action="{{ route('guardar.personaje') }}" id="personaje-form">
                @csrf

                <div class="glass-effect mb-8">
                    <div class="flex flex-col lg:flex-row gap-12 items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-4 mb-8">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center shadow-lg">
                                    <span class="text-2xl"></span>
                                </div>
                                <h2 class="text-3xl font-bold text-gray-800" style="font-family: 'Cinzel', serif;">
                                    ESTADÍSTICAS
                                </h2>
                            </div>

                            <div class="space-y-6">
                                <div class="stat-card health">
                                    <div class="flex items-center gap-4">
                                        <span class="text-4xl">❤️</span>
                                        <div>
                                            <h3 class="font-bold text-xl text-gray-800 mb-1">Salud (HP)</h3>
                                            <p class="text-amber-600 font-semibold text-2xl">MEDIA</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="stat-card ap">
                                    <div class="flex items-center gap-4">
                                        <span class="text-4xl">⚡</span>
                                        <div>
                                            <h3 class="font-bold text-xl text-gray-800 mb-1">AP</h3>
                                            <p class="text-green-600 font-semibold text-2xl">ALTA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="role-card mt-8">
                                <div class="flex items-center gap-4">
                                    <span class="text-3xl">⚕️</span>
                                    <div>
                                        <h3 class="font-bold text-xl text-gray-800 mb-1">Rol</h3>
                                        <p class="text-blue-700 font-semibold text-xl">Restaurador de vida y apoyo directo</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex-shrink-0">
                            <div class="character-selection-card">
                                <h3 class="text-2xl font-bold text-center mb-8 text-gray-800"
                                    style="font-family: 'Cinzel', serif;">
                                    Elige tu Sanador
                                </h3>
                                <div class="flex gap-8 justify-center">
                                    <div class="selectable-card warrior-card cursor-pointer text-center card-hover w-44"
                                        data-value="sanadora" tabindex="0" role="button" aria-pressed="false">
                                        <div class="relative mb-6">
                                            <img src="{{ asset('images/sanadora.png') }}" alt="Sanadora"
                                                class="h-32 w-32 object-contain mx-auto rounded-2xl shadow-lg bg-gradient-to-br from-teal-400 to-green-500 p-4">
                                        </div>
                                        <p class="font-bold text-xl text-gray-800 mb-3">Sanadora</p>
                                        <div
                                            class="text-sm text-gray-600 bg-teal-100 rounded-full px-4 py-2 border border-teal-200">
                                            Compasiva • Resiliente
                                        </div>
                                    </div>

                                    <div class="selectable-card warrior-card cursor-pointer text-center card-hover w-44"
                                        data-value="sanador" tabindex="0" role="button" aria-pressed="false">
                                        <div class="relative mb-6">
                                            <img src="{{ asset('images/sanador.png') }}" alt="Sanador"
                                                class="h-32 w-32 object-contain mx-auto rounded-2xl shadow-lg bg-gradient-to-br from-emerald-400 to-lime-500 p-4">
                                        </div>
                                        <p class="font-bold text-xl text-gray-800 mb-3">Sanador</p>
                                        <div
                                            class="text-sm text-gray-600 bg-emerald-100 rounded-full px-4 py-2 border border-emerald-200">
                                            Gentil • Protector
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="clase_personaje" id="clase_personaje" required>
                                <input type="hidden" name="tipo_clase" value="sanador">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="glass-effect mb-8">
                    <div class="flex items-center gap-4 mb-8">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-purple-400 to-indigo-500 rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-2xl"></span>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800" style="font-family: 'Cinzel', serif;">
                            DESCRIPCIÓN
                        </h2>
                    </div>

                    <div class="description-content">
                        <p class="text-lg text-gray-700 leading-relaxed text-justify mb-6"
                            style="font-family: 'Inter', sans-serif;">
                            El <strong class="text-indigo-600">Sanador</strong> es el corazón del equipo. Su capacidad
                            para recuperar puntos de salud es vital para mantener a todos activos en el juego. Gracias a
                            sus habilidades, puede evitar que los compañeros caigan y hasta resucitarlos si fuera
                            necesario. Además, ofrece beneficios personales y académicos, como descansar o escuchar
                            música. Esta clase es ideal para quienes valoran el cuidado de los demás, son empáticos,
                            atentos y buenos compañeros.
                        </p>

                        <div class="tip-card">
                            <div class="flex items-start gap-3">
                                <span class="text-2xl mt-1">💡</span>
                                <div>
                                    <p class="text-amber-800 font-medium text-lg">
                                        <strong>Ideal para:</strong> Quienes valoran el cuidado de los demás, son empáticos,
                                        atentos y buenos compañeros.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="error-message" class="mb-6 text-red-600 text-center hidden">
                    <div class="glass-effect border-l-4 border-red-500 bg-red-50">
                        <span class="text-xl mr-2">⚠️</span>
                        Por favor, selecciona un personaje antes de confirmar.
                    </div>
                </div>

                @if ($errors->any())
                    <div class="mb-6 text-center">
                        <div class="glass-effect border-l-4 border-red-500 bg-red-50">
                            <ul class="text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-center justify-center gap-2">
                                        <span class="text-xl">⚠️</span>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="text-center">
                    <button type="submit"
                        class="
                        btn-confirm text-white font-bold py-4 px-12 rounded-full text-lg
                        shadow-2xl hover:shadow-3xl
                        transition-all duration-300 ease-in-out transform hover:scale-105
                        focus:outline-none focus:ring-4 focus:ring-purple-300 focus:ring-opacity-75
                        relative z-10">
                        <span class="relative z-10 flex items-center gap-3">
                            <span class="text-2xl"></span>
                            Confirmar elección
                            <span class="text-2xl"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const cards = document.querySelectorAll('.selectable-card');
        const hiddenInput = document.getElementById('clase_personaje');
        const errorMessage = document.getElementById('error-message');
        const form = document.getElementById('personaje-form');

        function selectCard(selectedCard) {
            cards.forEach(card => {
                card.classList.remove('selected');
                card.setAttribute('aria-pressed', 'false');
            });

            selectedCard.classList.add('selected');
            selectedCard.setAttribute('aria-pressed', 'true');

            hiddenInput.value = selectedCard.dataset.value;
            errorMessage.classList.add('hidden');

            selectedCard.style.transform = 'scale(1.05)';
            setTimeout(() => {
                selectedCard.style.transform = '';
            }, 200);
        }

        cards.forEach(card => {
            card.addEventListener('click', () => selectCard(card));
            card.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    selectCard(card);
                }
            });
        });

        form.addEventListener('submit', (e) => {
            if (!hiddenInput.value) {
                e.preventDefault();
                errorMessage.classList.remove('hidden');
                errorMessage.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });

        function createParticle() {
            const particle = document.createElement('div');
            particle.style.cssText = `
                position: fixed;
                width: 4px;
                height: 4px;
                background: rgba(255, 255, 255, 0.6);
                border-radius: 50%;
                pointer-events: none;
                top: ${Math.random() * 100}vh;
                left: ${Math.random() * 100}vw;
                animation: sparkle 4s linear infinite;
                z-index: 1;
            `;
            document.body.appendChild(particle);

            setTimeout(() => particle.remove(), 4000);
        }
    </script>
</x-app-layout>