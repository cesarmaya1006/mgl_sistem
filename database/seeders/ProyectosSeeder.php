<?php

namespace Database\Seeders;

use App\Models\Configuracion\ConfigUsuario;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyectosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('proyecto_miembros')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');


        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('proyectos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $datas = [
            [
                'titulo' => 'Proyecto de Prueba',
                'fec_creacion' => '2024-04-04',
                'objetivo' => 'Objetivo de prueba para proyecto seeder',
                'config_empresa_id' => 1,
                'config_usuario_id' => 4,
            ],
        ];
        $id = 0;
        foreach ($datas as $data) {
            $id++;
            DB::table('proyectos')->insert([
                'titulo' => $data['titulo'],
                'fec_creacion' => $data['fec_creacion'],
                'objetivo' => $data['objetivo'],
                'config_empresa_id' => $data['config_empresa_id'],
                'config_usuario_id' => $data['config_usuario_id'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            DB::table('proyecto_miembros')->insert([
                'config_usuario_id' => $data['config_usuario_id'],
                'proyectos_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            DB::table('proy_notificaciones')->insert([
                'config_usuario_id' => $data['config_usuario_id'],
                'fec_creacion' => $data['fec_creacion'] . ' ' . rand(8, 11) . ':' . rand(1, 59) . ':' . rand(1, 59) . '' ,
                //'fec_creacion' => '2024-04-04 9:4:48' ,
                'titulo' => 'Se te asigno un nuevo proyecto',
                'mensaje' => 'Se creo un nuevo proyecto '.$data['titulo'].' y te fue asignado ',
                'link' => route('proyecto.gestion',['id' => $id ]),
                'id_link' => 1,
                'tipo' => 'proyecto',
                'accion' => 'creacion',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        }
    }
}
