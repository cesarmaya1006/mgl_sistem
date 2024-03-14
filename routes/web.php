<?php

use App\Http\Controllers\Configuracion\ConfigMenuController;
use App\Http\Controllers\Seguridad\LoginController;
use Illuminate\Support\Facades\Artisan;
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
// Ruta Base de datos Migrar
Route::get('/migrar-bd', function () {echo Artisan::call('migrate:refresh');});
//********************************************************************************* */
Route::get('/', function () {return view('extranet.login.login');});
Route::get('home', function () {return view('extranet.login.login');})->name('home');

Route::post('/login', [LoginController::class, 'login'])->name('login_acceso');

// Rutas Login
Route::controller(LoginController::class)->group(function(){
    Route::get('logout','logout')->middleware('auth')->name('logout');
});
// Rutas protegidas
Route::prefix('dashboard')->middleware('auth')->group(function(){
    Route::get('', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::prefix('configuracion')->middleware('SuperAdmin')->group(function(){
        // Ruta Administrador del Sistema Menus
        // ------------------------------------------------------------------------------------
        Route::controller(ConfigMenuController::class)->prefix('menu')->group(function(){
            Route::get('', 'index')->name('menu.index');
            Route::get('crear', 'create')->name('menu.create');
            Route::get('editar/{id}', 'edit')->name('menu.edit');
            Route::post('guardar', 'store')->name('menu.store');
            Route::put('actualizar/{id}', 'update')->name('menu.update');
            Route::get('eliminar/{id}', 'destroy')->name('menu.destroy');
            Route::get('guardar-orden', 'guardarOrden')->name('menu.ordenar');
        });
        // ------------------------------------------------------------------------------------
    });
});
