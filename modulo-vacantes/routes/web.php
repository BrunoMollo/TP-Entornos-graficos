<?php

use App\Http\Controllers\PostulacionController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLlamadosController;
use App\Http\Controllers\JefeCatedraController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use Spatie\Permission\Models\Role;

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


// Manejo por defecto las rutas de Login y Register
Auth::routes();

// TEST PARA MAIL, BORRAR DESPUES
Route::get("/test/{dest}/{llamado}", [UserController::class,'test'])->name('test');

//Vista inicial (Vacantes abiertas)
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::redirect('/home', '/');
Route::redirect('/index', '/');
// Vista Vacantes Cerradas
Route::get('/vacantes_cerradas', [AdminLlamadosController::class, 'vacantes_cerradas'])->name('vacantes_cerradas');



// Administracion de llamados
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/administrar_llamados', [AdminLlamadosController::class, 'admin_llamados'])->name('admin_llamados');
    Route::get('/admin/nuevo_llamado', [AdminLlamadosController::class, 'create'])->name('nuevo_llamado');
    Route::post('/admin/llamados/guardar', [AdminLlamadosController::class, 'store'])->name('guardar_llamado');
    Route::get('/admin/llamados/editar/{id}', [AdminLlamadosController::class, 'edit'])->name('editar_llamado');
    Route::put('/admin/llamados/actualizar/{id}', [AdminLlamadosController::class, 'update'])->name('actualizar_llamado');
    Route::delete('/admin/llamados/eliminar/{id}', [AdminLlamadosController::class, 'destroy'])->name('eliminar_llamado');
    Route::delete('/admin/llamados/eliminarConPostulaciones/{id}', [AdminLlamadosController::class, 'destroyConPostulaciones'])->name('eliminar_llamado_con_postulaciones');
});


// Jefe de catedra y Admin
Route::middleware(['auth', 'role:jefe_catedra|admin'])->group(function () {
    Route::get('/{llamado}/postulaciones', [JefeCatedraController::class, 'postulaciones'])->name('postulaciones');
    Route::get('/descargar_curriculum/{postulacionId}', [PostulacionController::class, 'descargarCurriculum'])->name('descargar_curriculum');
  
});


// Jefe de catedra
Route::middleware(['auth', 'role:jefe_catedra'])->group(function () {
    Route::get('/vacantes_mi_catedra', [JefeCatedraController::class, 'vacantes_mi_catedra'])->name('vacantes_mi_catedra');
    //CALIFICAR POSTULACION
    Route::get('/calificar_postulacion/{postulacion}', [PostulacionController::class, 'calificar_postulacion'])->name('calificar_postulacion');
    Route::post('/editar_puntajes/{postulacion}', [PostulacionController::class, 'editar_puntajes'])->name('editar_puntajes');
    Route::post('/asignar_puntajes/{postulacion}', [PostulacionController::class, 'asignar_puntajes'])->name('asignar_puntajes');
    // ORDEN DE MERITO
    Route::get('/generar_orden_de_merito/{postulacionId}', [PostulacionController::class, 'generar_orden_de_merito'])->name('generar_orden_de_merito');
});

// Rutas para el CRUD de usuarios
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});
//Esto hace el resource 
// GET      /users                index       users.index
// GET      /users/create         create      users.create
// POST     /users                store       users.store
// GET      /users/{user}         show        users.show
// GET      /users/{user}/edit    edit        users.edit
// PUT      /users/{user}         update      users.update
// DELETE   /users/{user}         destroy     users.destroy



// Postulación user
 Route::middleware(['auth','role:postulante'])->group(function () {
     Route::resource('postulaciones', PostulacionController::class);
     Route::get('/postulaciones/create/{llamadoId}',[PostulacionController::class,'create'])->name('postulaciones.crear');

 });





// Route::get('/orden_de_merito', function () {
//     return view('orden_de_merito');
// });

// Route::get('/calificacion', function () {
//     return view('calificacion');
// });

// Route::get('/postulacion_vacante', function () {
//     return view('postulacion_vacante');
// });

