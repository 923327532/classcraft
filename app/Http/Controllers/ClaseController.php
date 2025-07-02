<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Estudiante;
use App\Models\Maestro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClaseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'estudiante') {
            if ($user->role === 'maestro') {
                return redirect()->route('maestro.dashboard')->with('error', 'Los maestros no acceden a esta sección de clases.');
            }
            return redirect()->route('dashboard')->with('error', 'Acceso denegado. Solo los estudiantes pueden ver esta sección.');
        }

        if (request()->expectsJson()) {
            $estudiante = $user->estudiante;

            if (!$estudiante) {
                return response()->json(['message' => 'Estudiante no encontrado.'], 404);
            }

            $clases = [];
            if ($estudiante->id_clase) {
                $claseUnida = Clase::find($estudiante->id_clase);
                if ($claseUnida) {
                    $clases[] = $claseUnida;
                }
            }

            return response()->json($clases);
        }

        return view('clases');
    }

    public function store(Request $request)
{
    $user = Auth::user();

    // Asegurarse que sea un maestro
    if ($user->role !== 'profesor') {
        return response()->json(['message' => 'Solo maestros pueden crear clases.'], 403);
    }

    $maestro = $user->maestro;

    if (!$maestro) {
        return response()->json(['message' => 'Maestro no encontrado.'], 404);
    }

    // Validar datos
    $validated = $request->validate([
        'nombre_clase' => 'required|string|max:255',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'nivel' => 'nullable|string|max:255',
    ]);

    // Agregar ID único y maestro a los datos
    $validated['id_clase'] = \Illuminate\Support\Str::uuid()->toString();
    $validated['id_maestro'] = $maestro->id_maestro;

    // Crear la clase
    $clase = Clase::create($validated);

    // Retornar respuesta JSON
    return response()->json($clase, 201);
}



    public function destroy($id_clase)
    {
        $user = Auth::user();
        if ($user->role !== 'maestro') {
            return response()->json(['message' => 'Acceso denegado. Solo maestros pueden eliminar clases.'], 403);
        }

        $maestro = $user->maestro;

        if (!$maestro) {
            return response()->json(['message' => 'Maestro no encontrado.'], 404);
        }

        $clase = Clase::where('id_clase', $id_clase)
                      ->where('id_maestro', $maestro->id_maestro)
                      ->first();

        if (!$clase) {
            return response()->json(['message' => 'Clase no encontrada o no autorizada.'], 404);
        }

        $clase->delete();

        return response()->json(['message' => 'Clase eliminada con éxito.'], 200);
    }

    public function joinClass(Request $request)
    {
        $request->validate([
            'class_id' => 'required|string|exists:clases,id_clase',
        ]);

        $classId = $request->input('class_id');
        $studentUser = Auth::user();

        if (!$studentUser->estudiante) {
            return response()->json(['success' => false, 'message' => 'Solo los estudiantes pueden unirse a clases.'], 403);
        }

        $estudiante = $studentUser->estudiante;

        if (!empty($estudiante->id_clase)) {
            return response()->json(['success' => false, 'message' => 'Ya estás unido a una clase.'], 409);
        }

        $clase = Clase::where('id_clase', $classId)->first();

        if (!$clase) {
            return response()->json(['success' => false, 'message' => 'Clase no encontrada.'], 404);
        }

        $estudiante->id_clase = $classId;
        $estudiante->save();

        $nombreMaestro = $clase->maestro->user->name ?? 'Profesor Desconocido';

        return response()->json([
            'success' => true,
            'message' => "Te has unido a la clase de {$clase->nombre_clase} de {$nombreMaestro}.",
            'class_name' => $clase->nombre_clase,
            'teacher_name' => $nombreMaestro
        ]);
    }
}