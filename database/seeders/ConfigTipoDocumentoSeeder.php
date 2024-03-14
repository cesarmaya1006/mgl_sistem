<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigTipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id =1;
        $tabla = 'config_tipo_documento';
        $datas = [
            ['abreb_id' => 'CC', 'tipo_id' => 'Cedula de ciudadania'],
            ['abreb_id' => 'CE', 'tipo_id' => 'Cedula de extranjeria'],
            ['abreb_id' => 'PA', 'tipo_id' => 'Pasaporte'],
            ['abreb_id' => 'RC', 'tipo_id' => 'Registro Civil'],
            ['abreb_id' => 'TI', 'tipo_id' => 'Tarjeta de identidad'],
            ['abreb_id' => 'NIT', 'tipo_id' => 'Num Identif Tributaria'],
            ['abreb_id' => 'PEP', 'tipo_id' => 'Permiso Especial de Permanencia'],
            ['abreb_id' => 'TMF', 'tipo_id' => 'Tarjeta de Movilidad Fronteriza'],
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table($tabla)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        foreach ($datas as $data) {
            DB::table('config_tipo_documento')->insert([
                'id' => $id,
                'abreb_id' => $data['abreb_id'],
                'tipo_id' => $data['tipo_id'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            $id++;
        }
    }
}
