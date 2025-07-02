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
                    <span class="text-xs font-medium">Accesorio</span>
                </a>
                
            </nav>

            <div class="flex-1"></div>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
                <div class="flex items-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Clases') }}
                    </h2>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                <div class="container mx-auto">
                    <div class="bg-white p-8 rounded-xl shadow-lg border border-blue-200 mb-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Unirse a una Clase</h3>
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <input type="text" id="class-id-input" placeholder="Ingresa el ID de la clase" class="w-full md:w-auto flex-1 px-4 py-3 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <button id="join-class-btn" class="px-6 py-3 bg-blue-500 text-black rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl w-full md:w-auto">
                                Unirse
                            </button>
                        </div>
                        <div id="join-message" class="mt-4 text-center text-lg font-semibold hidden"></div>
                    </div>

                    <div id="current-class-info" class="bg-white p-8 rounded-xl shadow-lg border border-green-200 hidden">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Mi Clase Actual</h3>
                        <p class="text-gray-700 text-lg">
                            Estás unido a la clase: <span id="current-class-name" class="font-semibold text-blue-600"></span>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Maestro: <span id="current-teacher-name" class="font-semibold text-purple-600"></span>
                        </p>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const classIdInput = document.getElementById('class-id-input');
            const joinClassBtn = document.getElementById('join-class-btn');
            const joinMessage = document.getElementById('join-message');
            const currentClassInfo = document.getElementById('current-class-info');
            const currentClassName = document.getElementById('current-class-name');
            const currentTeacherName = document.getElementById('current-teacher-name');

            function showMessage(message, type = 'success') {
                joinMessage.textContent = message;
                joinMessage.className = `mt-4 text-center text-lg font-semibold ${type === 'success' ? 'text-green-600' : 'text-red-600'}`;
                joinMessage.classList.remove('hidden');
                setTimeout(() => {
                    joinMessage.classList.add('hidden');
                }, 5000);
            }

            async function loadCurrentClass() {
                try {
                    const response = await fetch('{{ route('api.estudiante.current-class') }}', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });
                    const data = await response.json();

                    if (data.success && data.class_info) {
                        currentClassName.textContent = data.class_info.class_name;
                        currentTeacherName.textContent = data.class_info.teacher_name;
                        currentClassInfo.classList.remove('hidden');
                        classIdInput.disabled = true;
                        joinClassBtn.disabled = true;
                        joinClassBtn.textContent = 'Ya estás unido';
                        joinClassBtn.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                        joinClassBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                    } else {
                        currentClassInfo.classList.add('hidden');
                        classIdInput.disabled = false;
                        joinClassBtn.disabled = false;
                        joinClassBtn.textContent = 'Unirse';
                        joinClassBtn.classList.add('bg-blue-500', 'hover:bg-blue-600');
                        joinClassBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                    }
                } catch (error) {
                    console.error('Error al cargar la clase actual:', error);
                    currentClassInfo.classList.add('hidden');
                    classIdInput.disabled = false;
                    joinClassBtn.disabled = false;
                    joinClassBtn.textContent = 'Unirse';
                    joinClassBtn.classList.add('bg-blue-500', 'hover:bg-blue-600');
                    joinClassBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                }
            }

            loadCurrentClass();

            joinClassBtn.addEventListener('click', async function() {
                const classId = classIdInput.value.trim();

                if (!classId) {
                    showMessage('Por favor, ingresa un ID de clase.', 'error');
                    return;
                }

                try {
                    const response = await fetch('{{ route('clases.join') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ class_id: classId })
                    });

                    const data = await response.json();

                    if (data.success) {
                        showMessage(data.message, 'success');
                        currentClassName.textContent = data.class_name;
                        currentTeacherName.textContent = data.teacher_name;
                        currentClassInfo.classList.remove('hidden');
                        classIdInput.disabled = true;
                        joinClassBtn.disabled = true;
                        joinClassBtn.textContent = 'Ya estás unido';
                        joinClassBtn.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                        joinClassBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                    } else {
                        showMessage(data.message, 'error');
                    }
                } catch (error) {
                    console.error('Error al unirse a la clase:', error);
                    showMessage('Error al unirse a la clase. Inténtalo de nuevo.', 'error');
                }
            });
        });
    </script>
</x-app-layout>