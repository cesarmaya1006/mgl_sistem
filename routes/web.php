<?php

use App\Http\Controllers\Configuracion\ConfigEmpresaController;
use App\Http\Controllers\Configuracion\ConfigMenuController;
use App\Http\Controllers\Configuracion\ConfigMenuRolController;
use App\Http\Controllers\Configuracion\ConfigRolController;
use App\Http\Controllers\Configuracion\GrupoEmpresaController;
use App\Http\Controllers\Empresa\EmpresaAreaController;
use App\Http\Controllers\Empresa\EmpresaCargoController;
use App\Http\Controllers\Empresa\EmpresaEmpleadoController;
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
        // Ruta Administrador Grupo Empresas
        // ------------------------------------------------------------------------------------
        Route::controller(GrupoEmpresaController::class)->prefix('grupo_empresas')->group(function () {
            Route::get('', 'index')->name('grupo_empresas.index');
            Route::get('crear', 'create')->name('grupo_empresas.create');
            Route::get('editar/{id}', 'edit')->name('grupo_empresas.edit');
            Route::post('guardar', 'store')->name('grupo_empresas.store');
            Route::put('actualizar/{id}', 'update')->name('grupo_empresas.update');
            Route::delete('eliminar/{id}', 'destroy')->name('grupo_empresas.destroy');
            Route::get('activar/{id}', 'activar')->name('grupo_empresas.activar');
            Route::get('getEmpresas', 'getEmpresas')->name('grupo_empresas.getEmpresas');

        });
        // ------------------------------------------------------------------------------------
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
        // Ruta Administrador de Empresa - Areas
        // ------------------------------------------------------------------------------------
        Route::controller(EmpresaAreaController::class)->prefix('areas')->group(function () {
            Route::get('', 'index')->name('area.index');
            Route::get('crear', 'create')->name('area.create');
            Route::get('editar/{id}', 'edit')->name('area.edit');
            Route::post('guardar', 'store')->name('area.store');
            Route::put('actualizar/{id}', 'update')->name('area.update');
            Route::delete('eliminar/{id}', 'destroy')->name('area.destroy');
            Route::get('getDependencias/{id}', 'getDependencias')->name('area.getDependencias');
            Route::get('getAreas', 'getAreas')->name('area.getAreas');
        });
        // ----------------------------------------------------------------------------------------
        // Ruta Administrador de Empresa - Areas
        // ------------------------------------------------------------------------------------
        Route::controller(EmpresaCargoController::class)->prefix('cargos')->group(function () {
            Route::get('', 'index')->name('cargo.index');
            Route::get('crear', 'create')->name('cargo.create');
            Route::get('editar/{id}', 'edit')->name('cargo.edit');
            Route::post('guardar', 'store')->name('cargo.store');
            Route::put('actualizar/{id}', 'update')->name('cargo.update');
            Route::delete('eliminar/{id}', 'destroy')->name('cargo.destroy');
        });
        // ----------------------------------------------------------------------------------------
        // Ruta Administrador de Empresa - Areas
        // ------------------------------------------------------------------------------------
        Route::controller(EmpresaEmpleadoController::class)->prefix('empleados')->group(function () {
            Route::get('', 'index')->name('empleado.index');
            Route::get('crear', 'create')->name('empleado.create');
            Route::get('editar/{id}', 'edit')->name('empleado.edit');
            Route::post('guardar', 'store')->name('empleado.store');
            Route::put('actualizar/{id}', 'update')->name('empleado.update');
            Route::delete('eliminar/{id}', 'destroy')->name('empleado.destroy');
            Route::get('getCargos', 'getCargos')->name('empleado.getCargos');
        });
        // ----------------------------------------------------------------------------------------

    });
});
