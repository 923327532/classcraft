<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Estudiante;
use App\Models\Nivel;

class UserController extends Controller
{
    public function guardarPersonaje(Request $request)
{
    $request->validate([
        'clase_personaje' => ['required', 'string', 'in:guerrero,guerrera,mago,maga,sanador,sanadora'],
    ]);

    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para seleccionar un personaje.');
    }

    $clase = $request->input('clase_personaje');

    // Asignar puntos según clase
    $puntos_vida = match ($clase) {
        'guerrero', 'guerrera' => 80,
        'mago', 'maga' => 30,
        'sanador', 'sanadora' => 50,
        default => 0,
    };

    $puntos_accion = match ($clase) {
        'guerrero', 'guerrera' => 30,
        'mago', 'maga' => 50,
        'sanador', 'sanadora' => 35,
        default => 0,
    };

    $nivelInicial = Nivel::where('numero_nivel', 1)->first();
    if (!$nivelInicial) {
        return redirect()->back()->with('error', 'El nivel inicial no está configurado en la base de datos.');
    }

    if (!$user->estudiante) {
        $user->estudiante()->create([
            'user_id' => $user->id,
            'id_clase' => null,
            'id_accesorio' => null, 
            'nivel_id' => $nivelInicial->id,
            'clase_personaje' => $clase,
            'puntos_experiencia' => 0,
            'puntos_vida' => $puntos_vida,
            'puntos_accion' => $puntos_accion,
            'puntos_oro' => 0,
        ]);
    } else {
        $estudiante = $user->estudiante;
        if (!empty($estudiante->clase_personaje)) {
            return redirect()->back()->with('error', 'Ya has elegido un personaje.');
        }
        $estudiante->clase_personaje = $clase;
        $estudiante->puntos_vida = $puntos_vida;
        $estudiante->puntos_accion = $puntos_accion;
        $estudiante->nivel_id = $nivelInicial->id;
        $estudiante->save();
    }

    return redirect()->route('confirmacion.personaje', ['personaje' => $clase])
                     ->with('status', '¡Personaje elegido y guardado con éxito!');
}

}