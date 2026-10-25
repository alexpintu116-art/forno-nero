<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\Admin\PizzaController as AdminPizzaController;
use App\Http\Controllers\AuthController;
use App\Models\Pizza;

// Página principal
Route::get('/', function () {
    $pizzas = Pizza::where('is_available', true)
        ->orderBy('name')
        ->take(3)
        ->get();

    return view('home', compact('pizzas'));
});

// Carta pública
Route::get('/carta', [PizzaController::class, 'index'])
    ->name('pizzas.index');

// Inicio y cierre de sesión
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// Administración de pizzas: requiere iniciar sesión
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

    // Activar o desactivar una pizza
    Route::patch(
        '/pizzas/{pizza}/availability',
        [AdminPizzaController::class, 'toggleAvailability']
    )->name('pizzas.toggle-availability');

    // Rutas CRUD de pizzas
    Route::resource('pizzas', AdminPizzaController::class)
    ->except(['show']);
});
