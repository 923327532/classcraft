<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Poder;
use App\Models\Nivel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JuegoController extends Controller
{
    private function preparePowerSelectionData(?Estudiante $estudiante = null, string $clasePersonajeFiltro = null): array
    {
        if (!$estudiante) {
            $user = User::firstOrCreate(
                ['email' => 'test@example.com'],
                ['name' => 'Test User', 'password' => bcrypt('password')]
            );
            $nivel1 = Nivel::where('numero_nivel', 1)->first();
            if (!$nivel1) {
                $nivel1 = Nivel::create(['numero_nivel' => 1, 'xp_requerida' => 0]);
            }

            $estudiante = Estudiante::create([
                'user_id' => $user->id,
                'nivel_id' => $nivel1->id,
                'clase_personaje' => $clasePersonajeFiltro ? ucfirst($clasePersonajeFiltro) : 'Guerrero',
                'puntos_experiencia' => 0,
                'puntos_vida' => 100,
                'puntos_accion' => 50,
                'puntos_oro' => 10,
            ]);
            $estudiante->load('nivel');
        }

        $studentLevel = $estudiante->nivel->numero_nivel ?? 1;
        $personaje = $estudiante->clase_personaje ?? 'Personaje Desconocido';
        $currentStudentId = $estudiante->id_estudiante ?? null;

        $query = Poder::with('nivel');
        if ($clasePersonajeFiltro) {
            $query->whereRaw('LOWER(clase_personaje) = ?', [strtolower($clasePersonajeFiltro)]);
        }

        $query->whereHas('nivel', function ($q) {
            $q->where('numero_nivel', 1);
        });

        $poderesDb = $query->get()->map(function ($poder) {
            $nivelNumero = $poder->nivel ? $poder->nivel->numero_nivel : 1;
            return [
                'id' => $poder->id,
                'name' => $poder->nombre_poder,
                'imagePath' => asset($poder->ruta_imagen),
                'description' => $poder->descripcion,
                'type' => $this->getPowerTypeByLevel($nivelNumero),
                'levelRequired' => $nivelNumero,
                'ppCost' => $poder->costo_pp,
                'clase_personaje' => $poder->clase_personaje,
            ];
        });

        return [
            'personaje' => $personaje,
            'studentLevel' => $studentLevel,
            'powers' => $poderesDb->toJson(),
            'currentStudentId' => $currentStudentId,
        ];
    }

    public function guardarPersonaje(Request $request)
{
    $request->validate([
        'clase_personaje' => 'required|string',
    ]);

    $user = Auth::user();
    if (!$user) {
        return response()->json(['message' => 'Usuario no autenticado.'], 401);
    }

    $clase = ucfirst($request->input('clase_personaje'));
    $estudiante = $user->estudiante;

    $nivel1 = Nivel::where('numero_nivel', 1)->firstOrCreate(['numero_nivel' => 1], ['xp_requerida' => 0]);

    if (!$estudiante) {
        // Crear estudiante nuevo
        $estudiante = Estudiante::create([
            'user_id' => $user->id,
            'clase_personaje' => $clase,
            'nivel_id' => $nivel1->id,
            'puntos_experiencia' => 0,
            'puntos_vida' => 100,
            'puntos_accion' => 50,
            'puntos_oro' => 10,
        ]);
    } else {
        // Actualizar estudiante con nuevo personaje (si quieres permitir cambio)
        $estudiante->clase_personaje = $clase;
        $estudiante->nivel_id = $nivel1->id;
        $estudiante->puntos_experiencia = 0;  // O sumar experiencia?
        $estudiante->puntos_vida = 100;
        $estudiante->puntos_accion = 50;
        $estudiante->puntos_oro = 10;
        $estudiante->save();
    }

    return response()->json([
        'message' => 'Personaje seleccionado y guardado con éxito.',
        'redirect_to' => route('confirmacion.personaje', ['personaje' => $clase]),
    ]);
}

    

    public function guardarPoderSeleccionado(Request $request)
    {
        $request->validate([
            'powerId' => 'required|exists:poderes,id',
            'studentId' => 'nullable|exists:estudiantes,id_estudiante',
        ]);

        $user = Auth::user();
        $estudiante = $user->estudiante;

        if (!$estudiante) {
            return response()->json(['message' => 'Perfil de estudiante no encontrado para el usuario autenticado.'], 404);
        }

        if ($request->has('studentId') && $estudiante->id_estudiante != $request->input('studentId')) {
            return response()->json(['message' => 'Acceso no autorizado al perfil del estudiante.'], 403);
        }

        $poder = Poder::find($request->input('powerId'));

        if (!$poder) {
            return response()->json(['message' => 'Poder no encontrado.'], 404);
        }

        if ($estudiante->poder_seleccionado_id !== null) {
            return response()->json([
                'message' => 'Ya has seleccionado un poder. Redirigiendo a tu interfaz.',
                'redirect_to' => route('interfaz.estudiante')
            ], 400);
        }

        if (strtolower($estudiante->clase_personaje) !== strtolower($poder->clase_personaje)) {
            return response()->json(['message' => 'Este poder no es para tu clase de personaje.'], 400);
        }

        $poder->load('nivel');
        if (($estudiante->nivel->numero_nivel ?? 1) < ($poder->nivel->numero_nivel ?? 0)) {
            return response()->json(['message' => 'Necesitas un nivel más alto para este poder.'], 400);
        }

        $estudiante->poder_seleccionado_id = $request->input('powerId');
        $estudiante->puntos_experiencia += 20;
        $estudiante->puntos_oro += 5;
        $estudiante->save();

        return response()->json([
            'message' => '¡Poder seleccionado y guardado con éxito! Has ganado 20 XP y 5 GP.',
            'redirect_to' => route('seleccionar.fondo', ['student_id' => $estudiante->id_estudiante])
        ]);
    }

    public function usarPoder(Request $request)
    {
        $request->validate([
            'studentId' => 'required|exists:estudiantes,id_estudiante',
        ]);

        try {
            $estudiante = Estudiante::with('poderSeleccionado', 'nivel')->find($request->input('studentId'));

            if (!$estudiante || !$estudiante->poderSeleccionado) {
                return response()->json(['message' => 'No tienes un poder seleccionado o eres un estudiante no válido.'], 400);
            }

            $poder = $estudiante->poderSeleccionado;

            $message = 'Has usado el poder: ' . $poder->nombre_poder . '. Efecto: ' . $poder->descripcion;

            return response()->json(['message' => $message, 'powerName' => $poder->nombre_poder], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al usar el poder: ' . $e->getMessage()], 500);
        }
    }

    private function getPowerTypeByLevel($level)
    {
        if ($level === 1) {
            return 'basico';
        } elseif ($level === 2) {
            return 'intermedio';
        } elseif ($level === 3) {
            return 'avanzado';
        }
        return 'desconocido';
    }

    public function mostrarConfirmacionPersonaje(string $personaje)
    {
        $personaje = strtolower($personaje);

        $user = Auth::user();

        if (!$user || !$user->estudiante || empty($user->estudiante->clase_personaje)) {
            return redirect()->route('estudiante.dashboard')->with('error', 'Debes elegir un personaje primero para ver la confirmación.');
        }

        $userCharacter = strtolower($user->estudiante->clase_personaje);
        $allowedCharacters = [
            'guerrero' => ['guerrero', 'guerrera'],
            'mago' => ['mago', 'maga'],
            'sanador' => ['sanador', 'sanadora']
        ];

        $isCharacterMatch = false;
        foreach ($allowedCharacters as $baseChar => $variants) {
            if (in_array($userCharacter, $variants) && in_array($personaje, $variants)) {
                $isCharacterMatch = true;
                break;
            }
        }

        if (!$isCharacterMatch) {
            return redirect()->route('confirmacion.personaje', ['personaje' => $userCharacter])->with('error', 'No puedes ver la confirmación de otro personaje. Redirigido a tu confirmación.');
        }

        $data = $this->preparePowerSelectionData($user->estudiante, $userCharacter);
        $data['personaje'] = $personaje;

        $viewMap = [
            'guerrero' => 'confirmacion-guerreros',
            'guerrera' => 'confirmacion-guerreros',
            'mago' => 'confirmacion-magos',
            'maga' => 'confirmacion-magos',
            'sanador' => 'confirmacion-sanadores',
            'sanadora' => 'confirmacion-sanadores',
        ];

        if (isset($viewMap[$personaje])) {
            return view($viewMap[$personaje], $data);
        }

        abort(404);
    }

    public function showBackgroundSelection(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->estudiante) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para seleccionar un fondo.');
        }

        if (!empty($user->estudiante->selected_background_path)) {
            return redirect()->route('interfaz.estudiante')->with('info', 'Ya tienes un fondo seleccionado.');
        }

        $studentId = $user->estudiante->id_estudiante;

        $availableBackgrounds = [
            'assets/img/fondos/fondo_calle.jpg',
            'assets/img/fondos/fondo_bosque.jpg',
            'assets/img/fondos/fondo_ciudad.jpg',
            'assets/img/fondos/fondo_noche.jpg',
        ];

        return view('fondo', compact('studentId', 'availableBackgrounds'));
    }

    public function saveSelectedBackground(Request $request)
    {
        $request->validate([
            'backgroundPath' => 'required|string',
            'studentId' => 'nullable|exists:estudiantes,id_estudiante',
        ]);

        $user = Auth::user();
        $estudiante = $user->estudiante;

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado para el usuario autenticado.'], 404);
        }

        if ($request->has('studentId') && $estudiante->id_estudiante != $request->input('studentId')) {
            return response()->json(['message' => 'Acceso no autorizado al perfil del estudiante.'], 403);
        }

        if (!empty($estudiante->selected_background_path)) {
            return response()->json([
                'message' => 'Ya tienes un fondo seleccionado. Redirigiendo a tu interfaz.',
                'redirect_to' => route('interfaz.estudiante')
            ], 400);
        }

        $estudiante->selected_background_path = $request->backgroundPath;
        $estudiante->puntos_experiencia += 20;
        $estudiante->puntos_oro += 5;
        $estudiante->save();

        return response()->json([
            'message' => 'Fondo guardado exitosamente. Has ganado 20 XP y 5 GP.',
            'redirect_to' => route('interfaz.estudiante')
        ]);
    }

    public function mostrarInterfazEstudiante()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu interfaz.');
        }

        $estudiante = $user->estudiante;

        if (!$estudiante) {
            return redirect()->route('estudiante.dashboard')->with('error', 'Información de estudiante no disponible. Por favor, completa tu registro.');
        }

        if (empty($estudiante->clase_personaje)) {
            return redirect()->route('estudiante.dashboard')->with('info', 'Por favor, selecciona tu personaje para continuar.');
        }

        if (!$estudiante->poderSeleccionado) {
            return redirect()->route('confirmacion.personaje', ['personaje' => $estudiante->clase_personaje])->with('info', 'Por favor, selecciona tu poder.');
        }

        if (empty($estudiante->selected_background_path)) {
            return redirect()->route('seleccionar.fondo')->with('info', 'Por favor, selecciona tu fondo para tu interfaz.');
        }

        $estudiante->load('nivel', 'poderSeleccionado', 'user');

        return view('interfaz', compact('estudiante'));
    }

    public function mostrarMasPoderesPersonaje(Request $request, $clase_personaje)
    {
        $user = Auth::user();
        $estudiante = $user->estudiante;

        if (!$estudiante || strtolower($estudiante->clase_personaje) !== strtolower($clase_personaje)) {
            return redirect()->route('interfaz.estudiante')->with('error', 'Acceso no autorizado o clase de personaje incorrecta.');
        }

        $todosPoderes = Poder::whereRaw('LOWER(clase_personaje) = ?', [strtolower($clase_personaje)])
                             ->with('nivel')
                             ->join('niveles', 'poderes.nivel_id', '=', 'niveles.id')
                             ->orderBy('niveles.numero_nivel')
                             ->select('poderes.*')
                             ->get();

        $poderSeleccionado = $estudiante->poderSeleccionado;

        return view('maspoderes', compact('estudiante', 'todosPoderes', 'poderSeleccionado'));
    }

    public function seleccionarPoderNivel1(Request $request)
    {
        $request->validate([
            'poder_id' => 'required|exists:poderes,id',
        ]);

        $user = Auth::user();
        $estudiante = $user->estudiante;
        $poder = Poder::find($request->poder_id);

        if (!$estudiante || !$poder) {
            return back()->with('error', 'Estudiante o poder no encontrado.');
        }

        $poder->load('nivel');

        if (($poder->nivel->numero_nivel ?? 0) !== 1 || strtolower($poder->clase_personaje) !== strtolower($estudiante->clase_personaje)) {
            return back()->with('error', 'Solo puedes seleccionar poderes de Nivel 1 para tu clase de personaje.');
        }

        if ($estudiante->poder_seleccionado_id !== null) {
            return back()->with('error', 'Ya has seleccionado un poder. No puedes elegir otro.');
        }

        $estudiante->poder_seleccionado_id = $poder->id;
        $estudiante->puntos_oro += 5;
        $estudiante->save();

        return redirect()->route('mas.poderes.personaje', ['clase_personaje' => $estudiante->clase_personaje])->with('success', 'Poder de Nivel 1 seleccionado con éxito y has ganado 5 GP!');
    }
}