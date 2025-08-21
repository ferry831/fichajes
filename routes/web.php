<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPerfil;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\Admin\EmpresaController as AdminEmpresaController;
use App\Http\Controllers\FichajeController;
use App\Http\Controllers\IncidenciaController;

// Página de inicio pública
Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect()->route('redirect');
})->name('dashboard');

// Redirección automática tras login según perfil
Route::middleware(['auth'])->get('/redirect', function () {
    return match (auth()->user()->perfil) {
        'admin' => redirect()->route('admin.empresas.index'),
        'empresa' => redirect()->route('empresa.dashboard'),
        'trabajador' => redirect()->route('trabajador.dashboard'),
        default => abort(403),
    };
})->name('redirect');

// Para el admin:
Route::prefix('admin')->name('admin.')
->middleware(['auth', CheckPerfil::class . ':admin'])
->group(function () {
    Route::resource('empresas', AdminEmpresaController::class);
});

// Ruta para cambiar el estado de una empresa (dar de alta/baja)
Route::patch('admin/empresas/{empresa}/toggle-active', [AdminEmpresaController::class, 'cambiarEstado'])
    ->name('admin.empresas.cambiarEstado');

// Panel empresa y gestión de recursos de empresa
Route::prefix('empresa')
    ->name('empresa.')
    ->middleware(['auth', CheckPerfil::class . ':empresa'])
    ->group(function () {
        // Dashboard empresa
        Route::get('/', function () {
            return view('empresa.dashboard');
        })->name('dashboard');


        // Información de la empresa (ver, editar, actualizar)
        Route::get('info', [EmpresaController::class, 'show'])->name('info.show');
        Route::get('info/editar', [EmpresaController::class, 'edit'])->name('info.edit');
        Route::put('info', [EmpresaController::class, 'update'])->name('info.update');

        // Gestión de trabajadores (RESTful, anidado)
        Route::resource('trabajadores', TrabajadorController::class);
        // Gestión de fichajes (RESTful, anidado)
        Route::get('fichajes', [FichajeController::class, 'indexEmpresa'])->name('fichajes.index');
        Route::get('fichajes/{trabajador}', [FichajeController::class, 'show'])->name('fichajes.show');

        // Incidencias
        Route::get('incidencias', [IncidenciaController::class, 'index'])->name('incidencias.index');
        Route::patch('incidencias/{incidencia}', [IncidenciaController::class, 'update'])->name('incidencias.update');
    });


// Panel trabajador
Route::middleware(['auth', CheckPerfil::class . ':trabajador'])->group(function () {
    Route::get('/trabajador', [TrabajadorController::class, 'dashboard'])->name('trabajador.dashboard');
});

Route::get('/trabajador/fichajes', [FichajeController::class, 'index'])->name('trabajador.fichajes.index');
Route::get('/trabajador/incidencias', [IncidenciaController::class, 'create'])->name('trabajador.incidencias.create');
Route::post('/trabajador/incidencias', [IncidenciaController::class, 'store'])->name('trabajador.incidencias.store');
// Rutas de fichajes para el trabajador

Route::post('/fichajes/entrada', [FichajeController::class, 'entrada'])->name('fichajes.entrada');
Route::post('/fichajes/salida/{id}', [FichajeController::class, 'salida'])->name('fichajes.salida');
Route::post('/fichajes/reanudar/{id}', [FichajeController::class, 'reanudar'])->name('fichajes.reanudar');
Route::post('/fichajes/pausa/{id}', [FichajeController::class, 'pausa'])->name('fichajes.pausa');

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
