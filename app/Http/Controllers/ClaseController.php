<?php

namespace App\Http\Controllers;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Estudiante;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Maestro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class ClaseController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Obtener maestro relacionado
        $maestro = $user->maestro;
        if (!$maestro) {
            return response()->json([], 200); // O un error si quieres
        }

        // Buscar solo las clases del maestro
        $clases = Clase::where('id_maestro', $maestro->id_maestro)->get();

        // Retornar JSON para la vista JS
        return response()->json($clases);
    }

public function uploadStudentsExcel(Request $request, $id_clase)
{
    $request->validate([
        'file' => 'required|file|mimes:xlsx,xls'
    ]);

    try {
        $clase = Clase::findOrFail($id_clase);
        Excel::import(new StudentsImport($clase->id_clase), $request->file('file'));

        return response()->json(['success' => true, 'message' => 'Import successful']);
    } catch (\Exception $e) {
        Log::error('Error importando Excel: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Error importando el archivo.']);
    }
}






    public function searchStudentsByCode(Request $request)
    {
        $request->validate([
            'codigo_clase' => 'required|string'
        ]);

        $clase = Clase::where('codigo_clase', $request->codigo_clase)->with('estudiantes.user')->first();

        if(!$clase){
            return response()->json(['success' => false, 'message' => 'Clase no encontrada']);
        }

        return response()->json(['success' => true, 'students' => $clase->estudiantes]);
    }


public function store(Request $request)
{
    $request->validate([
        'nombre_clase' => 'required|string|max:255',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    ]);

    $user = $request->user();
    $maestro = $user->maestro;
    if (!$maestro) {
        return response()->json(['message' => 'No tienes perfil de maestro.'], 403);
    }

    try {
        $clase = Clase::create([
            'nombre_clase' => $request->nombre_clase,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'id_maestro' => $maestro->id_maestro,
        ]);
        return response()->json($clase, 201);
    } catch (\Exception $e) {
        Log::error('Error creando clase: '.$e->getMessage());
        return response()->json(['error' => 'Error al crear clase', 'details' => $e->getMessage()], 500);
    }
}


    public function destroy($id_clase)
    {
        $user = Auth::user();
        if ($user->role !== 'profesor') {
    return response()->json(['message' => 'Acceso denegado. Solo profesores pueden eliminar clases.'], 403);
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