<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('registerUser');
});

Route::get('/admin_usuarios', function () {
    return view('administrar_usuarios');
});

Route::get('/sign_in', function () {
    return view('sign_in');
});

Route::get('/editar_usuario', function () {
    return view('editar_usuario');
});

Route::get('/nuevo_llamado', function () {
    return view('nuevo_llamado');
});

Route::get('/administrar_llamados', function () {
    return view('administrar_llamados');
});