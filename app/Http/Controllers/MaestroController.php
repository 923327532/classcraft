<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Clase;
use Illuminate\Support\Facades\Auth;

class MaestroController extends Controller
{
    public function index()
{
    $user = auth()->user();

    // Obtener el maestro relacionado al usuario
    $maestro = $user->maestro;

    if (!$maestro) {
        // No encontró el maestro, quizá mostrar un mensaje o error
        return redirect()->route('dashboard')->with('error', 'No se encontró perfil de maestro para este usuario.');
    }

    // Buscar clases del maestro con su id_maestro
    $clases = Clase::where('id_maestro', $maestro->id_maestro)->get();

    return view('maestro.dashboard', compact('clases'));
}


    public function asignarAlumnoView($id_clase)
    {
        $clase = Clase::with(['estudiantes.user', 'estudiantes.nivel'])->where('id_clase', $id_clase)->firstOrFail();
        return view('maestro.asignar-alumno', compact('clase'));
    }

    public function searchStudents(Request $request)
    {
        $email = $request->input('email');
        
        $users = User::where('email', 'like', '%' . $email . '%')->get();
        $students = [];

        foreach ($users as $user) {
            if ($user->estudiante) {
                $students[] = [
                    'id_estudiante' => $user->estudiante->id_estudiante,
                    'name' => $user->name,
                    'email' => $user->email,
                    'clase_personaje' => $user->estudiante->clase_personaje,
                    'current_class_id' => $user->estudiante->id_clase,
                ];
            }
        }

        return response()->json(['students' => $students]);
    }

    public function addStudentToClass(Request $request, $id_clase)
    {
        $studentId = $request->input('student_id');

        $student = Estudiante::where('id_estudiante', $studentId)->first();

        if ($student) {
            if ($student->id_clase === $id_clase) {
                return response()->json(['success' => false, 'message' => 'El alumno ya está en esta clase.'], 409);
            }
            if (!empty($student->id_clase)) {
                return response()->json(['success' => false, 'message' => 'El alumno ya está en otra clase. Debe ser desasignado primero.'], 409);
            }

            $student->id_clase = $id_clase;
            $student->save();
            return response()->json(['success' => true, 'message' => 'Alumno agregado a la clase exitosamente.']);
        }

        return response()->json(['success' => false, 'message' => 'Alumno no encontrado.'], 404);
    }

    public function removeStudentFromClass(Request $request, $id_clase)
    {
        $studentId = $request->input('student_id');

        $student = Estudiante::where('id_estudiante', $studentId)->first();

        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Alumno no encontrado.'], 404);
        }

        if ($student->id_clase !== $id_clase) {
            return response()->json(['success' => false, 'message' => 'El alumno no pertenece a esta clase.'], 403);
        }

        $student->id_clase = null;
        $student->save();

        return response()->json(['success' => true, 'message' => 'Alumno removido de la clase exitosamente.']);
    }
}