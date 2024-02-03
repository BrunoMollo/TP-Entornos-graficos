<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLlamadosController;
use App\Http\Controllers\JefeCatedraController;
use App\Http\Controllers\UserController;

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
Route::get('/admin/llamados/editar/{id}', [AdminLlamadosController::class, 'edit'])->name('editar_llamado');
Route::put('/admin/llamados/actualizar/{id}', [AdminLlamadosController::class, 'update'])->name('actualizar_llamado');
Route::delete('/admin/llamados/eliminar/{id}', [AdminLlamadosController::class, 'destroy'])->name('eliminar_llamado');

Route::get('/jefe_catedra/postulaciones', [JefeCatedraController::class, 'postulaciones'])->name('jefe_catedra.postulaciones');


// Rutas para el CRUD de usuarios
Route::resource('users', UserController::class);

//Esto hace el resource 
// GET      /users                index       users.index
// GET      /users/create         create      users.create
// POST     /users                store       users.store
// GET      /users/{user}         show        users.show
// GET      /users/{user}/edit    edit        users.edit
// PUT      /users/{user}         update      users.update
// DELETE   /users/{user}         destroy     users.destroy



Route::get('/', function () {    
    return view('index');
});

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/admin_usuarios', function () {
//     return view('administrar_usuarios');
// });

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

Route::get('/calificacion', function () {
    return view('calificacion');
});

Route::get('/postulacion_vacante', function () {
    return view('postulacion_vacante');
});

