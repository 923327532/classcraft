<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Auth;
use App\Models\Nivel;
use App\Models\Clase;

class EstudianteController extends Controller
{
    public function index()
{
    $estudiante = Estudiante::where('user_id', auth()->id())->first();

    return view('estudiante.home', compact('estudiante'));
}

    public function mostrarInterfazEstudiante()
    {
        $estudiante = Estudiante::where('user_id', Auth::id())
                                   ->with(['user', 'poderSeleccionado', 'nivel'])
                                   ->first();

        if ($estudiante) {
            switch (strtolower($estudiante->clase_personaje)) {
                case 'sanador':
                    $estudiante->max_hp = 50;
                    $estudiante->max_ap = 35;
                    break;
                case 'guerrero':
                    $estudiante->max_hp = 80;
                    $estudiante->max_ap = 30;
                    break;
                case 'mago':
                    $estudiante->max_hp = 30;
                    $estudiante->max_ap = 50;
                    break;
                default:
                    $estudiante->max_hp = 50;
                    $estudiante->max_ap = 35;
                    break;
            }

            $estudiante->puntos_vida = $estudiante->max_hp;
            $estudiante->puntos_accion = $estudiante->max_ap;

            $estudiante->poderes_disponibles = floor(($estudiante->puntos_cristal ?? 0) / 10);
            
            if ($estudiante->clase_personaje && $estudiante->selected_background_path) {
                $clasePersonajeLower = strtolower($estudiante->clase_personaje);
                $backgroundFilename = $estudiante->selected_background_path;
                
                $estudiante->combined_image_path = "images/fondo/{$clasePersonajeLower}/{$backgroundFilename}";
            } else {
                $estudiante->combined_image_path = 'images/default_combined_image.png';
            }
        }

        return view('interfaz', compact('estudiante'));
    }

    public function getCurrentClass()
    {
        $user = Auth::user();
        if ($user->estudiante && $user->estudiante->clase) {
            $clase = $user->estudiante->clase;
            $teacherName = $clase->maestro->user->name ?? 'Profesor Desconocido';
            return response()->json([
                'success' => true,
                'class_info' => [
                    'class_name' => $clase->nombre_clase,
                    'teacher_name' => $teacherName,
                    'class_id' => $clase->id_clase,
                ]
            ]);
        }
        return response()->json(['success' => false, 'message' => 'No estás unido a ninguna clase.']);
    }
}
