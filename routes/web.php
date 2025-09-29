<?php
use App\Http\Controllers\PeriodoEscolarController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;


#----------------------login-----------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/admin', function() {
    return view('layouts.admin');
})->name('admin.dashboard')->middleware('auth');


#------redireción---barra de navegación
#Route::get('/periodos', function() {
 #   return view('layouts.periodos');
#})->name('periodos');
// routes/web.php
Route::get('/admin', function () {
    return view('layouts.admin'); 
})->name('admin');





Route::get('/periodos', [PeriodoEscolarController::class, 'index'])->name('periodos');
Route::get('/periodos/create', [PeriodoEscolarController::class, 'create'])->name('periodos.create');
Route::post('/periodos', [PeriodoEscolarController::class, 'store'])->name('periodos.store');
Route::get('/periodos/{id}/edit', [PeriodoEscolarController::class, 'edit'])->name('periodos.edit');
Route::put('/periodos/{id}', [PeriodoEscolarController::class, 'update'])->name('periodos.update');
Route::delete('/periodos/{id}', [PeriodoEscolarController::class, 'destroy'])->name('periodos.destroy');
Route::resource('periodos', PeriodoEscolarController::class);



Route::get('/carreras', [CarreraController::class, 'index'])->name('carreras');
Route::get('/carreras/create', [CarreraController::class, 'create'])->name('carreras.create');
Route::post('/carreras', [CarreraController::class, 'store'])->name('carreras.store');
Route::get('/carreras/{id}/edit', [CarreraController::class, 'edit'])->name('carreras.edit');
Route::put('/carreras/{id}', [CarreraController::class, 'update'])->name('carreras.update');
Route::delete('/carreras/{id}', [CarreraController::class, 'destroy'])->name('carreras.destroy');
Route::resource('carreras', CarreraController::class);
#Route::get('/login', function () {
 #   return view('auth.login');
#})->name('login');