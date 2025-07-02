<x-app-layout>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Elige tu Fondo - ClassCraft</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f3f4f6;
            }
            .background-card.selected {
                border-color: #4F46E5;
                box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.6);
                transform: translateY(-8px) scale(1.02);
            }
            .background-card {
                transition: all 0.3s ease-in-out;
            }
            .background-card:hover {
                transform: translateY(-4px) scale(1.01);
                box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            }
        </style>
    </head>
    <body>
        <div class="min-h-screen flex flex-col items-center justify-center p-6 sm:p-10 lg:p-16 bg-gradient-to-br from-blue-100 to-indigo-100">

            <div class="bg-white rounded-3xl shadow-2xl p-8 sm:p-12 md:p-16 text-center w-full max-w-4xl transform transition-all duration-500 hover:scale-[1.005] hover:shadow-3xl border border-gray-100">
                
                <h2 class="text-5xl sm:text-6xl font-extrabold text-gray-800 leading-tight mb-8">
                    Elige tu <span class="text-indigo-600">Fondo</span>
                </h2>
                
                <p class="mt-4 text-xl sm:text-2xl text-gray-600 px-4 mb-10">
                    Selecciona el escenario que acompañará tus aventuras y gana 20 xp y 5 gp.
                </p>

                <div id="backgroundsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center">
                    
                </div>

                <div class="mt-12">
                    <button id="confirmBackgroundButton" class="
                        px-10 py-4 bg-indigo-600 text-white font-bold text-lg rounded-full shadow-xl 
                        hover:bg-indigo-700 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 
                        focus:outline-none focus:ring-4 focus:ring-indigo-300 opacity-60 cursor-not-allowed" disabled>
                        Confirmar Fondo
                    </button>
                </div>

            </div>
        </div>

        <script>
            const urlParams = new URLSearchParams(window.location.search);
            const currentStudentId = urlParams.get('student_id');

            const backgrounds = [
                { id: 'fondo1', name: 'Bosque', imagePath: 'images/fondo/bosque.png' },
                { id: 'fondo2', name: 'Castillo', imagePath: 'images/fondo/castillo.png' },
                { id: 'fondo3', name: 'Templo', imagePath: 'images/fondo/templo.png' },
                { id: 'fondo4', name: 'Isla', imagePath: 'images/fondo/vistaalmar.png' },
                { id: 'fondo5', name: 'Era del Hielo', imagePath: 'images/fondo/eradelhielo.png' },
            ];

            const backgroundsContainer = document.getElementById('backgroundsContainer');
            const confirmBackgroundButton = document.getElementById('confirmBackgroundButton');
            let selectedBackgroundId = null;

            function renderBackgrounds() {
                backgroundsContainer.innerHTML = '';
                backgrounds.forEach(background => {
                    const card = document.createElement('div');
                    card.id = `bg-${background.id}`;
                    card.className = `
                        background-card relative cursor-pointer rounded-2xl overflow-hidden shadow-lg border-2 border-gray-200 
                        w-64 h-40 flex items-end justify-center p-4 text-white
                    `;
                    card.style.backgroundImage = `url('{{ asset('') }}${background.imagePath}')`;
                    card.style.backgroundSize = 'cover';
                    card.style.backgroundPosition = 'center';
                    card.style.textShadow = '1px 1px 3px rgba(0,0,0,0.8)';

                    card.innerHTML = `
                        <div class="absolute inset-0 bg-black opacity-30 group-hover:opacity-10 transition-opacity duration-200"></div>
                        <span class="relative z-10 text-lg font-semibold">${background.name}</span>
                    `;

                    card.addEventListener('click', () => {
                        document.querySelectorAll('.background-card').forEach(bCard => {
                            bCard.classList.remove('selected');
                        });
                        card.classList.add('selected');
                        selectedBackgroundId = background.id;
                        confirmBackgroundButton.disabled = false;
                        confirmBackgroundButton.classList.remove('opacity-60', 'cursor-not-allowed');
                    });

                    backgroundsContainer.appendChild(card);
                });
            }

            confirmBackgroundButton.addEventListener('click', async () => {
                if (selectedBackgroundId === null) {
                    console.error('Por favor, selecciona un fondo antes de confirmar.');
                    return;
                }

                const selectedBackground = backgrounds.find(bg => bg.id === selectedBackgroundId);
                if (!selectedBackground) {
                    console.error('Fondo seleccionado no encontrado en los datos.');
                    return;
                }

                console.log(`Intentando confirmar fondo: ${selectedBackground.name} (ID: ${selectedBackgroundId}) para el estudiante ID: ${currentStudentId}`);
                
                try {
                    const response = await fetch('{{ route('guardar.fondo.seleccionado') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ 
                            backgroundPath: selectedBackground.imagePath,
                            studentId: currentStudentId 
                        })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        console.log(data.message); 
                        if (data.redirect_to) {
                            window.location.href = data.redirect_to;
                        } else {
                            window.location.href = '{{ route('interfaz.estudiante') }}';
                        }
                    } else {
                        console.error('Error: ' + (data.message || 'No se pudo guardar la elección del fondo.'));
                        console.error('Error al guardar el fondo:', data);
                    }
                } catch (error) {
                    console.error('Error de red o del servidor al guardar el fondo:', error);
                    console.error('Ocurrió un error inesperado al conectar con el servidor.');
                }
            });

            document.addEventListener('DOMContentLoaded', () => {
                if (!currentStudentId) {
                    console.error('Error: No se encontró el ID del estudiante. Asegúrate de que se pasa correctamente desde la vista anterior.');
                }
                renderBackgrounds();
            });
        </script>
    </body>
    </html>
</x-app-layout>
