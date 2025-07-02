<x-app-layout>

    <div class="flex h-screen bg-gray-100">
        <div class="w-16 bg-gray-800 shadow-lg flex flex-col items-center py-4 space-y-4">

            <nav class="flex flex-col space-y-2 w-full">
                <a href="{{ route('interfaz.estudiante') }}" class="group flex flex-col items-center p-2 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white transition-colors duration-200
                    {{ request()->routeIs('interfaz.estudiante') ? 'bg-blue-600 text-white' : '' }}">
                    <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-xs font-medium">Perfil</span>
                </a>

                <a href="{{ route('sentencias.index') }}" class="group flex flex-col items-center p-2 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white transition-colors duration-200
                    {{ request()->routeIs('sentencias.index') ? 'bg-blue-600 text-white' : '' }}">
                    <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-xs font-medium">Penalizaciones</span>
                </a>

                <a href="{{ route('misiones.index') }}" class="group flex flex-col items-center p-2 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white transition-colors duration-200
                    {{ request()->routeIs('misiones.index') ? 'bg-blue-600 text-white' : '' }}">
                    <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-xs font-medium">Misiones</span>
                </a>

                <a href="{{ route('clases.index') }}" class="group flex flex-col items-center p-2 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white transition-colors duration-200
                  {{ request()->routeIs('clases.index') ? 'bg-blue-600 text-white' : '' }}">
                 <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                     <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 001 1h-1a1 1 0 100 2h2a1 1 0 001-1V4a4 4 0 00-4-4H6a4 4 0 00-4 4v12a1 1 0 001 1h-1a1 1 0 100 2h2a1 1 0 001-1V4z" clip-rule="evenodd"/>
                      </svg>
                  <span class="text-xs font-medium">Clases</span>
               </a>

                <a href="{{ route('accesorios') }}" class="group flex flex-col items-center p-2 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white transition-colors duration-200
                    {{ request()->routeIs('accesorios') ? 'bg-blue-600 text-white' : '' }}">
                    <svg class="w-12 h-12 mb-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7 8a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H8a1 1 0 01-1-1V8zm3 6a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-xs font-medium">Accesorios</span>
                </a>

            </nav>

            <div class="flex-1"></div>
        </div>

        <div class="w-80 bg-white shadow-lg border-r border-gray-200 flex flex-col">
            @if(isset($estudiante))
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center space-x-4">
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">{{ $estudiante->user->name ?? 'Lionel Messi' }}</h3>
                            <p class="text-sm text-blue-600">{{ ucfirst($estudiante->clase_personaje ?? 'Sanador') }} • Nivel {{ $estudiante->nivel->numero_nivel ?? 1 }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6 border-b border-gray-200 flex-1">
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-bold text-gray-700">HP</span>
                            <span class="text-sm font-bold text-gray-800">{{ $estudiante->puntos_vida ?? 50 }}</span>
                        </div>
                        <div class="relative">
                            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                                <div class="bg-gradient-to-r from-red-500 to-red-600 h-full rounded-full transition-all duration-500 shadow-inner"
                                    style="width: {{ (($estudiante->puntos_vida ?? 50) / (max(1, $estudiante->max_hp ?? 50))) * 100 }}%;"></div>
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-xs font-bold text-black mix-blend-difference">{{ $estudiante->puntos_vida ?? 50 }}/{{ $estudiante->max_hp ?? 50 }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-bold text-gray-700">AP</span>
                            <span class="text-sm font-bold text-gray-800">{{ $estudiante->puntos_accion ?? 35 }}</span>
                        </div>
                        <div class="relative">
                            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                                <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-full rounded-full transition-all duration-500 shadow-inner"
                                    style="width: {{ (($estudiante->puntos_accion ?? 35) / (max(1, $estudiante->max_ap ?? 35))) * 100 }}%;"></div>
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-xs font-bold text-black mix-blend-difference">{{ $estudiante->puntos_accion ?? 35 }}/{{ $estudiante->max_ap ?? 35 }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-bold text-gray-700">XP</span>
                            <span class="text-sm font-bold text-gray-800">{{ $estudiante->puntos_experiencia ?? 0 }}</span>
                        </div>
                        <div class="relative">
                            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                                <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-full rounded-full transition-all duration-500 shadow-inner"
                                    style="width: {{ (($estudiante->puntos_experiencia ?? 0) / (max(1, $estudiante->xp_to_next_level ?? 100))) * 100 }}%;"></div>
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-xs font-bold text-black mix-blend-difference">{{ $estudiante->puntos_experiencia ?? 0 }}/{{ $estudiante->xp_to_next_level ?? 100 }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-bold text-gray-700">GP</span>
                            <span class="text-lg font-bold text-green-600">{{ $estudiante->puntos_oro ?? 0 }}</span>
                        </div>
                    </div>
                </div>

                @if(isset($estudiante->poderSeleccionado))
                    <div class="p-4 bg-blue-50 border-t border-blue-200">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset($estudiante->poderSeleccionado->ruta_imagen ?? 'https://placehold.co/40x40/3B82F6/FFFFFF?text=P') }}"
                            alt="{{ $estudiante->poderSeleccionado->nombre_poder ?? 'Cura 1' }}"
                                 class="w-10 h-10 rounded-full object-cover border-2 border-blue-400">
                            <div class="flex-1 min-w-0 space-y-1">
                                <h4 class="text-sm font-bold text-blue-900 truncate">{{ $estudiante->poderSeleccionado->nombre_poder ?? 'Cura 1' }}</h4>
                                <p class="text-xs text-blue-700">Tienes {{ $estudiante->poderes_disponibles ?? 1 }} punto(s) de poder</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="p-4 bg-gray-50 border-t border-gray-200">
                        <p class="text-gray-500 text-sm">No hay poder seleccionado.</p>
                    </div>
                @endif
            @else
                <div class="flex-1 flex items-center justify-center p-4">
                    <p class="text-gray-500 text-center text-sm">Cargando información del estudiante...</p>
                </div>
            @endif

            <div class="p-6 flex justify-center">
                <a href="{{ route('mas.poderes.personaje', ['clase_personaje' => $estudiante->clase_personaje ?? '']) }}"
                   class="bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 text-black px-8 py-3 rounded-lg font-bold transition-all duration-300 transform hover:scale-105 shadow-lg border-2 border-purple-700 hover:border-blue-700">
                    MÁS PODERES DEL PERSONAJE
                </a>
            </div>
        </div>

        <div class="flex-1 relative overflow-hidden">
             <div class="absolute inset-0 bg-center bg-no-repeat"
                 style="background-image: url('{{ asset($estudiante->combined_image_path ?? 'images/default_combined_image.png') }}'); background-size: 100% 100%;">
             </div>

            <div class="relative z-10 h-full flex flex-col">
                <div class="p-6 flex justify-end">
                    <div class="bg-white bg-opacity-90 backdrop-blur-sm rounded-lg p-4 shadow-lg border border-gray-200">
                        <p class="text-gray-700 text-sm font-medium">Estado del Equipo</p>
                        <p class="text-blue-600 font-bold">Esperando para ser asignado a un equipo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>