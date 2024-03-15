<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            //Menu Inicio
            ['nombre' => 'Dashboard', 'menu_id' => null, 'url' => 'dashboard', 'orden' => '1', 'icono' => 'mdi mdi-view-dashboard','Array_1' =>[]],
            //Menu configuración 2
            ['nombre' => 'Configuración', 'menu_id' => null, 'url' => '#', 'orden' => '2', 'icono' => 'fas fa-cogs',
                'Array_1' => [
                    //Menu menu
                    ['nombre' => 'Menús', 'menu_id' => '2',  'url' => 'dashboard/configuracion/menu', 'orden' => '1',  'icono' => 'fas fa-list-ul', 'Array_2' => []],
                    //Menu Roles
                    ['nombre' => 'Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion/rol', 'orden' => '2',  'icono' => 'fas fa-users', 'Array_2' => []],
                    //Menu Menu_Roles
                    ['nombre' => 'Menú - Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion/permisos_menus_rol', 'orden' => '2',  'icono' => 'fas fa-chalkboard-teacher', 'Array_2' => []],
                    //Menu Empresas
                    ['nombre' => 'Empresas', 'menu_id' => '2',  'url' => 'dashboard/configuracion/empresas', 'orden' => '2',  'icono' => 'fas fa-industry', 'Array_2' => []],

                ],
            ],
        ];
        $x = 0;
        foreach ($menus as $menu) {
            $x++;
            DB::table('config_menu')->insert([
                'config_menu_id' => $menu['menu_id'],
                'nombre' => utf8_encode(utf8_decode($menu['nombre'])),
                'url' => $menu['url'],
                'orden' => $x,
                'icono' => $menu['icono'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            $y = 0;
            if (count($menu['Array_1']) > 0) {
                foreach ($menu['Array_1'] as $sub_menu_1) {
                    $y++;
                    DB::table('config_menu')->insert([
                        'config_menu_id' => $x,
                        'nombre' => utf8_encode(utf8_decode($sub_menu_1['nombre'])),
                        'url' => $sub_menu_1['url'],
                        'orden' => $y,
                        'icono' => $sub_menu_1['icono'],
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);
                    $z = 0;
                    if (count($sub_menu_1['Array_2']) > 0) {
                        foreach ($sub_menu_1['Array_2'] as $sub_menu_2) {
                            $y++;
                            DB::table('config_menu')->insert([
                                'config_menu_id' => $y,
                                'nombre' => utf8_encode(utf8_decode($sub_menu_2['nombre'])),
                                'url' => $sub_menu_2['url'],
                                'orden' => $z,
                                'icono' => $sub_menu_2['icono'],
                                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                            ]);
                        }
                    }
                }
            }
        }
        // Menu roles Super administrador
        $j = 0;
        foreach ($menus as $menu) {
            $j++;
            DB::table('config_menu_rol')->insert([
                'config_menu_id' => $j,
                'config_rol_id' => '1',
            ]);
            if (count($menu['Array_1']) > 0) {
                foreach ($menu['Array_1'] as $sub_menu_1) {
                    $j++;
                    DB::table('config_menu_rol')->insert([
                        'config_menu_id' => $j,
                        'config_rol_id' => '1',
                    ]);
                    if (count($sub_menu_1['Array_2']) > 0) {
                        foreach ($sub_menu_1['Array_2'] as $sub_menu_2) {
                            $j++;
                            DB::table('config_menu_rol')->insert([
                                'config_menu_id' => $j,
                                'config_rol_id' => '1',
                            ]);
                        }
                    }
                }
            }
        }
    }
}


/*$menus = [
    //Menu Inicio
    ['nombre' => 'Dashboard', 'menu_id' => null, 'url' => 'dashboard', 'orden' => '1', 'icono' => 'mdi mdi-view-dashboard'],
    //Menu configuración 2
    ['nombre' => 'Configuración', 'menu_id' => null, 'url' => 'admin/index', 'orden' => '2', 'icono' => 'fas fa-cogs'],
    //Menu menu
    ['nombre' => 'Menús', 'menu_id' => '2',  'url' => 'dashboard/configuracion/menu', 'orden' => '1',  'icono' => 'fas fa-list-ul'],
    //Menu menu
    ['nombre' => 'Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion/roles', 'orden' => '2',  'icono' => 'fa-solid fa-people-group'],
*/

    /*// Menus padre
    ['nombre' => 'Inicio', 'menu_id' => '0', 'url' => 'admin/index', 'orden' => '1', 'icono' => 'fas fa-home'],
    ['nombre' => 'Sistema', 'menu_id' => '0', 'url' => '#', 'orden' => '2', 'icono' => 'fas fa-tools'],
    ['nombre' => 'Parametrización', 'menu_id' => '0', 'url' => '#', 'orden' => '3', 'icono' => 'fas fa-cogs'],
    //----------------------------------------------------------------------------------------------------------------------
    // Menus hijos
    //----------------------------------------------------------------------------------------------------------------------
    ['nombre' => 'Menús', 'menu_id' => '2',  'url' => 'admin/menu-index', 'orden' => '1',  'icono' => 'fas fa-list-ul'],
    ['nombre' => 'Roles Usuarios', 'menu_id' => '2', 'url' => 'admin/rol-index', 'orden' => '2', 'icono' => 'fas fa-user-tag'],
    ['nombre' => 'Menú - Roles', 'menu_id' => '2', 'url' => 'admin/_menus_rol', 'orden' => '3', 'icono' => 'fas fa-chalkboard-teacher'],
    ['nombre' => 'Permisos', 'menu_id' => '2', 'url' => 'admin/permiso-index', 'orden' => '4', 'icono' => 'fas fa-lock'],
    ['nombre' => 'Permisos -Rol', 'menu_id' => '2', 'url' => 'admin/_permiso-rol', 'orden' => '5', 'icono' => 'fas fa-user-lock'],
    ['nombre' => 'Empresas', 'menu_id' => '2', 'url' => 'admin/empresa-index', 'orden' => '6', 'icono' => 'fas fa-user-lock'],
    ['nombre' => 'Usuarios', 'menu_id' => '2', 'url' => '#', 'orden' => '7', 'icono' => 'fas fa-user-friends'],
    // Menus 2 nivel sistema
    ['nombre' => 'Gestión de Usuarios', 'menu_id' => '10', 'url' => 'admin/usuario-index', 'orden' => '1', 'icono' => 'fas fa-address-book'],
    // Menus ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //----------------------------------------------------------------------------------------------------------------------
    // Menus 2 nivel Parametros
    ['nombre' => 'Parametros Juzgados', 'menu_id' => '3', 'url' => '#', 'orden' => '1', 'icono' => 'fas fa-balance-scale'],
    ['nombre' => 'Parametros Procesos', 'menu_id' => '3', 'url' => '#', 'orden' => '2', 'icono' => 'fas fa-copy'],
    //----------------------------------------------------------------------------------------------------------------------
    // Menus hijos 3 nivel parametros juzgados
    ['nombre' => 'Jurisdiccion Juzgados', 'menu_id' => '12', 'url' => 'admin/jurisdiccion_juzgado-index', 'orden' => '2', 'icono' => 'fas fa-globe-americas'],
    ['nombre' => 'Departamentos Juzgados', 'menu_id' => '12', 'url' => 'admin/departamento_juzgado-index', 'orden' => '3', 'icono' => 'fas fa-map-marked'],
    ['nombre' => 'Distritos Juzgados', 'menu_id' => '12', 'url' => 'admin/distrito_juzgado-index', 'orden' => '4', 'icono' => 'fas fa-code-branch'],
    ['nombre' => 'Circuitos Juzgados', 'menu_id' => '12', 'url' => 'admin/circuito_juzgado-index', 'orden' => '5', 'icono' => 'far fa-copyright'],
    ['nombre' => 'Municipios Juzgados', 'menu_id' => '12', 'url' => 'admin/municipio_juzgado-index', 'orden' => '6', 'icono' => 'fas fa-archway'],
    ['nombre' => 'Juzgados', 'menu_id' => '12', 'url' => 'admin/juzgado-index', 'orden' => '7', 'icono' => 'fas fa-university'],
    //----------------------------------------------------------------------------------------------------------------------
    // Menus hijos 3 nivel parametros procesos
    ['nombre' => 'Tipos de Procesos', 'menu_id' => '13', 'url' => 'admin/tipo_proceso-index', 'orden' => '1', 'icono' => 'fas fa-caret-right'],
    ['nombre' => 'Papel Cliente', 'menu_id' => '13', 'url' => 'admin/papel_cliente-index', 'orden' => '2', 'icono' => 'fas fa-caret-right'],
    ['nombre' => 'Estado Procesos', 'menu_id' => '13', 'url' => 'admin/estado_proceso-index', 'orden' => '3', 'icono' => 'fas fa-caret-right'],
    ['nombre' => 'Etapa Procesos', 'menu_id' => '13', 'url' => 'admin/etapa_proceso-index', 'orden' => '4', 'icono' => 'fas fa-caret-right'],
    ['nombre' => 'Riesgo Perdida Procesos', 'menu_id' => '13', 'url' => 'admin/riesgo_perdida_proceso-index', 'orden' => '5', 'icono' => 'fas fa-caret-right'],
    ['nombre' => 'Sentidos de Fallo Procesos', 'menu_id' => '13', 'url' => 'admin/sentido_fallo_proceso-index', 'orden' => '6', 'icono' => 'fas fa-caret-right'],
    ['nombre' => 'Terminación Anormal Procesos', 'menu_id' => '13', 'url' => 'admin/terminacion_anormal-index', 'orden' => '7', 'icono' => 'fas fa-caret-right'],
    //----------------------------------------------------------------------------------------------------------------------
    // Menus padre Procesos
    ['nombre' => 'Procesos', 'menu_id' => '0', 'url' => '#', 'orden' => '4', 'icono' => 'fas fa-gavel'],
    // Menus hijos Procesos
    //----------------------------------------------------------------------------------------------------------------------
    ['nombre' => 'Listado Porcesos', 'menu_id' => '27',  'url' => 'admin/procesos_listado', 'orden' => '1',  'icono' => 'fas fa-caret-right'],
    ['nombre' => 'Crear Proceso', 'menu_id' => '27',  'url' => 'admin/crear_proceso', 'orden' => '2',  'icono' => 'fas fa-caret-right'],
    // Menus 2 nivel Parametros
    ['nombre' => 'Noticias', 'menu_id' => '0', 'url' => 'admin/noticias-index', 'orden' => '5', 'icono' => 'fas fa-newspaper'],
    // Archivo
    ['nombre' => 'Archivo', 'menu_id' => '0', 'url' => 'admin/archivo-index', 'orden' => '6', 'icono' => 'far fa-folder-open'],
    // Proyectos
    ['nombre' => 'Proyectos', 'menu_id' => '0', 'url' => 'admin/proyectos-index', 'orden' => '7', 'icono' => 'fas fa-project-diagram'],
    // Hojas de vida
    //['nombre' => 'Mi hoja de Vida', 'menu_id' => '0', 'url' => 'admin/mi_hoja_de_vida-index', 'orden' => '7', 'icono' => 'far fa-address-card'],
    // Menus 2 nivel Parametros
    ['nombre' => 'Parametro H.V.', 'menu_id' => '3', 'url' => 'admin/param_hojas_de_vida-index', 'orden' => '4', 'icono' => 'far fa-id-card'],
    // Menus padre Boletines antiguos
    ['nombre' => 'Boletines Antiguos', 'menu_id' => '0', 'url' => 'admin/boletines-index', 'orden' => '8', 'icono' => 'fas fa-book'],
    // Menus padre MIs Consultas y Solicitudes
    ['nombre' => 'Consultas/Solicitudes', 'menu_id' => '0', 'url' => 'admin/consultas_solicitudes-index', 'orden' => '9', 'icono' => 'far fa-hand-paper'],
    // Menus padre Diagnosticos
    ['nombre' => 'Diagnosticos Legales', 'menu_id' => '0', 'url' => 'admin/diagnosticos-index', 'orden' => '10', 'icono' => 'fas fa-chart-line'],


];

}*/
