<?php

namespace Database\Seeders;

use App\Models\Configuracion\ConfigUsuario;
use App\Models\Empresa\EmpresaEmpleado;
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('config_usuario')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('empresa_empleados')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');


        $id = 0;
        $data = ['nombres' => 'Super Administrador', 'email' => 'superadmin1006@gmail.com', 'password' => bcrypt('123')];
        $usuario = ConfigUsuario::create($data);
        $usuario->rol()->attach(1);
        $id++;

        //-------------------------------------------------------------------------------------------------------------------

        $data = ['nombres' => 'Administrador Sistema', 'email' => 'adminsis@gmail.com', 'password' => bcrypt('123')];
        $usuario = ConfigUsuario::create($data);
        $usuario->rol()->attach(2);
        $id++;

        //-------------------------------------------------------------------------------------------------------------------

        $data = ['config_empresa_id' => 1,'nombres' => 'Administrador', 'email' => 'admin@gmail.com', 'password' => bcrypt('123')];
        $usuario = ConfigUsuario::create($data);
        $usuario->rol()->attach(3);
        $id++;

        //-------------------------------------------------------------------------------------------------------------------
        $identificacion = 987654321;
        $telefono = 3103216549;
        $foto = 1;
        $cargo = 1;
        $password = bcrypt('123');
        $empleados = [
            [
                'nombres' => 'Ana',
                'apellidos' => 'Peres',
                'lider' => 1,
            ],
            [
                'nombres' => 'Beto',
                'apellidos' => 'Peres',
                'lider' => 1,
            ],
            [
                'nombres' => 'Carla',
                'apellidos' => 'Peres',
                'lider' => 0,
            ],
            [
                'nombres' => 'Dario',
                'apellidos' => 'Peres',
                'lider' => 0,
            ],
            [
                'nombres' => 'Eliseo',
                'apellidos' => 'Peres',
                'lider' => 0,
            ],
            [
                'nombres' => 'Cesar',
                'apellidos' => 'Maya',
                'lider' => 1,
            ],

        ];
        foreach ($empleados as $empleado) {
            DB::table('config_usuario')->insert([
                'config_tipo_documento_id' => 1,
                'config_empresa_id' => 1,
                'identificacion' => $identificacion,
                'nombres' => $empleado['nombres'],
                'apellidos' => $empleado['apellidos'],
                'email' => strtolower(substr($empleado['nombres'], 0, 1)) . strtolower(strtok($empleado['apellidos'], ' ')) . '@gmail.com',
                'telefono' => $telefono,
                'password' => $password,
                'direccion' => 'Cr1 Trnv 1 casa G' . $id + 1,
                'foto' => 'usuario' . $foto . '.jpg',
                'lider' => $empleado['lider'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            $id++;
            $identificacion++;
            $telefono++;
            $foto++;
            $usuario = ConfigUsuario::findOrFail($id);
            $usuario->rol()->attach(4);

            DB::table('empresa_empleados')->insert([
                'id' => $id,
                'empresa_cargo_id' => $cargo,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            if ($cargo!=5) {
                $cargo++;
            }

        }

        //-------------------------------------------------------------------------------------------------------------------

    }
}
