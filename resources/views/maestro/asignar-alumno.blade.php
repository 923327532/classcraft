<x-app-layout>
    <div class="flex flex-col h-screen bg-teal-100">

        <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Asignar Alumnos a Clase: ') }} {{ $clase->nombre_clase }}
                </h2>
            </div>
            <div class="flex items-center">
            <a href="{{ route('maestro.dashboard') }}#" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-medium">
                    Volver
                </a>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
            <div class="container mx-auto px-6 py-8">
                <div class="bg-[#e0f7f4] p-8 rounded-xl shadow-lg border border-blue-200 mb-8">


                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Clase ID: <span id="class-id-display" class="text-blue-600">{{ $clase->id_clase }}</span></h3>
                    <div class="flex items-center space-x-4">
                        <input type="email" id="student-email-search" placeholder="Buscar alumno por correo electrónico" class="w-full px-4 py-3 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <button id="search-student-btn" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                            Buscar
                        </button>
                    </div>
                </div>

                <div id="search-results-container" class="bg-white p-8 rounded-xl shadow-lg border border-gray-200 hidden mb-8">
                    <h4 class="text-xl font-bold text-yellow-800 mb-4">Resultados de la búsqueda:</h4>
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
   

<form id="upload-excel-form" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" id="input-excel" accept=".xlsx,.xls" />
    <button type="submit" id="upload-excel-btn" class="px-4 py-2 bg-blue-600 text-white rounded">Subir Excel</button>
</form>

<div id="upload-message" class="mt-2 text-center text-sm"></div>

<script>
document.getElementById('upload-excel-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const fileInput = document.getElementById('input-excel');
    const uploadBtn = document.getElementById('upload-excel-btn');
    const uploadMessage = document.getElementById('upload-message');
    uploadMessage.textContent = '';
    uploadMessage.className = 'mt-2 text-center text-sm';

    if (!fileInput.files.length) {
        uploadMessage.textContent = 'Selecciona un archivo Excel';
        uploadMessage.classList.add('text-red-600');
        return;
    }

    const file = fileInput.files[0];

    // Validar extensión
    const allowedExtensions = ['xlsx', 'xls'];
    const fileExtension = file.name.split('.').pop().toLowerCase();
    if (!allowedExtensions.includes(fileExtension)) {
        uploadMessage.textContent = 'Solo se permiten archivos Excel (.xlsx, .xls)';
        uploadMessage.classList.add('text-red-600');
        return;
    }

    // Validar tamaño máximo (por ejemplo 5MB)
    const maxSizeMB = 5;
    if (file.size > maxSizeMB * 1024 * 1024) {
        uploadMessage.textContent = `El archivo debe ser menor a ${maxSizeMB} MB`;
        uploadMessage.classList.add('text-red-600');
        return;
    }

    const formData = new FormData();
    formData.append('file', file);

    // Tomar token CSRF del meta tag para mayor seguridad
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    formData.append('_token', csrfToken);

    // Deshabilitar botón mientras sube
    uploadBtn.disabled = true;
    uploadBtn.textContent = 'Subiendo...';

    try {
        const classId = '{{ $clase->id_clase }}';

        const response = await fetch(`/maestro/clases/${classId}/upload-students`, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        });

        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }

        const data = await response.json();

        if (data.success) {
            uploadMessage.textContent = data.message || 'Archivo subido correctamente.';
            uploadMessage.classList.add('text-green-600');
            // Opcional: limpiar input
            fileInput.value = '';

            // Actualizar lista alumnos sin recargar (si tienes función)
            // o recargar después de delay
            setTimeout(() => {
                location.reload();
            }, 1500);

        } else {
            uploadMessage.textContent = data.message || 'Error al subir archivo.';
            uploadMessage.classList.add('text-red-600');
        }

    } catch (error) {
        console.error('Error en la subida:', error);
        uploadMessage.textContent = 'Error en la conexión o en el servidor.';
        uploadMessage.classList.add('text-red-600');
    } finally {
        uploadBtn.disabled = false;
        uploadBtn.textContent = 'Subir Excel';
    }
});
</script>

</x-app-layout>