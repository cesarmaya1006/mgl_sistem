<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigEmpresaCargo extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'empresa_area_id' => 1,
                'cargo' => 'Gerente General',
            ],
            [
                'empresa_area_id' => 2,
                'cargo' => 'Director Administrativo',
            ],
            [
                'empresa_area_id' => 3,
                'cargo' => 'Director Técnico',
            ],
            [
                'empresa_area_id' => 4,
                'cargo' => 'Director Operativo',
            ],
            [
                'empresa_area_id' => 4,
                'cargo' => 'Desarrollador',
            ],
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('empresa_cargo')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        foreach ($datas as $data) {
            DB::table('empresa_cargo')->insert([
                'empresa_area_id' => $data['empresa_area_id'],
                'cargo' => $data['cargo'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
