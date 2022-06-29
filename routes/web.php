<?php

use App\Http\Controllers\EntradaCargoController;
use App\Http\Controllers\SalidaCargoController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\JustificacionController;
use App\Http\Controllers\RespuestaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*-----REGISTRO--------*/
Route::get('/registro', [App\Http\Controllers\EntradaController::class, 'mostrarRegistro'])->name('registro');

/* ---- AUTH ---- */

Route::view('/register', 'register');
Route::get('/register', [RegisterController::class, 'MostrarCargo'])->name('register');

/* ---- PERFIL ---- */

Route::view('/perfil', 'perfil');
Route::get('/perfil', [UserController::class, "Mostrar"])->name('perfil');
Route::post('/perfil-actualizar', [UserController::class, "Actualizar"])->name('perfil-actualizar');
Route::post('/perfil-actualizar-contraseña', [UserController::class, "ActualizarContraseña"])->name('perfil-actualizar-contraseña');

/* ---- CARGOS ---- */

Route::view('/cargos', 'cargo')->name('cargo');
Route::get('/cargos', [CargoController::class, "Mostrar"])->name('cargos');
Route::post('/cargos-crear', [CargoController::class, 'CrearCargo'])->name('cargos-crear');
Route::post('/cargo-activar', [CargoController::class, 'Activar'])->name('cargo-activar');
Route::post('/cargo-desactivar', [CargoController::class, 'Desactivar'])->name('cargo-desactivar');
Route::post('/cargo-editar', [CargoController::class, 'Editar'])->name('cargo-editar');

Route::post('/cargo-activar-home', [CargoController::class, 'ActivarH'])->name('cargo-activar-home');
Route::post('/cargo-desactivar-home', [CargoController::class, 'DesactivarH'])->name('cargo-desactivar-home');
Route::post('/cargo-editar-home', [CargoController::class, 'EditarH'])->name('cargo-editar-home');

/* ---- USUARIOS ---- */

Route::view('/usuarios', 'usuarios')->name('usuario');
Route::get('/usuarios', [UserController::class, "MostrarUsuarios"])->name('usuarios');
Route::post('/usuarios-crear', [UserController::class, 'Crear'])->name('usuarios-crear');
Route::post('/usuarios-activar', [UserController::class, 'Activar'])->name('usuarios-activar');
Route::post('/usuarios-desactivar', [UserController::class, 'Desactivar'])->name('usuarios-desactivar');
Route::post('/usuarios-editar', [UserController::class, 'Editar'])->name('usuarios-editar');

/* ---- ENTRADAS CARGO ---- */

Route::post('/entrada-cargo-crear', [EntradaCargoController::class, 'Crear'])->name('entrada-cargo-crear');
Route::post('/entrada-cargo-activar', [EntradaCargoController::class, 'Activar'])->name('entrada-cargo-activar');
Route::post('/entrada-cargo-desactivar', [EntradaCargoController::class, 'Desactivar'])->name('entrada-cargo-desactivar');
Route::post('/entrada-cargo-editar', [EntradaCargoController::class, 'Editar'])->name('entrada-cargo-editar');

/* ---- SALIDAS CARGO ---- */

Route::post('/salida-cargo-crear', [SalidaCargoController::class, 'Crear'])->name('salida-cargo-crear');
Route::post('/salida-cargo-activar', [SalidaCargoController::class, 'Activar'])->name('salida-cargo-activar');
Route::post('/salida-cargo-desactivar', [SalidaCargoController::class, 'Desactivar'])->name('salida-cargo-desactivar');
Route::post('/salida-cargo-editar', [SalidaCargoController::class, 'Editar'])->name('salida-cargo-editar');

/* ---- ENTRADAS ---- */

Route::post('/entrada-crear', [EntradaController::class, 'Crear'])->name('entrada-crear');
Route::post('/registro-date', [App\Http\Controllers\EntradaController::class, 'buscarRegistro'])->name('registro-date');

/* ---- SALIDAS ---- */

Route::post('/salida-crear', [SalidaController::class, 'Crear'])->name('salida-crear');

/* ---- JUSTIFICACION ---- */

Route::post('/justificacion-crear', [JustificacionController::class, 'Crear'])->name('justificacion-crear');
Route::post('/justificacion-editar', [JustificacionController::class, 'Editar'])->name('justificacion-editar');
Route::post('/justificacion-eliminar', [JustificacionController::class, 'Eliminar'])->name('justificacion-eliminar');

/* ---- JUSTIFICACION ADMIN ---- */
/* cambios */

Route::get('/justificaciones', [JustificacionController::class, 'Mostrar'])->name('justificacion-mostrar');
Route::post('/respuesta-crear', [RespuestaController::class, 'Aceptar'])->name('respuesta-crear');
