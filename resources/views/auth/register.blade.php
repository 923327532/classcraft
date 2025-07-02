<x-guest-layout>
    <div class="max-w-md mx-auto mt-8 text-center">
        <h1 id="title-text" class="text-xl font-bold mb-6">Inscribirse como</h1>

        <div id="role-selection" class="flex justify-center gap-10 mb-6">
            <div id="select-teacher" class="cursor-pointer border-2 border-gray-300 rounded-xl p-6 hover:border-blue-500 text-center shadow-md transition duration-300 ease-in-out w-48">
                <img src="{{ asset('images/profesor.png') }}" alt="Maestro" class="mx-auto mb-4 h-24 w-24 object-contain">
                <h2 class="text-xl font-bold mb-1">Maestro</h2>
            </div>
            <div id="select-student" class="cursor-pointer border-2 border-gray-300 rounded-xl p-6 hover:border-blue-500 text-center shadow-md transition duration-300 ease-in-out w-48">
                <img src="{{ asset('images/estudiante.png') }}" alt="Estudiante" class="mx-auto mb-4 h-24 w-24 object-contain">
                <h2 class="text-xl font-bold mb-1">Estudiante</h2>
            </div>
        </div>
    </div>

    <h2 id="registering-as" class="text-2xl font-semibold text-center mb-6 hidden"></h2>

    <form method="POST" action="{{ route('register') }}" id="register-form" class="hidden max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg">
        @csrf

        <input type="hidden" name="role" id="role" value="">

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-4 max-w-md mx-auto">
        <div class="flex items-center justify-center text-sm text-gray-600 dark:text-gray-400">
            <span class="px-2 bg-white dark:bg-gray-900">O regístrate con</span>
        </div>

        <div class="flex justify-center mt-4 space-x-4">
            <a href="{{ route('socialite.redirect', 'google') }}"
               class="flex items-center justify-center w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.283 10.356h-8.327v3.451h4.792c-.446 2.193-2.313 3.453-4.792 3.453a5.27 5.27 0 01-5.279-5.28 5.27 5.27 0 015.279-5.279c1.259 0 2.397.447 3.29 1.153l2.207-2.207a8.237 8.237 0 00-5.497-2.128c-4.414 0-8 3.582-8 8s3.586 8 8 8c4.411 0 7.9-3.411 7.9-8 0-.565-.086-1.123-.217-1.656z"/>
                </svg>
                Google
            </a>
        </div>
    </div>

    <script>
        const studentBtn = document.getElementById('select-student');
        const teacherBtn = document.getElementById('select-teacher');
        const form = document.getElementById('register-form');
        const roleInput = document.getElementById('role');
        const roleSelection = document.getElementById('role-selection');
        const registeringAsText = document.getElementById('registering-as');
        const titleText = document.getElementById('title-text');

        function clearSelection() {
            studentBtn.classList.remove('border-blue-600');
            teacherBtn.classList.remove('border-blue-600');
        }

        function selectRole(role, selectedBtn) {
            roleInput.value = role;

            clearSelection();
            selectedBtn.classList.add('border-blue-600');

            roleSelection.style.display = 'none';
            titleText.style.display = 'none';

            registeringAsText.textContent = `Registrándose como ${role === 'estudiante' ? 'estudiante' : 'maestro'}`;
            registeringAsText.classList.remove('hidden');

            form.classList.remove('hidden');

            document.getElementById('name').focus();
        }

        studentBtn.addEventListener('click', () => {
            selectRole('estudiante', studentBtn);
        });

        teacherBtn.addEventListener('click', () => {
            selectRole('profesor', teacherBtn);
        });
    </script>
</x-guest-layout>
