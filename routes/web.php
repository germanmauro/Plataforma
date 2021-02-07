<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AmountController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\TimeRangeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;

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
//Cursos página de búsqueda y contratación
Route::get('/', [CourseController::class, 'listado'])->name("listado");
Route::get('/Cursos/Filter', [CourseController::class, 'coursefilter'])->name("coursefilter");
Route::get('/Cursos/{id}/{slug?}', [CourseController::class, 'show']);

Route::view('/Inicio','welcome');
Route::view('/Login','login');
Route::get('/Logout', function () {
    //Borro la session
    session()->flush();
    if (!session()->has('Usuario')) {
        return redirect('/Login');
    }
});

Route::view('/ResetPass','sendpass');

Route::post('/Login/Ingreso', [LoginController::class, 'ingreso']);
Route::post('/Login/Resetear', [LoginController::class, 'resetear']);

Route::get('/Usuarios', [UserController::class, 'index']);

// Registro
Route::get('/Registro/Alumno', [RegisterController::class, 'registroalumno']);
Route::post('/Registro/StoreAlumno', [RegisterController::class, 'storealumno']);
Route::get('/Registro/Profesor', [RegisterController::class, 'registroprofesor']);
Route::post('/Registro/StoreProfesor', [RegisterController::class, 'storeprofesor']);

Route::view('Registro/Terminos','registro.terminos');

Route::view('/RegistroExitoso', 'messages.successuser');
//Verificación email
Route::get('/ValidarEmail/{id}', [RegisterController::class, 'verifyemail']);
Route::view("/Validacion/Contrato", "registro.contrato");

// Categorías
Route::get('/Categoria', [CategoryController::class, 'index']);
Route::view("/Categoria/Create","categoria.create");
Route::post('/Categoria/Store', [CategoryController::class, 'store']);

Route::put('/Categoria/Update/{categoria}', [CategoryController::class, 'update'])->name("category.update");
Route::get('/Categoria/{categoria}/Edit', [CategoryController::class, 'edit'])->name("category.edit");

Route::put('/Categoria/Delete/{categoria}', [CategoryController::class, 'destroy'])->name("category.destroy");
Route::get('/Categoria/{categoria}/Delete', [CategoryController::class, 'delete'])->name("category.delete");

// Rangos horarios
Route::get('/RangoHorario', [TimeRangeController::class, 'index']);

Route::view("/RangoHorario/Create","rangohorario.create");
Route::post('/RangoHorario/Store', [TimeRangeController::class, 'store']);

Route::put('/RangoHorario/Update/{rangohorario}', [TimeRangeController::class, 'update'])->name("timerange.update");
Route::get('/RangoHorario/{rangohorario}/Edit', [TimeRangeController::class, 'edit'])->name("timerange.edit");

Route::put('/RangoHorario/Delete/{rangohorario}', [TimeRangeController::class, 'destroy'])->name("timerange.destroy");
Route::get('/RangoHorario/{rangohorario}/Delete', [TimeRangeController::class, 'delete'])->name("timerange.delete");

//Monto por hora
// Rangos horarios
Route::get('/Monto', [AmountController::class, 'index']);
Route::put('/Monto/Update/{monto}', [AmountController::class, 'update'])->name("amount.update");

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
Route::get("/AdministrarProfesores/{user}/Info", [ProfesorController::class,"info"])->name("profesor.info");
Route::post('/AdministrarProfesores/Habilitar/{user}', [ProfesorController::class, 'enable'])->name("profesor.enable");
Route::post('/AdministrarProfesores/Deshabilitar/{user}', [ProfesorController::class, 'disable'])->name("profesor.disable");
// Administración de Alumnos
Route::get('/AdministrarAlumnos', [AlumnoController::class, 'administrar']);

//Cambio de datos de usuario
Route::put('/EditarPerfil/{user}', [UserController::class, 'update'])->name("user.update");
Route::get('/EditarPerfil', [UserController::class, 'edit'])->name("user.edit");

//Profesor
Route::get("/Profesor/MisPreferencias", [ProfesorController::class, "mispreferencias"]);

//Subir contrato
Route::get("/Contrato/Carga", [UserController::class, 'cargacontract'])->name("contact.create");
Route::post('/Contrato/Store', [UserController::class, 'storecontract']);

//Publicaciones
Route::get('/Publicaciones', [PublicationController::class, 'index']);
Route::get("/Publicaciones/Create", [PublicationController::class, 'create'])->name("publication.create");
Route::post('/Publicaciones/Store', [PublicationController::class, 'store']);

Route::put('/Publicaciones/Update/{publicacion}', [PublicationController::class, 'update'])->name("publication.update");
Route::get('/Publicaciones/{publicacion}/Edit', [PublicationController::class, 'edit'])->name("publication.edit");

Route::post('/Publicaciones/DeleteImage/{publicacion}/{image}', [PublicationController::class, 'deleteimage'])->name("publication.deleteimage");

Route::post('/Publicaciones/Pausar/{publicacion}', [PublicationController::class, 'pause'])->name("publication.pause");
Route::post('/Publicaciones/Reactivar/{publicacion}', [PublicationController::class, 'reactivate'])->name("publication.reactivate");
Route::post('/Publicaciones/Delete/{publicacion}', [PublicationController::class, 'delete'])->name("publication.delete");

