<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'maestro') {
            return redirect()->intended(route('maestro.dashboard'));
        }

        if ($user->role === 'estudiante') {
            if (empty($user->estudiante)) {
                return redirect()->intended(route('estudiante.dashboard'));
            }
            if (empty($user->estudiante->clase_personaje)) {
                return redirect()->intended(route('estudiante.dashboard'));
            }
            if (!$user->estudiante->poderSeleccionado) {
                return redirect()->intended(route('seleccion.poderes'));
            }
            if (empty($user->estudiante->selected_background_path)) {
                return redirect()->intended(route('seleccionar.fondo', ['student_id' => $user->estudiante->id_estudiante]));
            }
            return redirect()->intended(route('interfaz.estudiante'));
        }

        if (empty($user->role)) {
            return redirect()->intended(route('select.role'));
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}