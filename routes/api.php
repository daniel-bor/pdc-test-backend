<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\DepartamentoController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
});

// Rutas para PaisController
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'paises'
], function () {
    Route::get('/', [PaisController::class, 'index']);          // Obtener todos los registros
    Route::post('/', [PaisController::class, 'store']);         // Crear un nuevo registro
    Route::get('/{id}', [PaisController::class, 'show']);       // Obtener detalles de un registro
    Route::put('/{id}', [PaisController::class, 'update']);     // Actualizar un registro
    Route::delete('/{id}', [PaisController::class, 'destroy']); // Eliminar un registro
});


// Rutas para PaisController
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'departamentos'
], function () {
    Route::get('/', [DepartamentoController::class, 'index']);
    Route::post('/', [DepartamentoController::class, 'store']);
    Route::get('/{id}', [DepartamentoController::class, 'show']);
    Route::put('/{id}', [DepartamentoController::class, 'update']);
    Route::delete('/{id}', [DepartamentoController::class, 'destroy']);
});

// Grupo de Route para CRUD de Municipios
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'municipios'
], function () {
    Route::get('/', [MunicipioController::class, 'index']);
    Route::post('/', [MunicipioController::class, 'store']);
    Route::get('/{id}', [MunicipioController::class, 'show']);
    Route::put('/{id}', [MunicipioController::class, 'update']);
    Route::delete('/{id}', [MunicipioController::class, 'destroy']);
});

// Grupo de Route para CRUD de Empresas
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'empresas'
], function () {
    Route::get('/', [EmpresaController::class, 'index']);
    Route::post('/', [EmpresaController::class, 'store']);
    Route::get('/{id}', [EmpresaController::class, 'show']);
    Route::put('/{id}', [EmpresaController::class, 'update']);
    Route::delete('/{id}', [EmpresaController::class, 'destroy']);
});


// Grupo de Route para CRUD de Colaboradores
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'colaboradores'
], function () {
    Route::get('/', [ColaboradorController::class, 'index']);
    Route::post('/', [ColaboradorController::class, 'store']);
    Route::get('/{id}', [ColaboradorController::class, 'show']);
    Route::put('/{id}', [ColaboradorController::class, 'update']);
    Route::delete('/{id}', [ColaboradorController::class, 'destroy']);
});
