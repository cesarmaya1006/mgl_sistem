<?php

namespace Database\Seeders;

use App\Models\Configuracion\ConfigUsuario;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id =1;
        $tabla = 'config_usuario';
        $data = ['nombres' => 'Super Administrador', 'email' => 'superadmin1006@gmail.com', 'password' => bcrypt('123')];
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table($tabla)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $usuario = ConfigUsuario::create($data);
        $usuario->rol()->attach(1);
        $id++;
    }
}
