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
                    <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
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
                        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                            Accesorios
                        </h2>
                        
                        @if (session('success'))
                            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                                <strong class="font-bold">¡Éxito!</strong>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                                <strong class="font-bold">¡Error!</strong>
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        @endif

                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6">
                            <p class="text-gray-900 dark:text-gray-100 mb-6">Explora y compra accesorios para tu personaje:</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8">
                                @php
                                    $accesorios = [
                                        ['id' => 'acc_001', 'nombre' => 'Aro Puro', 'imagen' => 'images/accesorios/aropuro.png', 'costo' => 5, 'descripcion' => 'Aumenta tu poder mágico en un 10%.'],
                                        ['id' => 'acc_002', 'nombre' => ' Bora Andante', 'imagen' => 'images/accesorios/botaandante.png', 'costo' => 5, 'descripcion' => 'Mejora tu velocidad y evasión en un 5%.'],
                                        ['id' => 'acc_003', 'nombre' => 'Broche', 'imagen' => 'images/accesorios/broche.png', 'costo' => 5, 'descripcion' => 'Otorga resistencia a hechizos elementales.'],
                                        ['id' => 'acc_004', 'nombre' => ' Caliz Vital', 'imagen' => 'images/accesorios/calizvital.png', 'costo' => 5, 'descripcion' => 'Incrementa tu velocidad de movimiento en un 15%.'],
                                        ['id' => 'acc_005', 'nombre' => 'Velo Bendito', 'imagen' => 'images/accesorios/velobendito.png', 'costo' => 5, 'descripcion' => 'Reduce el daño físico recibido en un 8%.'],
                                    ];
                                @endphp

                                @foreach($accesorios as $accesorio)
                                    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md overflow-hidden flex flex-col items-center p-4 transform transition duration-300 hover:scale-105 hover:shadow-xl">
                                        <img src="{{ asset($accesorio['imagen']) }}" alt="{{ $accesorio['nombre'] }}" class="w-32 h-32 object-contain mb-3 rounded-full border-2 border-gray-300 dark:border-gray-600">
                                        
                                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-1 text-center">{{ $accesorio['nombre'] }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 text-center">{{ $accesorio['descripcion'] }}</p>
                                        <p class="text-xl font-bold text-yellow-600 mb-3">{{ $accesorio['costo'] }} GP</p>
                                        
                                        <form action="{{ route('accesorios.comprar') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="accesorio_id" value="{{ $accesorio['id'] }}">
                                            <button type="submit" 
                                                    class="bg-blue-600 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-full text-md shadow-md hover:shadow-lg transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                                                Comprar
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(event) {
                const costoElement = this.closest('.bg-gray-100, .dark:bg-gray-700').querySelector('.text-yellow-600');
                const costoTexto = costoElement ? costoElement.textContent : '5 GP';

                if (!confirm('¿Estás seguro de que quieres comprar este accesorio por ' + costoTexto + '?')) {
                    event.preventDefault();
                }
            });
        });
    </script>
</x-app-layout>