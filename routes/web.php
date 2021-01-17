<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SpecialtyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Storage;

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

Route::view('/','welcome');
Route::view('/Login','login');
Route::get('/Logout', function () {
    session()->forget('Usuario');
    if (!session()->has('Usuario')) {
        return redirect('/Login');
    }
});

Route::view('/ResetPass','resetpass');
Route::post('/Login/Ingreso', [LoginController::class, 'ingreso']);

Route::get('/Usuarios', [UserController::class, 'index']);
// Registro
Route::get('/Registro/Alumno', [RegisterController::class, 'registroalumno']);
Route::get('/Registro/Profesor', [RegisterController::class, 'registroprofesor']);
Route::post('/Registro/StoreAlumno', [RegisterController::class, 'storealumno']);
Route::post('/Registro/StoreProfesor', [RegisterController::class, 'storeprofesor']);
Route::view('Registro/Terminos','registro.terminos');

// Categorías
Route::get('/Categoria', [CategoryController::class, 'index']);
Route::view("/Categoria/Create","categoria.create");
Route::post('/Categoria/Store', [CategoryController::class, 'store']);

Route::put('/Categoria/Update/{categoria}', [CategoryController::class, 'update'])->name("category.update");
Route::get('/Categoria/{categoria}/Edit', [CategoryController::class, 'edit'])->name("category.edit");

Route::put('/Categoria/Delete/{categoria}', [CategoryController::class, 'destroy'])->name("category.destroy");
Route::get('/Categoria/{categoria}/Delete', [CategoryController::class, 'delete'])->name("category.delete");

// Especialidades
Route::get('/Especialidad', [SpecialtyController::class, 'index']);
Route::get("/Especialidad/Create",[SpecialtyController::class,'create'])->name("specialty.create");
Route::post('/Especialidad/Store', [SpecialtyController::class, 'store']);

Route::put('/Especialidad/Update/{especialidad}', [SpecialtyController::class, 'update'])->name("specialty.update");
Route::get('/Especialidad/{especialidad}/Edit', [SpecialtyController::class, 'edit'])->name("specialty.edit");

Route::put('/Especialidad/Delete/{especialidad}', [SpecialtyController::class, 'destroy'])->name("specialty.destroy");
Route::get('/Especialidad/{especialidad}/Delete', [SpecialtyController::class, 'delete'])->name("specialty.delete");

// Administración de Profesores
Route::get('/AdministrarProfesores', [ProfesorController::class, 'administrar']);
// Route::get('/AdministrarProfesores/{archivo}', function ($archivo) {
//     $public_path = public_path();
//     $url = $public_path . '/titulo/' . $archivo;
//     //verificamos si el archivo existe y lo retornamos
//     if (Storage::exists($archivo)) {
//         return response()->download($url);
//     }
//     //si no se encuentra lanzamos un error 404.
//     abort(404);
// });

// Administración de Alumnos
Route::get('/AdministrarAlumnos', [AlumnoController::class, 'administrar']);

//Cambio de datos de usuario
Route::put('/EditarPerfil/{user}', [UserController::class, 'update'])->name("user.update");
Route::get('/EditarPerfil', [UserController::class, 'edit'])->name("user.edit");