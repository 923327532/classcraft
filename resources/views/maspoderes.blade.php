<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="font-semibold text-4xl text-gray-800 leading-tight mb-8 text-center">
                    Poderes de {{ ucfirst($estudiante->clase_personaje ?? 'Tu Personaje') }}
                </h2>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if($poderSeleccionado)
                    <div class="bg-blue-50 border-2 border-blue-400 rounded-lg p-6 mb-8 shadow-inner flex items-center space-x-6">
                        <img src="{{ asset($poderSeleccionado->ruta_imagen ?? 'https://placehold.co/80x80/3B82F6/FFFFFF?text=P') }}"
                             alt="{{ $poderSeleccionado->nombre_poder }}"
                             class="w-20 h-20 rounded-full object-cover border-4 border-blue-600 ring-4 ring-blue-300">
                        <div>
                            <h3 class="font-extrabold text-2xl text-blue-900 mb-1">Poder Actual: {{ $poderSeleccionado->nombre_poder }}</h3>
                            <p class="text-blue-800 text-base">{{ $poderSeleccionado->descripcion }}</p>
                            <p class="text-blue-700 text-sm mt-1">Nivel requerido: {{ $poderSeleccionado->nivel->numero_nivel ?? 'N/A' }}</p>
                        </div>
                    </div>
                @else
                    <div class="bg-yellow-50 border-2 border-yellow-400 rounded-lg p-6 mb-8 shadow-inner text-center">
                        <p class="text-yellow-800 font-semibold text-lg">Actualmente no tienes un poder inicial seleccionado.</p>
                        <p class="text-yellow-700 text-sm mt-2">Puedes seleccionar uno de Nivel 1 a continuación.</p>
                    </div>
                @endif

                @php
                    $poderesAgrupadosPorNivel = $todosPoderes->groupBy(function($poder) {
                        return $poder->nivel->numero_nivel ?? 0;
                    })->sortKeys();
                @endphp

                @forelse($poderesAgrupadosPorNivel as $nivelNumero => $poderesDeEsteNivel)
                    <h3 class="font-semibold text-2xl text-gray-800 leading-tight mb-4 mt-8 text-center">
                        Nivel {{ $nivelNumero }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                        @foreach($poderesDeEsteNivel as $poder)
                            @php
                                $poderNivelRequerido = $poder->nivel->numero_nivel ?? 0;
                                $estudianteNivelActual = $estudiante->nivel->numero_nivel ?? 1;

                                $isUnlocked = $estudianteNivelActual >= $poderNivelRequerido;
                                $isCurrentSelected = $poderSeleccionado && $poderSeleccionado->id === $poder->id;
                                $canSelectNivel1 = ($poderNivelRequerido === 1 && !$poderSeleccionado);
                            @endphp

                            @if($isCurrentSelected)
                                @continue {{-- Salta esta iteración si el poder ya es el seleccionado --}}
                            @endif

                            <div class="relative bg-white rounded-lg shadow-lg border
                                {{-- Quitamos el borde morado si ya es el seleccionado, porque ya se omitió arriba --}}
                                {{ $isUnlocked ? 'border-gray-200 hover:shadow-xl' : 'border-gray-300' }}
                                {{ !$isUnlocked ? 'opacity-60 grayscale' : '' }} p-4 transition-all duration-300 transform hover:scale-105">

                                @if(!$isUnlocked)
                                    {{-- CAMBIO: Reemplazamos el texto "BLOQUEADO" por un icono de candado --}}
                                    <span class="absolute top-0 left-0 -translate-x-1/4 -translate-y-1/4 bg-red-600 p-1.5 rounded-full shadow-md z-10 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-white">
                                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @endif
                                
                                <div class="flex items-center mb-3">
                                    <img src="{{ asset($poder->ruta_imagen ?? 'https://placehold.co/60x60/cccccc/333333?text=P') }}"
                                         alt="{{ $poder->nombre_poder }}"
                                         class="w-16 h-16 rounded-full object-cover mr-4 border-2
                                         {{ $isUnlocked ? 'border-blue-500' : 'border-gray-400' }}">
                                    <div>
                                        <h3 class="font-bold text-xl text-gray-800">{{ $poder->nombre_poder }}</h3>
                                        <p class="text-sm text-gray-600">Nivel Requerido: {{ $poderNivelRequerido }}</p>
                                        @if(isset($poder->costo_pp) && $poder->costo_pp > 0)
                                            <p class="text-sm text-gray-600">Costo PP: {{ $poder->costo_pp }}</p>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">{{ $poder->descripcion }}</p>

                                @if($isCurrentSelected) {{-- Esta condición NUNCA será true aquí debido al @continue --}}
                                    <button class="mt-4 w-full bg-purple-500 text-white py-2 px-4 rounded-md cursor-not-allowed font-semibold" disabled>
                                        PODER ACTUAL
                                    </button>
                                @elseif($isUnlocked && $canSelectNivel1)
                                    <form action="{{ route('seleccionar.poder.nivel1') }}" method="POST" class="mt-4">
                                        @csrf
                                        <input type="hidden" name="poder_id" value="{{ $poder->id }}">
                                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md font-semibold transition-colors duration-200">
                                            SELECCIONAR ESTE PODER
                                        </button>
                                    </form>
                                @elseif(!$isUnlocked)
                                    <button class="mt-4 w-full bg-red-500 text-black py-2 px-4 rounded-md cursor-not-allowed font-semibold" disabled>
                                        SE DESBLOQUEA EN NIVEL {{ $poderNivelRequerido }}
                                    </button>
                                @else
                                    <button class="mt-4 w-full bg-gray-400 text-black py-2 px-4 rounded-md cursor-not-allowed font-semibold" disabled>
                                        NO DISPONIBLE PARA SELECCIÓN INICIAL
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">No hay poderes definidos para esta clase de personaje.</p>
                @endforelse

                <div class="mt-10 text-center">
                    <a href="{{ route('interfaz.estudiante') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-black bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg transition-colors duration-200">
                        Volver a tu Perfil
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>