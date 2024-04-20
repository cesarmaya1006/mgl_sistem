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
            ['nombre' => 'Dashboard', 'menu_id' => null, 'url' => 'dashboard', 'orden' => '1', 'icono' => 'mdi mdi-view-dashboard', 'Array_1' => []],
            //Menu configuración 2
            [
                'nombre' => 'Configuración Sistema', 'menu_id' => null, 'url' => '#', 'orden' => '2', 'icono' => 'fas fa-cogs',
                'Array_1' => [
                    //Menu menu
                    ['nombre' => 'Menús', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/menu', 'orden' => '1',  'icono' => 'fas fa-list-ul', 'Array_2' => []],
                    //Menu Roles
                    ['nombre' => 'Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/rol', 'orden' => '2',  'icono' => 'fas fa-users', 'Array_2' => []],
                    //Menu Menu_Roles
                    ['nombre' => 'Menú - Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/permisos_menus_rol', 'orden' => '2',  'icono' => 'fas fa-chalkboard-teacher', 'Array_2' => []],
                    //Menu Grupo Empresas
                    ['nombre' => 'Grupo Empresas', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/grupo_empresas', 'orden' => '2',  'icono' => 'fas fa-industry', 'Array_2' => []],
                    //Menu Empresas
                    ['nombre' => 'Empresas', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/empresas', 'orden' => '2',  'icono' => 'fas fa-building', 'Array_2' => []],

                ],
            ],
            [
                'nombre' => 'Configuración', 'menu_id' => null, 'url' => '#', 'orden' => '3', 'icono' => 'fas fa-cogs',
                'Array_1' => [
                    //Menu organigrama
                    [
                        'nombre' => 'Organigrama', 'menu_id' => '2',  'url' => '#', 'orden' => '1',  'icono' => 'fas fa-sitemap',
                        'Array_2' => [
                            //Menu Areas
                            ['nombre' => 'Áreas', 'menu_id' => '2',  'url' => 'dashboard/configuracion/areas', 'orden' => '1',  'icono' => 'fas fa-project-diagram','Array_3'=>[]],
                            //Menu Roles
                            ['nombre' => 'Cargos', 'menu_id' => '2',  'url' => 'dashboard/configuracion/cargos', 'orden' => '2',  'icono' => 'fas fa-user-tie','Array_3'=>[]],
                            //Menu Roles
                            ['nombre' => 'Empleados', 'menu_id' => '2',  'url' => 'dashboard/configuracion/empleados', 'orden' => '2',  'icono' => 'fas fa-users','Array_3'=>[]],

                        ]
                    ],

                ],
            ],
            //Menu Modulo Juridico
            [
                'nombre' => 'Módulo Jurídico', 'menu_id' => null, 'url' => '#', 'orden' => '3', 'icono' => 'fas fa-balance-scale',
                'Array_1' => [
                    //Menu Parametrizacion Juridico
                    [
                        'nombre' => 'Parametrización', 'url' => '#', 'icono' => 'fas fa-indent',
                        'Array_2' =>[
                            //Param  Juzgados
                            [
                                'nombre' => 'Parámetros Juzgados', 'url' => '#', 'icono' => 'fas fa-balance-scale',
                                'Array_3' =>[
                                    //Param  jurisdiccion juzgados
                                    ['nombre' => 'Jurisdiccion Juzgados', 'url' => 'dashboard/modulo-juridico/param-juzgados/jurisdiccion-juzgados'],
                                    //Param  jurisdiccion juzgados
                                    ['nombre' => 'Departamentos Juzgados', 'url' => 'dashboard/modulo-juridico/param-juzgados/departamentos-juzgados'],
                                    //Param  jurisdiccion juzgados
                                    ['nombre' => 'Distritos Juzgados', 'url' => 'dashboard/modulo-juridico/param-juzgados/distritos-juzgados'],
                                    //Param  jurisdiccion juzgados
                                    ['nombre' => 'Circuitos Juzgados', 'url' => 'dashboard/modulo-juridico/param-juzgados/circuitos-juzgados'],
                                    //Param  jurisdiccion juzgados
                                    ['nombre' => 'Municipios Juzgados', 'url' => 'dashboard/modulo-juridico/param-juzgados/circuitos-juzgados'],
                                    //Param  jurisdiccion juzgados
                                    ['nombre' => 'Juzgados', 'url' => 'dashboard/modulo-juridico/param-juzgados/juzgados'],
                                ],
                            ],
                            //Param  Procesos
                            [
                                'nombre' => 'Parámetros Procesos', 'url' => '#', 'icono' => 'fas fa-copy',
                                'Array_3' =>[
                                    //Param  jurisdiccion juzgados
                                    ['nombre' => 'Tipos de Procesos', 'url' => 'dashboard/modulo-juridico/param-procesos/tipos-procesos'],
                                    //Param  Papel Cliente
                                    ['nombre' => 'Papel Cliente', 'url' => 'dashboard/modulo-juridico/param-procesos/papel-cliente'],
                                    //Param  Estado Procesos
                                    ['nombre' => 'Estado Procesos', 'url' => 'dashboard/modulo-juridico/param-procesos/estado-procesos'],
                                    //Param  Etapa Procesos
                                    ['nombre' => 'Etapa Procesos', 'url' => 'dashboard/modulo-juridico/param-procesos/etapa-procesos'],
                                    //Param  Riesgo Perdida Procesos
                                    ['nombre' => 'Riesgo Perdida Procesos', 'url' => 'dashboard/modulo-juridico/param-procesos/riesgo-procesos'],
                                    //Param  Sentidos de Fallo Procesos
                                    ['nombre' => 'Sentidos de Fallo Procesos', 'url' => 'dashboard/modulo-juridico/param-procesos/sentido-fallo-procesos'],
                                    //Param  Terminación Anormal Procesos
                                    ['nombre' => 'Terminación Anormal Procesos', 'url' => 'dashboard/modulo-juridico/param-procesos/terminacion-anormal-procesos'],
                                ],
                            ],
                        ],
                    ],
                    // Procesos
                    [
                        'nombre' => 'Procesos', 'url' => 'dashboard/modulo-juridico/procesos', 'icono' => 'fas fa-gavel','Array_2' =>[]
                    ]

                ],
            ],
            // Modulo archivo
            ['nombre' => 'Módulo Archivo', 'menu_id' => null, 'url' => 'dashboard/modulo-archivo', 'icono' => 'far fa-folder-open','Array_1' =>[]],
            // Modulo proyectos
            ['nombre' => 'Módulo proyectos', 'menu_id' => null, 'url' => 'dashboard/proyectos', 'icono' => 'fas fa-project-diagram','Array_1' =>[]],
            // Modulo archivo
            ['nombre' => 'Noticias', 'menu_id' => null, 'url' => 'dashboard/noticias', 'icono' => 'fas fa-newspaper','Array_1' =>[]],
            // Modulo archivo
            ['nombre' => 'Diagnósticos Legales', 'menu_id' => null, 'url' => 'dashboard/diagnosticos', 'icono' => 'fas fa-chart-line','Array_1' =>[]],
            // Modulo archivo
            ['nombre' => 'Consultas / Solicitudes', 'menu_id' => null, 'url' => 'dashboard/solicitudes', 'icono' => 'far fa-hand-paper','Array_1' =>[]],
        ];
        $x = 0;
        $n = 0;
        $m = 0;
        $l = 0;
        $p = 0;
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
            $p++;
            $n = $p;
            $y = 0;
            if (count($menu['Array_1']) > 0) {
                foreach ($menu['Array_1'] as $sub_menu_1) {
                    $y++;
                    DB::table('config_menu')->insert([
                        'config_menu_id' => $n,
                        'nombre' => utf8_encode(utf8_decode($sub_menu_1['nombre'])),
                        'url' => $sub_menu_1['url'],
                        'orden' => $y,
                        'icono' => $sub_menu_1['icono'],
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);
                    $p++;
                    $m = $p;
                    $z = 0;
                    if (count($sub_menu_1['Array_2']) > 0) {
                        foreach ($sub_menu_1['Array_2'] as $sub_menu_2) {
                            $z++;
                            DB::table('config_menu')->insert([
                                'config_menu_id' => $m,
                                'nombre' => utf8_encode(utf8_decode($sub_menu_2['nombre'])),
                                'url' => $sub_menu_2['url'],
                                'orden' => $z,
                                'icono' => $sub_menu_2['icono'],
                                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                            ]);
                            $p++;
                            $l = $p;
                            $w = 0;
                            if (count($sub_menu_2['Array_3']) > 0) {
                                foreach ($sub_menu_2['Array_3'] as $sub_menu_3) {
                                    $w++;
                                    DB::table('config_menu')->insert([
                                        'config_menu_id' => $l,
                                        'nombre' => utf8_encode(utf8_decode($sub_menu_3['nombre'])),
                                        'url' => $sub_menu_3['url'],
                                        'orden' => $w,
                                        'icono' => 'fas fa-caret-right',
                                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                                    ]);
                                    $p++;
                                }
                            }
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
                            if (count($sub_menu_2['Array_3']) > 0) {
                                foreach ($sub_menu_2['Array_3'] as $sub_menu_3) {
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
        DB::table('config_menu_rol')->insert(['config_menu_id' => 1,'config_rol_id' => '4',]);
        DB::table('config_menu_rol')->insert(['config_menu_id' => 32,'config_rol_id' => '4',]);
    }
}
