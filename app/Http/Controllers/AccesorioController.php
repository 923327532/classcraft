<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Estudiante;

class AccesorioController extends Controller
{
    public function index()
    {
        return view('accesorios');
    }

    public function comprar(Request $request)
    {
        $request->validate([
            'accesorio_id' => 'required|string',
        ]);

        $accesorioId = $request->input('accesorio_id');
        $costoAccesorio = 5;

        $user = Auth::user();

        if (!$user || !$user->estudiante) {
            return redirect()->back()->with('error', 'Debes ser un estudiante para comprar accesorios.');
        }

        $estudiante = $user->estudiante;

        if ($estudiante->puntos_oro < $costoAccesorio) {
            return redirect()->back()->with('error', 'No tienes suficientes Puntos de Oro (GP) para comprar este accesorio.');
        }

        $accesoriosDisponibles = [
            'acc_001' => ['nombre' => 'Collar de Poder', 'imagen' => 'images/accesorios/collar.png', 'descripcion' => 'Aumenta tu poder mágico en un 10%.'],
            'acc_002' => ['nombre' => 'Anillo de Agilidad', 'imagen' => 'images/accesorios/anillo.png', 'descripcion' => 'Mejora tu velocidad y evasión en un 5%.'],
            'acc_003' => ['nombre' => 'Capa Mágica', 'imagen' => 'images/accesorios/capa.png', 'descripcion' => 'Otorga resistencia a hechizos elementales.'],
            'acc_004' => ['nombre' => 'Botas Veloces', 'imagen' => 'images/accesorios/botas.png', 'descripcion' => 'Incrementa tu velocidad de movimiento en un 15%.'],
            'acc_005' => ['nombre' => 'Amuleto Protector', 'imagen' => 'images/accesorios/amuleto.png', 'descripcion' => 'Reduce el daño físico recibido en un 8%.'],
        ];

        $accesorioComprado = $accesoriosDisponibles[$accesorioId] ?? null;

        if (!$accesorioComprado) {
            return redirect()->back()->with('error', 'El accesorio seleccionado no es válido.');
        }

        $estudiante->id_accesorio = $accesorioId; 
        $estudiante->puntos_oro -= $costoAccesorio;

        try {
            $estudiante->save();
            
            return view('comprar', compact('accesorioComprado'))->with('success', '¡Has comprado el accesorio con éxito!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al procesar la compra: ' . $e->getMessage());
        }
    }
}