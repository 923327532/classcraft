<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        ¡Bienvenido! Para continuar, por favor selecciona tu rol en la plataforma.
    </div>

    <form id="roleSelectionForm" method="POST" action="{{ route('save.role') }}">
        @csrf

        <div class="mt-4">
            <x-input-label for="role" :value="__('Selecciona tu rol')" />

            <div class="mt-2 flex justify-center gap-6">
                <div id="card_teacher" data-role="teacher"
                     class="role-card cursor-pointer border-2 border-gray-300 rounded-xl p-6 text-center shadow-md transition duration-300 ease-in-out w-48
                             hover:border-blue-500 hover:shadow-lg dark:border-gray-700 dark:hover:border-blue-600">
                    <img src="{{ asset('images/profesor.png') }}" alt="Profesor" class="mx-auto mb-4 h-24 w-24 object-contain">
                    <h2 class="text-xl font-bold mb-1 text-gray-800 dark:text-gray-200">Profesor</h2>
                </div>

                <div id="card_student" data-role="student"
                     class="role-card cursor-pointer border-2 border-gray-300 rounded-xl p-6 text-center shadow-md transition duration-300 ease-in-out w-48
                             hover:border-blue-500 hover:shadow-lg dark:border-gray-700 dark:hover:border-blue-600">
                    <img src="{{ asset('images/estudiante.png') }}" alt="Estudiante" class="mx-auto mb-4 h-24 w-24 object-contain">
                    <h2 class="text-xl font-bold mb-1 text-gray-800 dark:text-gray-200">Estudiante</h2>
                </div>
            </div>

            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleCards = document.querySelectorAll('.role-card');
            const roleSelectionForm = document.getElementById('roleSelectionForm');

            roleCards.forEach(card => {
                card.addEventListener('click', function() {
                    const selectedRole = this.dataset.role;

                    // Crear un input oculto temporal para enviar el rol
                    let hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'role';
                    hiddenInput.value = selectedRole;
                    roleSelectionForm.appendChild(hiddenInput);

                    // Enviar el formulario automáticamente
                    roleSelectionForm.submit();
                });
            });
        });
    </script>
</x-guest-layout>