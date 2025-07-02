<x-app-layout>
    <div class="flex h-screen bg-gray-100">
        {{-- Sidebar (Este contenido del sidebar se define en tu x-app-layout, o puedes copiarlo aquí si tu x-app-layout es solo un slot) --}}
        {{-- Si tu x-app-layout YA tiene el sidebar, NO LO DUPLIQUES AQUÍ. Simplemente, tu x-app-layout debe tener un <div class="flex ..."> y un slot. --}}
        {{-- Para este ejemplo, asumo que tu x-app-layout ya maneja la estructura principal con sidebar y main content. --}}

        {{-- Contenido principal --}}
        <div class="flex-1 relative overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                 style="background-image: url('{{ asset('images/background-character-interface.jpg') }}');">
            </div>
            <div class="absolute inset-0 bg-black bg-opacity-20"></div>

            <div class="relative z-10 h-full flex flex-col p-6 items-center justify-center">
                <div class="py-6 w-full max-w-2xl bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-8 text-center">
                    
                    {{-- Accede a los datos flasheados directamente desde la sesión --}}
                    @if (session('success') && session('purchased_accesorio'))
                        @php
                            $accesorioComprado = session('purchased_accesorio');
                        @endphp
                        <h2 class="text-3xl font-bold text-green-600 dark:text-green-400 mb-6">
                            ¡Compra Exitosa!
                        </h2>
                        <p class="text-gray-700 dark:text-gray-300 mb-4 text-lg">
                            Has adquirido el siguiente accesorio:
                        </p>
                        
                        <div class="flex flex-col items-center space-y-4 mb-6">
                            <img src="{{ asset($accesorioComprado['imagen']) }}" alt="{{ $accesorioComprado['nombre'] }}" class="w-48 h-48 object-cover rounded-full border-4 border-blue-500 shadow-lg">
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $accesorioComprado['nombre'] }}</h3>
                            <p class="text-md text-gray-600 dark:text-gray-400">{{ $accesorioComprado['descripcion'] }}</p>
                        </div>

                        <a href="{{ route('accesorios') }}" 
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            Volver a la Tienda de Accesorios
                        </a>

                    @elseif (session('error'))
                        <h2 class="text-3xl font-bold text-red-600 dark:text-red-400 mb-6">
                            ¡Error en la Compra!
                        </h2>
                        <p class="text-gray-700 dark:text-gray-300 mb-8 text-lg">
                            {{ session('error') }}
                        </p>
                        <a href="{{ route('accesorios') }}" 
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                            Intentar de Nuevo
                        </a>
                    @else
                        <h2 class="text-3xl font-bold text-gray-700 dark:text-gray-300 mb-6">
                            Estado de la Compra
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 mb-8">
                            No se ha encontrado información sobre tu última compra.
                        </p>
                        <a href="{{ route('accesorios') }}" 
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-black bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                            Ir a la Tienda de Accesorios
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>