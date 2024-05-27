<?php

use App\Http\Controllers\Configuracion\ConfigAparienciaController;
use App\Http\Controllers\Configuracion\ConfigEmpresaController;
use App\Http\Controllers\Configuracion\ConfigMenuController;
use App\Http\Controllers\Configuracion\ConfigMenuRolController;
use App\Http\Controllers\Configuracion\ConfigRolController;
use App\Http\Controllers\Configuracion\GrupoEmpresaController;
use App\Http\Controllers\Empresa\EmpresaAreaController;
use App\Http\Controllers\Empresa\EmpresaCargoController;
use App\Http\Controllers\Empresa\EmpresaEmpleadoController;
use App\Http\Controllers\Proyectos\ComponenteController;
use App\Http\Controllers\Proyectos\HistorialController;
use App\Http\Controllers\Proyectos\HistorialDocController;
use App\Http\Controllers\Proyectos\MensajeController;
use App\Http\Controllers\Proyectos\NotificacionController;
use App\Http\Controllers\Proyectos\ProyectoController;
use App\Http\Controllers\Proyectos\SubTareaController;
use App\Http\Controllers\Proyectos\TareaController;
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
    Route::prefix('configuracion_sis')->middleware(['Administrador'])->group(function () {
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
    Route::prefix('configuracion')->middleware(['AdminEmpresa'])->group(function () {
        // Ruta Apariencias
        // ------------------------------------------------------------------------------------
        Route::controller(ConfigAparienciaController::class)->prefix('apariencia')->group(function () {
            Route::get('body_dark_mode', 'body_dark_mode')->name('apariencia.body_dark_mode');
            Route::get('cambio_check', 'cambio_check')->name('apariencia.cambio_check');
            Route::get('fondomenu_sup', 'fondomenu_sup')->name('apariencia.fondomenu_sup');
            Route::get('fondo_barra_lat', 'fondo_barra_lat')->name('apariencia.fondo_barra_lat');


        });
        // ----------------------------------------------------------------------------------------
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
            Route::get('getlideresporempresa', 'getlideresporempresa')->name('empleado.getlideresporempresa');

        });
        // ----------------------------------------------------------------------------------------

    });
    Route::prefix('proyectos')->middleware(['Empleado'])->group(function (){
        // Ruta proyectos
        // ------------------------------------------------------------------------------------
        Route::controller(ProyectoController::class)->group(function () {
            Route::get('', 'index')->name('proyecto.index');
            Route::get('crear', 'create')->name('proyecto.create');
            Route::post('guardar', 'store')->name('proyecto.store');
            Route::get('detalle/{id}', 'show')->name('proyecto.detalle');
            Route::get('gestion/{id}/{notificacion_id?}', 'gestion')->name('proyecto.gestion');
            Route::get('getproyectos/{estado}/{config_empresa_id}', 'getproyectos')->name('proyecto.getproyectos');
            Route::get('getproyectos/{config_usuario_id}', 'getproyectosusuario')->name('proyecto.getproyectosusuario');
            Route::get('proyecto_ponderacion_comp/{id}', 'proyecto_ponderacion_comp')->name('proyecto.proyecto_ponderacion_comp');
            Route::get('proyecto_avance_comp/{id}', 'proyecto_avance_comp')->name('proyecto.proyecto_avance_comp');
            Route::get('proyecto_presupuesto_comp/{id}', 'proyecto_presupuesto_comp')->name('proyecto.proyecto_presupuesto_comp');
            Route::get('expotar_informeproyecto/{id}', 'expotar_informeproyecto')->name('proyecto.expotar_informeproyecto');

        });
        // ----------------------------------------------------------------------------------------
        // Ruta proyectos
        // ------------------------------------------------------------------------------------
        Route::controller(ComponenteController::class)->prefix('componentes')->group(function () {
            Route::get('crear/{proyectos_id}', 'create')->name('componente.create');
            Route::post('guardar', 'store')->name('componente.store');
        });
        // ----------------------------------------------------------------------------------------
        // Ruta tareas
        // ------------------------------------------------------------------------------------
        Route::controller(TareaController::class)->prefix('tareas')->group(function () {
            Route::get('crear/{componente_id}', 'create')->name('tarea.create');
            Route::post('guardar', 'store')->name('tarea.store');
            Route::get('gestion/{id}/{notificacion_id?}', 'gestion')->name('tarea.gestion');
            Route::get('gettareasusu/{config_usuario_id}', 'gettareasusu')->name('tarea.gettareasusu');
            Route::get('gettareasusumodal/{config_usuario_id}/{estado}', 'gettareasusumodal')->name('tarea.gettareasusumodal');
            Route::get('getapitareas/{proy_componentes_id}/{estado}', 'getapitareas')->name('tarea.getapitareas');

        });
        // ----------------------------------------------------------------------------------------
        // Ruta sub-tareas
        // ------------------------------------------------------------------------------------
        Route::controller(TareaController::class)->prefix('subtareas')->group(function () {
            Route::get('crear/{proy_tareas_id}', 'subtareas_create')->name('subtareas.create');
            Route::post('guardar', 'subtareas_store')->name('subtareas.store');
            Route::get('gestion/{id}/{notificacion_id?}', 'subtareas_gestion')->name('subtareas.gestion');


        });
        // ----------------------------------------------------------------------------------------
        // Ruta historiales
        // ------------------------------------------------------------------------------------
        Route::controller(HistorialController::class)->prefix('historiales')->group(function () {
            Route::get('crear/{proy_tareas_id}', 'create')->name('historial.create');
            Route::post('guardar', 'store')->name('historial.store');
            Route::get('gestion/{id}', 'gestion')->name('historial.gestion');
        });
        // ----------------------------------------------------------------------------------------
        // Ruta historiales subtareas
        // ------------------------------------------------------------------------------------
        Route::controller(HistorialController::class)->prefix('historialessubtarea')->group(function () {
            Route::post('guardar', 'historialessubtarea_store')->name('historialessubtarea.store');
        });
        // ----------------------------------------------------------------------------------------
        // Ruta Documentos historiales
        // ------------------------------------------------------------------------------------
        Route::controller(HistorialDocController::class)->prefix('doc_historiales')->group(function () {
            Route::get('crear/{proy_historiales_id}', 'create')->name('doc_historial.create');
            Route::post('guardar', 'store')->name('doc_historial.store');
        });
        // ----------------------------------------------------------------------------------------
        // Ruta Notificaciones
        // ------------------------------------------------------------------------------------
        Route::controller(NotificacionController::class)->prefix('notificaciones')->group(function () {
            Route::get('getnotificaciones/{id}', 'getnotificaciones')->name('notificacion.getnotificaciones');
            Route::get('readnotificaciones', 'readnotificaciones')->name('notificacion.readnotificaciones');
        });
        // ----------------------------------------------------------------------------------------
        // ----------------------------------------------------------------------------------------
        // Ruta Mensajes
        // ------------------------------------------------------------------------------------
        Route::controller(MensajeController::class)->prefix('mensajes')->group(function () {
            Route::get('getmensajes/{id}', 'getmensajes')->name('mensajes.getmensajes');
            Route::get('getusuarios/{id}', 'getusuarios')->name('mensajes.getusuarios');
            Route::post('guardar', 'store')->name('mensajes.store');
            Route::get('getmensajes_dest_rem', 'getmensajes_dest_rem')->name('mensajes.getmensajes_dest_rem');
            Route::get('getmensajes_dest_rem_ult', 'getmensajes_dest_rem_ult')->name('mensajes.getmensajes_dest_rem_ult');
            Route::get('get_all_nuevos_mensajes', 'get_all_nuevos_mensajes')->name('mensajes.get_all_nuevos_mensajes');

        });
        // ----------------------------------------------------------------------------------------
    });

});
