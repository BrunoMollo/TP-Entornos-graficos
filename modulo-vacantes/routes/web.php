<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLlamadosController;
use App\Http\Controllers\JefeCatedraController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Administracion de llamados
Route::get('/admin/administrar_llamados', [AdminLlamadosController::class, 'admin_llamados'])->name('admin_llamados');
Route::get('/admin/nuevo_llamado', [AdminLlamadosController::class, 'create'])->name('nuevo_llamado');
Route::post('/admin/llamados/guardar', [AdminLlamadosController::class, 'store'])->name('guardar_llamado');

Route::get('/jefe_catedra/postulaciones', [JefeCatedraController::class, 'postulaciones'])->name('jefe_catedra.postulaciones');



Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/admin_usuarios', function () {
    return view('administrar_usuarios');
});

Route::get('/editar_usuario', function () {
    return view('editar_usuario');
});

Route::get('/sign_in', function () {
    return view('sign_in');
});

Route::get('/vacantes_abiertas', function () {
    return view('vacantes_abiertas');
});

Route::get('/vacantes_cerradas', function () {
    return view('vacantes_cerradas');
});

Route::get('/vacantes_mi_catedra', function () {
    return view('vacantes_mi_catedra');
});

Route::get('/postulaciones', function () {
    return view('postulaciones');
});

Route::get('/orden_de_merito', function () {
    return view('orden_de_merito');
});

Route::get('/nuevo_llamado', function () {
    return view('nuevo_llamado');
});

Route::get('/administrar_llamados', function () {
    return view('administrar_llamados');
});

Route::get('/calificacion', function () {
    return view('calificacion');
});

Route::get('/postulacion_vacante', function () {
    return view('postulacion_vacante');
});
