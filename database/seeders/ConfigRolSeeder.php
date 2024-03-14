<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id =1;
        $tabla = 'config_rol';
        $datas = [
            [
                'nombre' => 'Super Administrador',
                'slug' => 'superadmin',
            ],
            [
                'nombre' => 'Administrador',
                'slug' => 'admin',
            ],
            [
                'nombre' => 'MGL',
                'slug' => 'mgl',
            ],
            [
                'nombre' => 'Administrador Empresa',
                'slug' => 'adminempresa',
            ],
            [
                'nombre' => 'Empleado',
                'slug' => 'empleado',
            ],
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table($tabla)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        foreach ($datas as $data) {
            DB::table('config_rol')->insert([
                'id' => $id,
                'nombre' => $data['nombre'],
                'slug' => $data['slug'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            $id++;
        }

    }
}
