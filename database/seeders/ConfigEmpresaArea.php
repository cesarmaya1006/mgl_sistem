<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigEmpresaArea extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'empresa_area_id' => null,
                'config_empresa_id' => 1,
                'area' => 'Gerencia',
            ],
            [
                'empresa_area_id' => 1,
                'config_empresa_id' => 1,
                'area' => 'Dirección Administrativa',
            ],
            [
                'empresa_area_id' => 1,
                'config_empresa_id' => 1,
                'area' => 'Dirección Técnica',
            ],
            [
                'empresa_area_id' => 1,
                'config_empresa_id' => 1,
                'area' => 'Dirección Operativa',
            ],
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('empresa_area')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        foreach ($datas as $data) {
            DB::table('empresa_area')->insert([
                'empresa_area_id' => $data['empresa_area_id'],
                'config_empresa_id' => $data['config_empresa_id'],
                'area' => $data['area'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
