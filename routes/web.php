<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\MaestroController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\AccesorioController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\ClaseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('estudiante.home'); // ✅ Esto está bien
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard/estudiante', [EstudianteController::class, 'index'])->name('estudiante.dashboard');
    Route::get('/dashboard/maestro', [MaestroController::class, 'index'])->name('maestro.dashboard');

    Route::get('/clases', [ClaseController::class, 'index'])->name('clases.index');
    Route::post('/clases', [ClaseController::class, 'store'])->name('clases.store');
    Route::delete('/clases/{id_clase}', [ClaseController::class, 'destroy'])->name('clases.destroy');
    Route::post('/clases/join', [ClaseController::class, 'joinClass'])->name('clases.join');

    Route::get('/maestro/asignar-alumno/{id_clase}', [MaestroController::class, 'asignarAlumnoView'])->name('maestro.asignar-alumno');
    Route::post('/api/students/search', [MaestroController::class, 'searchStudents'])->name('api.students.search');
    Route::post('/api/classes/{id_clase}/add-student', [MaestroController::class, 'addStudentToClass'])->name('api.classes.add-student');
    Route::post('/api/classes/{id_clase}/remove-student', [MaestroController::class, 'removeStudentFromClass'])->name('api.classes.remove-student');

    Route::get('/seleccion-poderes', [JuegoController::class, 'mostrarSeleccionPoderes'])->name('seleccion.poderes');
    Route::post('/seleccionar-poder', [JuegoController::class, 'guardarPoderSeleccionado'])->name('guardar.poder.seleccionado');
    Route::post('/usar-poder', [JuegoController::class, 'usarPoder'])->name('usar.poder');

    Route::get('/personaje/guerreros', function () {
        $user = Auth::user();
        if ($user && $user->estudiante && !empty($user->estudiante->clase_personaje)) {
            return redirect()->route('confirmacion.personaje', ['personaje' => $user->estudiante->clase_personaje])->with('info', 'Ya has elegido un personaje. No puedes volver a seleccionar.');
        }
        return view('personajes.guerrero');
    })->name('personaje.guerreros');

    Route::get('/personaje/magos', function () {
        $user = Auth::user();
        if ($user && $user->estudiante && !empty($user->estudiante->clase_personaje)) {
            return redirect()->route('confirmacion.personaje', ['personaje' => $user->estudiante->clase_personaje])->with('info', 'Ya has elegido un personaje. No puedes volver a seleccionar.');
        }
        return view('personajes.mago');
    })->name('personaje.magos');

    Route::get('/personaje/sanadores', function () {
        $user = Auth::user();
        if ($user && $user->estudiante && !empty($user->estudiante->clase_personaje)) {
            return redirect()->route('confirmacion.personaje', ['personaje' => $user->estudiante->clase_personaje])->with('info', 'Ya has elegido un personaje. No puedes volver a seleccionar.');
        }
        return view('personajes.sanador');
    })->name('personaje.sanadores');

    Route::post('/guardar-personaje', [UserController::class, 'guardarPersonaje'])->name('guardar.personaje');

    Route::get('/confirmacion-personaje/{personaje}', [JuegoController::class, 'mostrarConfirmacionPersonaje'])->name('confirmacion.personaje');

    Route::get('/interfaz-estudiante', [EstudianteController::class, 'mostrarInterfazEstudiante'])->name('interfaz.estudiante');

    Route::get('/sentencias', function () {
        $estudiante = Auth::user()->estudiante;
        return view('sentencias', compact('estudiante'));
    })->name('sentencias.index');

    Route::get('/misiones', function () {
        return view('misiones');
    })->name('misiones.index');

    Route::get('/seleccionar-fondo', [JuegoController::class, 'showBackgroundSelection'])->name('seleccionar.fondo');
    Route::post('/guardar-fondo-seleccionado', [JuegoController::class, 'saveSelectedBackground'])->name('guardar.fondo.seleccionado');

    Route::get('/personaje/{clase_personaje}/poderes', [JuegoController::class, 'mostrarMasPoderesPersonaje'])->name('mas.poderes.personaje');

    Route::post('/seleccionar-poder-nivel1', [JuegoController::class, 'seleccionarPoderNivel1'])->name('seleccionar.poder.nivel1');

    Route::get('/accesorios', [AccesorioController::class, 'index'])->name('accesorios');
    Route::post('/accesorios/comprar', [AccesorioController::class, 'comprar'])->name('accesorios.comprar');

    Route::get('/compra-confirmacion', [AccesorioController::class, 'showPurchaseConfirmation'])->name('accesorios.compra.confirmacion');

    Route::get('/api/estudiante/current-class', [EstudianteController::class, 'getCurrentClass'])->name('api.estudiante.current-class');
});

Route::get('/politica-privacidad', function () {
    return view('politica-privacidad');
})->name('politica.privacidad');

Route::get('/eliminacion-datos', function () {
    return view('eliminacion-datos');
})->name('eliminacion.datos');

Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);

Route::middleware(['auth'])->group(function () {
    Route::get('/select-role', [SocialiteController::class, 'showRoleSelectionForm'])->name('select.role');
    Route::post('/select-role', [SocialiteController::class, 'saveRole'])->name('save.role');
});


Route::post('/clases', [ClaseController::class, 'store'])->name('clases.store');
// web.php o api.php
Route::post('/maestro/clases/{id_clase}/upload-students', [ClaseController::class, 'uploadStudentsExcel'])->name('clases.uploadStudentsExcel');
Route::post('/maestro/clases/search-students', [ClaseController::class, 'searchStudentsByCode'])->name('clases.searchStudentsByCode');

require __DIR__.'/auth.php';