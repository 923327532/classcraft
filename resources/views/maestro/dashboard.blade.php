<x-app-layout>
    <div class="flex h-screen bg-gray-100">
        <div id="sidebar" class="w-16 bg-black shadow-lg flex flex-col py-4 h-screen">
            <nav class="flex-1 px-2 space-y-4">
                <a href="{{ route('maestro.dashboard') }}#" class="group flex flex-col items-center p-2 rounded-lg text-gray-50 hover:bg-gray-700 hover:text-white transition-colors duration-200 w-full">
                    <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    <span class="text-xs font-medium">Mis clases</span>
                </a>
                <a href="#" class="group flex flex-col items-center p-2 rounded-lg text-gray-50 hover:bg-gray-700 hover:text-white transition-colors duration-200 w-full">
                    <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"></path></svg>
                    <span class="text-xs font-medium">Eventos</span>
                </a>
                <a href="{{ route('misiones.index') }}" class="group flex flex-col items-center p-2 rounded-lg text-gray-50 hover:bg-gray-700 hover:text-white transition-colors duration-200 w-full">
                    <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                    <span class="text-xs font-medium">Misiones</span>
                </a>
                <a href="#" class="group flex flex-col items-center p-2 rounded-lg text-gray-50 hover:bg-gray-700 hover:text-white transition-colors duration-200 w-full">
                    <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z"></path></svg>
                    <span class="text-xs font-medium">La rueda</span>
                </a>
            </nav>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
                <div class="flex items-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Bienvenido a ClassCraft, ') }} {{ Auth::user()->name ?? 'Maestro' }}!
                    </h2>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-6 py-8">
                    <div id="initial-welcome-box" class="bg-white p-8 rounded-xl shadow-lg border border-blue-200">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="bg-blue-500 p-3 rounded-full">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-3xl font-bold text-gray-800 mb-2">¡Te damos la bienvenida, {{ Auth::user()->name ?? 'Ejemplo' }}!</h3>
                                <p class="text-gray-600 text-lg">
                                    Puedes empezar creando una clase y adicionando alumnos. ¿Listo para la aventura?
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-start mt-8">
                        <button id="createClassButton" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-black transition-all duration-300 bg-white rounded-xl shadow-lg hover:bg-gray-100 hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300 focus:ring-opacity-50 active:scale-95 active:shadow-md">
                            <svg class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            Crear nueva clase
                            <div class="absolute inset-0 bg-white opacity-0 rounded-xl transition-opacity duration-300 group-hover:opacity-10"></div>
                        </button>
                    </div>

                    <div id="create-class-form-container" class="hidden bg-white p-8 rounded-xl shadow-xl border border-gray-200 mt-8">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="bg-blue-500 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <form id="create-class-form">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="nombre_clase" class="block text-gray-700 text-sm font-semibold mb-3">Nombre de la clase:</label>
                                    <input type="text" id="nombre_clase" name="nombre_clase" class="w-full px-4 py-3 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="Ej: Matemáticas 6°A" required>
                                </div>
                                <div>
                                    <label for="fecha_inicio" class="block text-gray-700 text-sm font-semibold mb-3">Fecha de inicio:</label>
                                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="w-full px-4 py-3 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" required>
                                </div>
                            </div>
                            <div class="mb-8">
                                <label for="fecha_fin" class="block text-gray-700 text-sm font-semibold mb-3">Fecha de fin:</label>
                                <input type="date" id="fecha_fin" name="fecha_fin" class="w-full px-4 py-3 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" required>
                            </div>
                            <div class="flex items-center justify-end space-x-4">
                                <button type="button" id="cancelCreateClass" class="px-6 py-3 text-gray-600 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors duration-200 font-medium">
                                    Cancelar
                                </button>
                                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-black rounded-lg hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                                    Guardar Clase
                                </button>
                            </div>
                        </form>
                    </div>

                    <div id="class-cards-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                    </div>
                </div>
            </main>
        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const createClassButton = document.getElementById('createClassButton');
    const initialWelcomeBox = document.getElementById('initial-welcome-box');
    const createClassFormContainer = document.getElementById('create-class-form-container');
    const cancelCreateClassButton = document.getElementById('cancelCreateClass');
    const createClassForm = document.getElementById('create-class-form');
    const classCardsContainer = document.getElementById('class-cards-container');

    // Renderiza una tarjeta de clase en el contenedor
    function renderClassCard(clase) {
        const classCard = document.createElement('div');
        classCard.className = 'group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200 hover:border-blue-300 transform hover:-translate-y-1 overflow-hidden relative';
        classCard.setAttribute('data-class-id', clase.id_clase);

        const formattedFechaInicio = new Date(clase.fecha_inicio).toISOString().split('T')[0];
        const formattedFechaFin = new Date(clase.fecha_fin).toISOString().split('T')[0];

        classCard.innerHTML = `
            <div class="p-6">
                <div class="mb-4">
                    <h4 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-200">${clase.nombre_clase}</h4>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="text-xs text-gray-500">Inicio</p>
                                <p class="text-sm font-semibold text-gray-700">${formattedFechaInicio}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="text-xs text-gray-500">Fin</p>
                                <p class="text-sm font-semibold text-gray-700">${formattedFechaFin}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="button" class="assign-students-btn px-3 py-2 text-sm bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-lg hover:from-blue-100 hover:to-blue-200 hover:shadow-md hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-200 font-medium text-gray-700 cursor-pointer active:scale-95" data-id="${clase.id_clase}">
                    Asignar Alumnos
                </button>
                
                <button type="button" class="delete-class-btn px-3 py-2 text-sm bg-gradient-to-r from-red-50 to-red-100 border border-red-200 rounded-lg hover:from-red-100 hover:to-red-200 hover:shadow-md hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-red-300 transition-all duration-200 font-medium text-gray-700 cursor-pointer active:scale-95" data-id="${clase.id_clase}">
                    Eliminar Clase
                </button>
            </div>
        `;

        classCardsContainer.prepend(classCard);
    }

    // Carga las clases desde el backend
    async function loadClasses() {
        try {
            const response = await fetch('{{ route('clases.index') }}', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            const clases = await response.json();
            if (clases.length > 0) {
                initialWelcomeBox.classList.add('hidden');
            }
            clases.forEach(clase => renderClassCard(clase));
        } catch (error) {
            console.error('Error al cargar las clases:', error);
        }
    }
    loadClasses();

    // Mostrar formulario para crear clase
    createClassButton.addEventListener('click', function(e) {
        e.preventDefault();
        createClassFormContainer.classList.remove('hidden');
        createClassFormContainer.scrollIntoView({ behavior: 'smooth' });
    });

    // Cancelar creación de clase
    cancelCreateClassButton.addEventListener('click', function() {
        createClassFormContainer.classList.add('hidden');
        createClassForm.reset();
    });

    // Crear nueva clase
    createClassForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const nombreClase = document.getElementById('nombre_clase').value;
        const fechaInicio = document.getElementById('fecha_inicio').value;
        const fechaFin = document.getElementById('fecha_fin').value;

        try {
            const response = await fetch('{{ route('clases.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    nombre_clase: nombreClase,
                    fecha_inicio: fechaInicio,
                    fecha_fin: fechaFin
                })
            });

            if (response.ok) {
                const nuevaClase = await response.json();
                renderClassCard(nuevaClase);
                createClassFormContainer.classList.add('hidden');
                createClassForm.reset();
                initialWelcomeBox.classList.add('hidden');
            } else {
                const errorData = await response.json();
                console.error('Error al guardar la clase:', errorData);
                alert('Error al guardar la clase: ' + (errorData.message || 'Error desconocido'));
            }
        } catch (error) {
            console.error('Error de red al guardar la clase:', error);
            alert('Error de red al guardar la clase.');
        }
    });

    // Manejo de botones dentro de las tarjetas de clase
    classCardsContainer.addEventListener('click', async function(e) {
        if (e.target.classList.contains('delete-class-btn')) {
            e.preventDefault();
            const classId = e.target.dataset.id;

            if (confirm('¿Estás seguro de que quieres eliminar esta clase?')) {
                try {
                    const response = await fetch(`/clases/${classId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });

                    if (response.ok) {
                        e.target.closest('.group').remove();
                        if (classCardsContainer.children.length === 0) {
                            initialWelcomeBox.classList.remove('hidden');
                        }
                    } else {
                        const errorData = await response.json();
                        console.error('Error al eliminar la clase:', errorData);
                        alert('Error al eliminar la clase: ' + (errorData.message || 'Error desconocido'));
                    }
                } catch (error) {
                    console.error('Error de red al eliminar la clase:', error);
                    alert('Error de red al eliminar la clase.');
                }
            }
        }

        if (e.target.classList.contains('assign-students-btn')) {
            const classId = e.target.dataset.id;
            window.location.href = `{{ url('maestro/asignar-alumno') }}/${classId}`;
        }
    });
});
</script>
</x-app-layout>
