<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Maestro;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:estudiante,profesor'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role === 'estudiante') {
            $estudiante = new Estudiante([
                'user_id' => $user->id,
                'id_clase' => null,
                'id_accesorio' => null, 
                'nivel_id' => 1,
                'puntos_experiencia' => 0,
                'puntos_vida' => 100,
                'puntos_accion' => 0,
                'puntos_oro' => 0,
                'poder_seleccionado_id' => null,
            ]);
            $estudiante->save();
        } elseif ($request->role === 'profesor') {
            Maestro::create([
                'user_id' => $user->id,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        if ($user->role === 'estudiante') {
            return redirect()->route('estudiante.dashboard');
           } elseif ($user->role === 'profesor') {
            return redirect()->route('maestro.dashboard');
        }

        return redirect()->route('dashboard', absolute: false);
    }
}