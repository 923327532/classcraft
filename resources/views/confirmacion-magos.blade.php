<x-app-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCraft - Mago</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .power-card.selected {
            border-color: #4F46E5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.5);
        }
        .power-card {
            transition: all 0.2s ease-in-out;
        }
        .power-card:hover:not(.selected):not(.opacity-60) {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col bg-white">

        <main class="flex-grow flex items-center justify-center p-6 sm:p-10 lg:p-16">
            <div class="flex flex-col md:flex-row items-center md:items-center justify-center gap-6 w-full max-w-6xl mx-auto">
                
                <div id="powerSelectionCard" class="bg-gray-50 rounded-2xl shadow-2xl p-10 sm:p-12 md:p-16 text-center w-full md:w-3/5 lg:w-3/5 transform transition-all duration-500 hover:scale-[1.01] hover:shadow-3xl border border-gray-100 flex-shrink-0">
                    
                    <h3 class="text-5xl sm:text-5xl font-extrabold text-gray-800 leading-tight mb-6">
                        Has elegido a: <span class="text-black-600">{{ ucfirst($personaje) }}</span>
                    </h3>
                    
                    <p class="mt-4 text-xl sm:text-2xl text-gray-600 px-4">
                        ¡Una elección poderosa! Ahora elige tu poder y gana 20 xp y 5 gp:
                    </p>

                    <div class="w-24 h-1 bg-indigo-500 rounded-full mx-auto mt-8 opacity-75"></div>

                    <div id="powersContainer" class="mt-10 text-left">
                    </div>

                </div>

                <div id="powerDetailsCard" class="bg-purple-50 rounded-2xl shadow-2xl p-6 sm:p-8 md:p-10 text-center w-full md:w-2/5 lg:w-2/5 border border-purple-200 transition-opacity duration-500 flex flex-col justify-between items-center flex-grow h-auto md:min-h-[400px] opacity-0 pointer-events-none">
                    <p class="text-xl text-gray-600">Selecciona un poder para ver sus detalles aquí.</p>
                </div>

            </div>
        </main>
    </div>

    <script>
        const studentLevel = {{ $studentLevel ?? 1 }}; 
        const powers = JSON.parse(@json($powers ?? [])); 

        const currentStudentId = {{ $currentStudentId ?? 'null' }}; 

        const powersContainer = document.getElementById('powersContainer');
        const powerDetailsCard = document.getElementById('powerDetailsCard');
        let selectedPowerId = null;

        const powerImagesBaseUrl = "{{ asset('images/powers/magos') }}/"; 

        document.addEventListener('error', function (e) {
            if (e.target.tagName === 'IMG' && e.target.classList.contains('power-icon')) {
                e.target.src = 'https://placehold.co/60x60/CCCCCC/666666?text=Error';
            }
        }, true);

        const powerCategories = {
            'basico': { title: 'Poderes Básicos (Nivel 1)', minLevelToShow: 1 },
            'intermedio': { title: 'Poderes Intermedios (Nivel 2)', minLevelToShow: 2 },
            'avanzado': { title: 'Poderes Avanzados (Nivel 3)', minLevelToShow: 3 }
        };

        const groupedPowers = powers.reduce((acc, power) => {
            if (!acc[power.type]) {
                acc[power.type] = [];
            }
            acc[power.type].push(power);
            return acc;
        }, {});

        function displayPowerDetails(power) {
            selectedPowerId = power.id;

            document.querySelectorAll('.power-card').forEach(card => {
                card.classList.remove('selected');
            });
            const currentPowerCard = document.getElementById(`power-${power.id}`);
            if (currentPowerCard) {
                currentPowerCard.classList.add('selected');
            }

            powerDetailsCard.innerHTML = `
                <img src="${powerImagesBaseUrl}${power.imagePath.split('/').pop()}" alt="${power.name}" class="w-24 h-24 mb-4 rounded-full object-cover mx-auto border-4 border-purple-400 power-icon" onerror="this.onerror=null;this.src='https://placehold.co/100x100/CCCCCC/666666?text=Error';">
                <h4 class="text-3xl font-bold text-purple-900 mb-2">${power.name}</h4>
                <p class="text-lg text-gray-700 mb-4">${power.description}</p>
                <p class="text-md text-purple-600">- ${power.ppCost} AP</p>
                <button id="confirmSelectionButton" class="mt-8 px-8 py-3 bg-purple-600 text-white font-bold rounded-full shadow-lg hover:bg-purple-700 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-purple-300">Confirmar Elección</button>
            `;
            powerDetailsCard.classList.remove('opacity-0', 'pointer-events-none');
            powerDetailsCard.classList.add('opacity-100');
            
            const confirmButton = document.getElementById('confirmSelectionButton');
            if (confirmButton) {
                confirmButton.addEventListener('click', async () => {
                    if (selectedPowerId === null) {
                        console.error('Por favor, selecciona un poder antes de confirmar.');
                        return;
                    }
                    console.log(`Intentando confirmar poder: ${power.name} (ID: ${selectedPowerId}) para el estudiante ID: ${currentStudentId}`);
                    
                    try {
                        const response = await fetch('{{ route('guardar.poder.seleccionado') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ 
                                powerId: selectedPowerId,
                                studentId: currentStudentId 
                            })
                        });

                        const data = await response.json();

                        if (response.ok) {
                            console.log(data.message); 
                            if (data.redirect_to) {
                                window.location.href = data.redirect_to;
                            } else {
                                window.location.href = `{{ route('seleccionar.fondo') }}?student_id=${currentStudentId}`;
                            }
                        } else {
                            console.error('Error: ' + (data.message || 'No se pudo guardar la elección.'));
                            console.error('Error al guardar el poder:', data);
                        }
                    } catch (error) {
                        console.error('Error de red o del servidor:', error);
                        console.error('Ocurrió un error inesperado al conectar con el servidor.');
                    }
                });
            }
        }

        function renderPowers() {
            powersContainer.innerHTML = ''; 

            for (const type in powerCategories) {
                const categoryInfo = powerCategories[type];

                if (studentLevel >= categoryInfo.minLevelToShow && groupedPowers[type] && groupedPowers[type].length > 0) {
                    const sectionTitle = document.createElement('h4');
                    sectionTitle.className = 'text-2xl font-bold text-gray-800 mb-4 mt-6 first:mt-0';
                    sectionTitle.textContent = categoryInfo.title;
                    powersContainer.appendChild(sectionTitle);

                    const grid = document.createElement('div');
                    grid.className = 'grid grid-cols-2 sm:grid-cols-3 gap-4 mb-8'; 

                    groupedPowers[type].forEach(power => {
                        const isLocked = studentLevel < power.levelRequired;

                        const powerCard = document.createElement('div');
                        powerCard.id = `power-${power.id}`;
                        powerCard.className = `
                            power-card group relative flex flex-col items-center justify-center p-4 rounded-xl 
                            border transition-all duration-200 text-center
                            ${isLocked 
                                ? 'border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed opacity-60' 
                                : 'border-purple-300 bg-purple-50 text-purple-800 cursor-pointer hover:bg-purple-100 hover:shadow-md'
                            }
                        `;
                        powerCard.dataset.locked = isLocked; 
                        
                        powerCard.innerHTML = `
                            <img src="${powerImagesBaseUrl}${power.imagePath.split('/').pop()}" alt="${power.name}" class="w-16 h-16 mb-2 rounded-full object-cover mx-auto power-icon" onerror="this.onerror=null;this.src='https://placehold.co/60x60/CCCCCC/666666?text=Error';">
                            <span class="font-semibold text-sm sm:text-base">${power.name}</span>
                            ${isLocked ? `
                                <div class="lock-overlay absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center rounded-xl transition-opacity duration-300">
                                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v2H5a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2h-1V6a4 4 0 00-4-4zm2 6V6a2 2 0 10-4 0v2h4z" clip-rule="evenodd"></path></svg>
                                </div>
                            ` : ''}
                        `;
                        
                        if (!isLocked) {
                            powerCard.addEventListener('click', () => {
                                displayPowerDetails(power);
                                console.log(`¡Poder seleccionado: ${power.name}!`);
                            });
                        }

                        grid.appendChild(powerCard);
                    });
                    powersContainer.appendChild(grid);
                }
            }
        }

        document.addEventListener('DOMContentLoaded', renderPowers);
    </script>
</body>
</html>
</x-app-layout>
