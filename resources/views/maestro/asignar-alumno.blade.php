<x-app-layout>
    <div class="flex flex-col h-screen bg-gray-100">
        <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Asignar Alumnos a Clase: ') }} {{ $clase->nombre_clase }}
                </h2>
            </div>
            <div class="flex items-center">
                <a href="{{ route('maestro.dashboard') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-medium">
                    Volver
                </a>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
            <div class="container mx-auto px-6 py-8">
                <div class="bg-white p-8 rounded-xl shadow-lg border border-blue-200 mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Clase ID: <span id="class-id-display" class="text-blue-600">{{ $clase->id_clase }}</span></h3>
                    <div class="flex items-center space-x-4">
                        <input type="email" id="student-email-search" placeholder="Buscar alumno por correo electrónico" class="w-full px-4 py-3 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <button id="search-student-btn" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                            Buscar
                        </button>
                    </div>
                </div>

                <div id="search-results-container" class="bg-white p-8 rounded-xl shadow-lg border border-gray-200 hidden mb-8">
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Resultados de la búsqueda:</h4>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Correo Electrónico
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Personaje
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody id="students-table-body" class="bg-white divide-y divide-gray-200">
                            
                        </tbody>
                    </table>
                    <div id="no-results-message" class="text-center text-gray-500 mt-4 hidden">
                        No se encontraron alumnos con ese correo electrónico.
                    </div>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg border border-green-200">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Alumnos Unidos a la Clase ({{ $clase->estudiantes->count() }})</h3>
                    @if($clase->estudiantes->isEmpty())
                        <p class="text-gray-600 text-center">No hay alumnos unidos a esta clase todavía.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Correo Electrónico
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Personaje Elegido
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($clase->estudiantes as $estudiante)
                                        <tr id="student-row-{{ $estudiante->id_estudiante }}">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $estudiante->user->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $estudiante->user->email ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ ucfirst($estudiante->clase_personaje ?? 'No Asignado') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button data-student-id="{{ $estudiante->id_estudiante }}" data-class-id="{{ $clase->id_clase }}" class="remove-student-btn px-4 py-2 text-xs bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition-all duration-200">
                                                    Remover
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <div id="message-box" class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hidden">
                    
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const classIdDisplay = document.getElementById('class-id-display');
            const studentEmailSearch = document.getElementById('student-email-search');
            const searchStudentBtn = document.getElementById('search-student-btn');
            const searchResultsContainer = document.getElementById('search-results-container');
            const studentsTableBody = document.getElementById('students-table-body');
            const noResultsMessage = document.getElementById('no-results-message');
            const messageBox = document.getElementById('message-box');

            const classId = classIdDisplay.textContent;

            function showMessage(message, type = 'success') {
                messageBox.textContent = message;
                messageBox.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
                messageBox.classList.remove('hidden');
                setTimeout(() => {
                    messageBox.classList.add('hidden');
                }, 3000);
            }

            searchStudentBtn.addEventListener('click', async function() {
                const email = studentEmailSearch.value.trim();
                if (!email) {
                    showMessage('Por favor, introduce un correo electrónico para buscar.', 'error');
                    return;
                }

                studentsTableBody.innerHTML = '';
                noResultsMessage.classList.add('hidden');
                searchResultsContainer.classList.add('hidden');

                try {
                    const response = await fetch('{{ route('api.students.search') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ email: email })
                    });
                    const data = await response.json();

                    if (data.students && data.students.length > 0) {
                        searchResultsContainer.classList.remove('hidden');
                        data.students.forEach(student => {
                            const row = document.createElement('tr');
                            row.className = 'hover:bg-gray-100';
                            const isAlreadyInClass = student.current_class_id === classId;
                            row.innerHTML = `
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${student.name}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${student.email}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${student.clase_personaje ? student.clase_personaje.charAt(0).toUpperCase() + student.clase_personaje.slice(1) : 'No Asignado'}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button data-student-id="${student.id_estudiante}" class="add-to-class-btn px-4 py-2 text-xs ${isAlreadyInClass ? 'bg-gray-400 cursor-not-allowed' : 'bg-green-500 hover:bg-green-600'} text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 transition-all duration-200" ${isAlreadyInClass ? 'disabled' : ''}>
                                        ${isAlreadyInClass ? 'Ya en Clase' : 'Agregar a la clase'}
                                    </button>
                                </td>
                            `;
                            studentsTableBody.appendChild(row);
                        });
                    } else {
                        noResultsMessage.classList.remove('hidden');
                        searchResultsContainer.classList.remove('hidden');
                    }

                } catch (error) {
                    console.error('Error al buscar alumnos:', error);
                    showMessage('Error al buscar alumnos. Inténtalo de nuevo.', 'error');
                }
            });

            studentsTableBody.addEventListener('click', async function(e) {
                if (e.target.classList.contains('add-to-class-btn')) {
                    const studentId = e.target.dataset.studentId;
                    
                    try {
                        const response = await fetch(`{{ url('api/classes') }}/${classId}/add-student`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ student_id: studentId })
                        });
                        const result = await response.json();

                        if (result.success) {
                            showMessage(result.message);
                            e.target.disabled = true;
                            e.target.textContent = 'Agregado';
                            e.target.classList.remove('bg-green-500', 'hover:bg-green-600');
                            e.target.classList.add('bg-gray-400', 'cursor-not-allowed');

                            // Recargar la lista de alumnos unidos a la clase
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000); // Recargar después de un breve retraso para que el mensaje sea visible
                        } else {
                            showMessage(result.message || 'Error al agregar alumno a la clase.', 'error');
                        }

                    } catch (error) {
                        console.error('Error de red al agregar alumno:', error);
                        showMessage('Error de red al agregar alumno a la clase.', 'error');
                    }
                }
            });

            document.querySelectorAll('.remove-student-btn').forEach(button => {
                button.addEventListener('click', async function() {
                    const studentId = this.dataset.studentId;
                    const classId = this.dataset.classId;

                    if (confirm('¿Estás seguro de que quieres remover a este alumno de la clase?')) {
                        try {
                            const response = await fetch(`{{ url('api/classes') }}/${classId}/remove-student`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({ student_id: studentId })
                            });

                            const data = await response.json();

                            if (data.success) {
                                showMessage(data.message, 'success');
                                document.getElementById(`student-row-${studentId}`).remove();
                            } else {
                                showMessage(data.message || 'Error al remover al alumno.', 'error');
                            }
                        } catch (error) {
                            console.error('Error de red al remover alumno:', error);
                            showMessage('Error de red al remover al alumno.', 'error');
                        }
                    }
                });
            });
        });
    </script>
</x-app-layout>