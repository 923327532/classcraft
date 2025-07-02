<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ClassCraft</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
    .hero-background {
        background-image: url('/images/fondo.gif');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .card {
        width: 280px;
        height: 320px;
        perspective: 1200px;
        cursor: pointer;
    }

    .card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        transform-style: preserve-3d;
        border-radius: 1rem;
    }

    .card:focus .card-inner,
    .card:hover .card-inner {
        transform: rotateY(180deg);
    }

    .card-front,
    .card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 1rem;
        backface-visibility: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .card-front {
        background-color: white;
        color: #333;
    }

    .card-back {
        color: white;
        transform: rotateY(180deg);
        text-align: center;
        font-size: 1rem;
        line-height: 1.5;
    }

    .card-1 .card-front {
        background-color: #D8B4E2;
        color: #4B2C65;
    }
    .card-1 .card-back {
        background-color: #C8A2C8;
    }
    .card-1 .feature-icon {
        color: #4B2C65;
    }

    .card-2 .card-front {
        background-color: #7AE1D9;
        color: #155E59;
    }
    .card-2 .card-back {
        background-color: #76D7C4;
    }
    .card-2 .feature-icon {
        color: #155E59;
    }

    .card-3 .card-front {
        background-color: #A3C4F3;
        color: #1D3C78;
    }
    .card-3 .card-back {
        background-color: #B0D4FF;
    }
    .card-3 .feature-icon {
        color: #1D3C78;
    }

    .feature-icon {
        font-size: 3.5rem;
        margin-bottom: 1rem;
    }
    </style>
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  rel="stylesheet"
/>
</head>
<body class="antialiased text-gray-900 bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
    <div class="min-h-screen flex flex-col">

        <!-- Header -->
        <header class="w-full bg-white dark:bg-gray-800 shadow-md py-4 px-6 md:px-12 flex justify-between items-center z-10">
            <a href="{{ url('/') }}" class="text-3xl font-extrabold gradient-text">ClassCraft</a>
            <nav class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300 transform hover:scale-105">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold rounded-lg shadow-md transition duration-300 transform hover:scale-105">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md transition duration-300 transform hover:scale-105">Registrarse</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </header>

        <!-- Hero -->
        <main class="flex-1 flex flex-col items-center justify-center text-center text-white hero-background py-20 px-6">
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight mb-6 drop-shadow-lg">Transforma Tu Aula en una Aventura Épica</h1>
            <p class="text-xl md:text-2xl mb-10 max-w-3xl drop-shadow-md">
                ClassCraft convierte el aprendizaje en un juego de rol, motivando a tus estudiantes y haciendo que la educación sea inolvidable.
            </p>
            <div class="flex space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold text-lg rounded-full shadow-lg transition duration-300 transform hover:scale-110">Ir a tu Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-purple-300 hover:bg-purple-400 text-gray-900 font-bold text-lg rounded-full shadow-lg transition duration-300 transform hover:scale-110">¡Comienza Tu Aventura!</a>
                    <a href="{{ route('login') }}" class="px-8 py-4 border-2 border-white text-white font-bold text-lg rounded-full shadow-lg transition duration-300 hover:bg-white hover:text-blue-700">Iniciar Sesión</a>
                @endauth
            </div>
        </main>

        <!-- ¿Qué es ClassCraft? -->
        <section class="py-20 px-6 md:px-12 bg-white dark:bg-gray-800">
            <div class="max-w-6xl mx-auto flex flex-col md:flex-row md:items-center md:space-x-12">
                <div class="md:w-7/12 text-left">
                <h2 class="text-4xl font-bold mb-6 gradient-text">¿Qué es ClassCraft?</h2>
                <p class="text-lg leading-relaxed mb-4">
                    ClassCraft es una plataforma educativa que gamifica la experiencia de aprendizaje, transformando las aulas en emocionantes juegos de rol...
                </p>
                <p class="text-lg leading-relaxed">
                    Motivamos a los estudiantes a través de un sistema de recompensas y consecuencias...
                </p>
                </div>
                <div class="md:w-5/12 flex justify-center">
                <img src="{{ asset('images/principal.png') }}" alt="ClassCraft Interface" class="rounded-xl shadow-2xl max-w-full h-auto max-h-96">
                </div>
            </div>
        </section>
        <!-- ¿Por qué elegir ClassCraft? -->
        
        <section class="py-20 px-6 md:px-12 bg-gray-100 dark:bg-gray-900">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="text-4xl font-bold mb-12 gradient-text">¿Por Qué Elegir ClassCraft?</h2>
                <div class="flex flex-col md:flex-row justify-center items-center gap-8">
                
                <!-- Tarjeta 1 - Motivación Extrema -->
                <div class="card card-1" tabindex="0" role="button" aria-pressed="false" aria-label="Motivación Extrema tarjeta">
                    <div class="card-inner">
                    <div class="card-front">
                        <i class="fa-solid fa-bolt feature-icon"></i>
                        <h3 class="text-2xl font-semibold">Motivación Extrema</h3>
                    </div>
                    <div class="card-back">
                        Convierte la apatía en entusiasmo. Los estudiantes se involucran activamente para progresar en sus personajes y equipos.
                    </div>
                    </div>
                </div>

                <!-- Tarjeta 2 - Gestión Simplificada -->
                <div class="card card-2" tabindex="0" role="button" aria-pressed="false" aria-label="Gestión Simplificada tarjeta">
                    <div class="card-inner">
                    <div class="card-front">
                        <i class="fa-solid fa-clipboard-check feature-icon"></i>
                        <h3 class="text-2xl font-semibold">Gestión Simplificada</h3>
                    </div>
                    <div class="card-back">
                        Facilita el seguimiento de tareas, comportamiento y progreso, ahorrándote tiempo y esfuerzo administrativo.
                    </div>
                    </div>
                </div>

                <!-- Tarjeta 3 - Colaboración y Comunidad -->
                <div class="card card-3" tabindex="0" role="button" aria-pressed="false" aria-label="Colaboración y Comunidad tarjeta">
                    <div class="card-inner">
                    <div class="card-front">
                        <i class="fa-solid fa-users feature-icon"></i>
                        <h3 class="text-2xl font-semibold">Colaboración y Comunidad</h3>
                    </div>
                    <div class="card-back">
                        Promueve el trabajo en equipo y el apoyo mutuo entre compañeros a través de misiones y poderes compartidos.
                    </div>
                    </div>
                </div>

                </div>
            </div>
            </section>

        <!-- Footer -->
        <footer class="bg-gray-900 dark:bg-gray-950 text-gray-300 py-10 px-6 md:px-12">
                <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-bold text-white mb-4">Sobre ClassCraft</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            ClassCraft es una iniciativa dedicada a revolucionar la educación a través de la gamificación. Creemos que aprender puede ser tan emocionante como jugar.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white mb-4">Enlaces Rápidos</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-blue-400 transition duration-300">Iniciar Sesión</a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-blue-400 transition duration-300">Registrarse</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white mb-4">Contáctanos</h3>
                        <p class="text-gray-400 text-sm">Email: info@classcraft.com</p>
                        <p class="text-gray-400 text-sm">Teléfono: +123 456 7890</p>
                        <p class="text-gray-400 text-sm">Dirección: 123 Calle de la Aventura, Ciudad Gamer, Mundo Virtual</p>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-10 pt-8 text-center text-gray-500 text-sm">
                    &copy; {{ date('Y') }} ClassCraft. Todos los derechos reservados.
                </div>
            </footer>

    </div>
    <script>
        document.querySelectorAll('.card').forEach(card => {
  card.addEventListener('click', () => {
    card.classList.toggle('flipped');
  });
  card.addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      card.classList.toggle('flipped');
    }
  });
});

    </script>
</body>
</html>

