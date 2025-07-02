<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        if ($provider !== 'google') {
            abort(404);
        }
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        if ($provider !== 'google') {
            abort(404);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            Log::error("Error al autenticarse con {$provider}: " . $e->getMessage());
            return redirect('/login')->withErrors(['social_login' => 'Error al autenticarse con ' . ucfirst($provider) . '. Por favor, inténtalo de nuevo.']);
        }

        $user = User::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->first();

        if (!$user) {
            $user = User::where('email', $socialUser->getEmail())->first();
        }

        if ($user) {
            $user->update([
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
            ]);

            Auth::login($user, true);

            if (empty($user->role)) {
                return redirect()->route('select.role');
            } else {
                if ($user->role === 'student') {
                    return redirect()->route('estudiante.dashboard');
                } elseif ($user->role === 'teacher') {
                    return redirect()->route('maestro.dashboard');
                }
                return redirect()->intended('/dashboard');
            }

        } else {
            if (User::where('email', $socialUser->getEmail())->exists()) {
                return redirect('/login')->withErrors(['email' => 'Ya existe una cuenta con este correo electrónico. Por favor, inicia sesión de la forma habitual.']);
            }

            $newUser = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? $socialUser->getEmail(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(20)),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'email_verified_at' => now(),
                'role' => null,
            ]);

            Auth::login($newUser, true);

            return redirect()->route('select.role');
        }
    }

    public function showRoleSelectionForm()
    {
        $user = Auth::user();
        if ($user && $user->role) {
            if ($user->role === 'student') {
                return redirect()->route('estudiante.dashboard');
            } elseif ($user->role === 'teacher') {
                return redirect()->route('maestro.dashboard');
            }
            return redirect()->intended('/dashboard');
        }
        return view('auth.select-role');
    }

    public function saveRole(Request $request)
    {
        $request->validate([
            'role' => ['required', 'string', 'in:student,teacher'],
        ]);

        $user = Auth::user();
        $role = $request->input('role');

        if ($user && $user->role === null) {
            $user->role = $role;
            $user->save();

            if ($user->role === 'student') {
                Estudiante::firstOrCreate(
                    ['user_id' => $user->id],
                    [
                        'nivel_id' => 1,
                        'puntos_vida' => 50,
                        'max_hp' => 50,
                        'puntos_accion' => 35,
                        'max_ap' => 35,
                        'puntos_experiencia' => 0,
                        'xp_to_next_level' => 100,
                        'puntos_oro' => 0,
                        'puntos_cristal' => 0,
                        'poderes_disponibles' => 0,
                    ]
                );
            }

            if ($role === 'student') {
                return redirect()->route('estudiante.dashboard');
            } elseif ($role === 'teacher') {
                return redirect()->route('maestro.dashboard');
            }
        }
        return redirect()->intended('/dashboard');
    }
}