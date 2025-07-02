<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPerfil;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\Admin\EmpresaController as AdminEmpresaController;

// Página de inicio pública
Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Redirección automática tras login según perfil
Route::middleware(['auth'])->get('/redirect', function () {
    return match (auth()->user()->perfil) {
        'admin' => redirect()->route('admin.empresas.index'),
        'empresa' => redirect()->route('empresa.dashboard'),
        'trabajador' => redirect()->route('trabajador.dashboard'),
        default => abort(403),
    };
});



// Para el admin:
Route::prefix('admin')->name('admin.')
->middleware(['auth', CheckPerfil::class . ':admin'])
->group(function () {
    Route::resource('empresas', AdminEmpresaController::class);
});

// Para la empresa (jefe):
Route::resource('empresa', EmpresaController::class)
->middleware('auth', CheckPerfil::class . ':empresa');

Route::resource('trabajador', TrabajadorController::class)->middleware('auth');
Route::resource('empresa', EmpresaController::class)->middleware('auth');

// Panel empresa


Route::middleware(['auth', CheckPerfil::class . ':empresa'])->group(function () {
    Route::get('/empresa', function () {
        return view('empresa.dashboard');
    })->name('empresa.dashboard');
});

// Panel trabajador
Route::middleware(['auth', CheckPerfil::class . ':trabajador'])->group(function () {
    Route::get('/trabajador', function () {
        return view('trabajador.dashboard');
    })->name('trabajador.dashboard');
});

// Panel administrador
Route::middleware(['auth', CheckPerfil::class . ':admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Rutas de perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')->name('logout');

require __DIR__.'/auth.php';
