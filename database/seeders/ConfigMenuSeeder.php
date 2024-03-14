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
            ['nombre' => 'Dashboard', 'menu_id' => null, 'url' => 'dashboard', 'orden' => '1', 'icono' => 'mdi mdi-view-dashboard'],
            //Menu configuración 2
            ['nombre' => 'configuración', 'menu_id' => null, 'url' => 'admin/index', 'orden' => '2', 'icono' => 'fas fa-cogs'],
            //Menu menu
            ['nombre' => 'Menús', 'menu_id' => '2',  'url' => 'dashboard/configuracion/menu', 'orden' => '1',  'icono' => 'fas fa-list-ul'],


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

*/
        ];
        foreach ($menus as $menu) {
            DB::table('config_menu')->insert([
                'config_menu_id' => $menu['menu_id'],
                'nombre' => utf8_encode(utf8_decode($menu['nombre'])),
                'url' => $menu['url'],
                'orden' => $menu['orden'],
                'icono' => $menu['icono'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

        for ($i = 1; $i <= count($menus); $i++) {
            DB::table('config_menu_rol')->insert([
                'config_menu_id' => $i,
                'config_rol_id' => '1',
            ]);
        }
    }
}
