<x-app-layout>

    <div class="flex h-screen bg-gray-100">
        {{-- Sidebar de Navegación Principal --}}
        <div class="w-16 bg-gray-800 shadow-lg flex flex-col items-center py-4 space-y-4">

            {{-- Navegación Principal --}}
            <nav class="flex flex-col space-y-2 w-full">
                {{-- Perfil --}}
                <a href="{{ route('interfaz.estudiante') }}" class="group flex flex-col items-center p-2 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white transition-colors duration-200
                    {{ request()->routeIs('interfaz.estudiante') ? 'bg-blue-600 text-white' : '' }}">
                    <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-xs font-medium">Perfil</span>
                </a>

                {{-- Sentencias (Activo en esta página) --}}
                <a href="{{ route('sentencias.index') }}" class="group flex flex-col items-center p-2 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white transition-colors duration-200
                    {{ request()->routeIs('sentencias.index') ? 'bg-blue-600 text-white' : '' }}">
                    <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-xs font-medium">Penalizaciones</span>
                </a>

                {{-- Misiones --}}
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

        <div class="flex-1 relative overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                 style="background-image: url('{{ asset('images/background-character-interface.jpg') }}');">
            </div>

            <div class="absolute inset-0 bg-black bg-opacity-20"></div>

            <div class="relative z-10 h-full flex flex-col p-6">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                            Penalizaciones
                        </h2>

                        <div class="space-y-4">
                            @php
                                $sentencias = [
                                    ['descripcion' => 'Rendirse ante un problema técnico.', 'hp' => -5],
                                    ['descripcion' => 'Entregar el trabajo tarde.', 'hp' => -10],
                                    ['descripcion' => 'Ser grosero con un compañero de clase.', 'hp' => -10],
                                    ['descripcion' => 'Mostrar desinterés.', 'hp' => -5],
                                    ['descripcion' => 'No comunicarse con el profesor durante el día.', 'hp' => -10],
                                    ['descripcion' => 'Usar el teléfono o dispositivos electrónicos sin permiso en clase.', 'hp'=>-15],
                                    ['descripcion' => 'No participar activamente en clase.', 'hp'=>-5]
                                ];
                            @endphp

                            @foreach($sentencias as $sentencia)
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6 flex justify-between items-center border border-gray-200">
                                    <p class="text-gray-900 dark:text-gray-100 text-base font-medium">
                                        {{ $sentencia['descripcion'] }}
                                    </p>
                                    <span class="text-red-600 font-bold text-lg ml-4 flex-shrink-0">
                                        {{ $sentencia['hp'] }} HP
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>