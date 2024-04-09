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
        foreach ($datas as $data) {
            DB::table('proyectos')->insert([
                'titulo' => $data['titulo'],
                'fec_creacion' => $data['fec_creacion'],
                'objetivo' => $data['objetivo'],
                'config_empresa_id' => $data['config_empresa_id'],
                'config_usuario_id' => $data['config_usuario_id'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            $empleados = ConfigUsuario::where('id','>',3)->get();
            foreach ($empleados as $empleado) {
                DB::table('proyecto_miembros')->insert([
                    'config_usuario_id' => $empleado->id,
                    'proyectos_id' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
