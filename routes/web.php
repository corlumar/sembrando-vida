<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

// =================================
// Dashboards protegidos por rol
// =================================

// Administrativo
use App\Http\Middleware\RoleMiddleware;

Route::middleware(['auth', RoleMiddleware::class . ':Administrativo'])->group(function () {

    Route::get('/admin/dashboard', fn() => view('dashboards.admin'))
        ->name('admin.dashboard');
});

// Coordinador Territorial
Route::middleware(['auth', 'role:Coordinador Territorial'])->group(function () {
    Route::get('/coordinador/dashboard', fn() => view('dashboards.coordinador'))
        ->name('coordinador.dashboard');
});

// Enlace Comercial
Route::middleware(['auth', 'role:Enlace Comercial'])->group(function () {
    Route::get('/enlace/dashboard', fn() => view('dashboards.enlace'))
        ->name('enlace.dashboard');
});

// Técnico
Route::middleware(['auth', 'role:Técnico'])->group(function () {
    Route::get('/tecnico/dashboard', fn() => view('dashboards.tecnico'))
        ->name('tecnico.dashboard');
});

// Sembrador
Route::middleware(['auth', 'role:Sembrador'])->group(function () {
    Route::get('/sembrador/dashboard', fn() => view('dashboards.sembrador'))
        ->name('sembrador.dashboard');
});

// =================================
// Ruta central de dashboard
// Redirige según el rol del usuario
// =================================
Route::get('/dashboard', function () {
    $user = Auth::user();

    switch ($user->role->name) {
        case 'Administrativo':
            return redirect()->route('admin.dashboard');
        case 'Coordinador Territorial':
            return redirect()->route('coordinador.dashboard');
        case 'Enlace Comercial':
            return redirect()->route('enlace.dashboard');
        case 'Técnico':
            return redirect()->route('tecnico.dashboard');
        case 'Sembrador':
            return redirect()->route('sembrador.dashboard');
        default:
            return view('welcome');
    }
})->middleware(['auth'])->name('dashboard');

Route::get('/profile', function () {
    return 'Sección de perfil (pendiente)';
})->name('profile.edit');

// =================================
// Auth (Breeze/Fortify se encarga)
// =================================
require __DIR__.'/auth.php';
