<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AmountController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SpecialtyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::view('/PoliticaPrivacidad', 'politica')->name("politica");
Route::get('/Cursos/Filter', [CourseController::class, 'coursefilter'])->name("coursefilter");
//Cursos por categorias
Route::view('/Info/ComoFunciona', 'cursos.comofunciona')->name('comofunciona');
Route::get('/Info/Profesores', [ProfesorController::class, 'infoprofesor'])->name("infoprofesor");
Route::get('/Cursos/Categorias', [CategoryController::class, 'showcategories'])->name("showcategories");
Route::get('/Cursos/AddFavorite/{id}', [CourseController::class, 'addfavorite'])->name("addfavorite");
Route::get('/Cursos/RemoveFavorite/{id}', [CourseController::class, 'removefavorite'])->name("removefavorite");
Route::get('/Cursos/Categoria/{id}/{slug?}', [CourseController::class, 'showbycategories']);
Route::get('/Cursos/Comprar/{id}/{slug?}', [MeetingController::class, 'comprar']);
Route::get('/Cursos/{id}/{slug?}', [CourseController::class, 'show']);
//Compra de curso
Route::put('/Meeting/Create/{publicacion}', [MeetingController::class, 'create'])->name("meeting.create");

//Paypal - Pagos
Route::get('/paypal/pay/{buy}', [PaymentController::class, 'payWithPayPal'])->name("paypal");
Route::get('/paypal/process', [PaymentController::class, 'process']);
Route::get('/paypal/cancel', [PaymentController::class, 'cancel']);
// Route::get('handle-payment', 'PaymentController@handlePayment')->name('make.payment');
// Route::get('cancel-payment', [PaymentController::class,'paymentCancel'])->name('cancel.payment');
// Route::get('payment-success', [PaymentController::class,'paymentSuccess'])->name('success.payment');

Route::view('/Inicio','welcome');
Route::view('/Login','login');
Route::get('/Logout', function () {
    //Borro la session
    session()->flush();
    if (!session()->has('Usuario')) {
        return redirect('/Login');
    }
});

Route::post('/Contacto/Contacto', [ContactController::class, 'contacto'])->name("contacto");

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
Route::view('Contacto','contacto');
Route::view('Nosotros','nosotros');

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
Route::get("/AdministrarProfesores/{user}/Clases", [ProfesorController::class, "clases"])->name("profesor.clases");
Route::post('/AdministrarProfesores/Habilitar/{user}', [ProfesorController::class, 'enable'])->name("profesor.enable");
Route::post('/AdministrarProfesores/Deshabilitar/{user}', [ProfesorController::class, 'disable'])->name("profesor.disable");
// Administración de Alumnos
Route::get('/AdministrarAlumnos', [AlumnoController::class, 'administrar']);
Route::get("/AdministrarAlumnos/{user}/Clases", [AlumnoController::class, "clases"])->name("alumno.clases");
Route::post('/AdministrarAlumnos/Habilitar/{user}', [AlumnoController::class, 'enable'])->name("alumno.enable");
Route::post('/AdministrarAlumnos/Deshabilitar/{user}', [AlumnoController::class, 'disable'])->name("alumno.disable");

//Cambio de datos de usuario
Route::put('/EditarPerfil/{user}', [UserController::class, 'update'])->name("user.update");
Route::get('/EditarPerfil', [UserController::class, 'edit'])->name("user.edit");

//Profesor
Route::get("/Profesor/MisPreferencias", [ProfesorController::class, "mispreferencias"]);

//Profesor
Route::get("/Alumno/MisFavoritos", [AlumnoController::class, "misfavoritos"]);

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

