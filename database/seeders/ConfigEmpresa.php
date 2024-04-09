<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigEmpresa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'config_tipo_documento_id' => 6,
                'config_grupo_empresas_id' => 1,
                'identificacion' => '333222111',
                'nombres' => 'Empresa de Prueba 1',
                'email' => 'prueba1@gmail.com',
                'telefono' => '987654321',
                'direccion' => 'Calle de prueba 123',
                'contacto' => 'Contacto prueba 1',
                'cargo' => 'Cargo de prueba 1',
                'logo' => 'empresa1.png',

            ],
            [
                'config_tipo_documento_id' => 6,
                'config_grupo_empresas_id' => 1,
                'identificacion' => '444555666',
                'nombres' => 'Empresa de Prueba 2',
                'email' => 'prueba2@gmail.com',
                'telefono' => '31065498732',
                'direccion' => 'Calle de prueba 456',
                'contacto' => 'Contacto prueba 2',
                'cargo' => 'Cargo de prueba 2',
                'logo' => 'empresa1.png',

            ],
            [
                'config_tipo_documento_id' => 6,
                'config_grupo_empresas_id' => 1,
                'identificacion' => '777888999',
                'nombres' => 'Empresa de Prueba 3',
                'email' => 'prueba3@gmail.com',
                'telefono' => '32098765421',
                'direccion' => 'Calle de prueba 789',
                'contacto' => 'Contacto prueba 3',
                'cargo' => 'Cargo de prueba 3',
                'logo' => 'empresa1.png',

            ],
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('config_empresa')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        foreach ($datas as $data) {
            DB::table('config_empresa')->insert([
                'config_grupo_empresas_id' => $data['config_grupo_empresas_id'],
                'config_tipo_documento_id' => $data['config_tipo_documento_id'],
                'identificacion' => $data['identificacion'],
                'nombres' => $data['nombres'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
                'direccion' => $data['direccion'],
                'contacto' => $data['contacto'],
                'cargo' => $data['cargo'],
                'logo' => $data['logo'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
