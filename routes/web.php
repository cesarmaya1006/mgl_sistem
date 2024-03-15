<?php

use App\Http\Controllers\Configuracion\ConfigEmpresaController;
use App\Http\Controllers\Configuracion\ConfigMenuController;
use App\Http\Controllers\Configuracion\ConfigMenuRolController;
use App\Http\Controllers\Configuracion\ConfigRolController;
use App\Http\Controllers\Empresa\EmpresaAreaController;
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
Route::get('/migrar-bd', function () {
    echo Artisan::call('migrate:refresh');
    echo Artisan::call('db:seed');
});
//********************************************************************************* */
Route::get('/', function () {
    return view('extranet.login.login');
});
Route::get('home', function () {
    return view('extranet.login.login');
})->name('home');

Route::post('/login', [LoginController::class, 'login'])->name('login_acceso');

// Rutas Login
Route::controller(LoginController::class)->group(function () {
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});
// Rutas protegidas
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::prefix('configuracion_sis')->middleware('SuperAdmin')->group(function () {
        // Ruta Administrador del Sistema Menus
        // ------------------------------------------------------------------------------------
        Route::controller(ConfigMenuController::class)->prefix('menu')->group(function () {
            Route::get('', 'index')->name('menu.index');
            Route::get('crear', 'create')->name('menu.create');
            Route::get('editar/{id}', 'edit')->name('menu.edit');
            Route::post('guardar', 'store')->name('menu.store');
            Route::put('actualizar/{id}', 'update')->name('menu.update');
            Route::get('eliminar/{id}', 'destroy')->name('menu.destroy');
            Route::get('guardar-orden', 'guardarOrden')->name('menu.ordenar');
        });
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Roles
        Route::controller(ConfigRolController::class)->prefix('rol')->group(function () {
            Route::get('', 'index')->name('rol.index');
            Route::get('crear', 'create')->name('rol.create');
            Route::get('editar/{id}', 'edit')->name('rol.edit');
            Route::post('guardar', 'store')->name('rol.store');
            Route::put('actualizar/{id}', 'update')->name('rol.update');
            Route::delete('eliminar/{id}', 'destroy')->name('rol.destroy');
        });
        // ----------------------------------------------------------------------------------------
        /* Ruta Administrador del Sistema Menu Rol*/
        Route::controller(ConfigMenuRolController::class)->prefix('permisos_menus_rol')->group(function () {
            Route::get('', 'index')->name('menu.rol.index');
            Route::post('guardar', 'store')->name('menu.rol.store');
        });
        // ----------------------------------------------------------------------------------------
    });
    Route::prefix('configuracion_sis')->middleware(['SuperAdmin','Administrador'])->group(function () {
        // Ruta Administrador del SEmpresa
        // ------------------------------------------------------------------------------------
        Route::controller(ConfigEmpresaController::class)->prefix('empresas')->group(function () {
            Route::get('', 'index')->name('empresa.index');
            Route::get('crear', 'create')->name('empresa.create');
            Route::get('editar/{id}', 'edit')->name('empresa.edit');
            Route::post('guardar', 'store')->name('empresa.store');
            Route::put('actualizar/{id}', 'update')->name('empresa.update');
            Route::delete('eliminar/{id}', 'destroy')->name('empresa.destroy');
            Route::get('activar/{id}', 'activar')->name('empresa.activar');
        });
        // ----------------------------------------------------------------------------------------
    });
    Route::prefix('configuracion')->middleware(['SuperAdmin','Administrador','AdminEmpresa'])->group(function () {
        // Ruta Administrador del SEmpresa
        // ------------------------------------------------------------------------------------
        Route::controller(EmpresaAreaController::class)->prefix('area')->group(function () {
            Route::get('', 'index')->name('area.index');
            Route::get('crear', 'create')->name('area.create');
            Route::get('editar/{id}', 'edit')->name('area.edit');
            Route::post('guardar', 'store')->name('area.store');
            Route::put('actualizar/{id}', 'update')->name('area.update');
            Route::delete('eliminar/{id}', 'destroy')->name('area.destroy');
        });
        // ----------------------------------------------------------------------------------------
    });
});
