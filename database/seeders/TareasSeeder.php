<?php

namespace Database\Seeders;

use App\Models\Configuracion\ConfigUsuario;
use App\Models\Proyectos\Proyecto;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TareasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('proy_tareas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');


        $proyectos = Proyecto::get();
        $datas = [];
        $id =0;
        foreach ($proyectos as $proyecto) {
            $lideres1 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', $proyecto->config_empresa_id)->where('estado', 1)
            ->whereHas('rol', function ($p) {
                $p->where('config_rol_id', '>', 3);
            })->get();
            $lideres2 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', '!=', $proyecto->config_empresa_id)->where('estado', 1)
            ->whereHas('empresas_tranv', function ($q) use ($proyecto) {
                $q->where('config_empresa_id', $proyecto->config_empresa_id);
            })->whereHas('rol', function ($p) {
                $p->where('config_rol_id', '>', 3);
            })->get();
            $empleados = $lideres1->concat($lideres2);
            foreach ($proyecto->componentes as $componente) {
                for ($i = 1; $i < 6; $i++) {
                    switch ($i) {
                        case 5:
                            $impacto = 'Alto';
                            $impacto_num = 50;
                            break;
                        case 4:
                            $impacto = 'Medio-alto';
                            $impacto_num = 40;
                            break;
                        case 3:
                            $impacto = 'Medio';
                            $impacto_num = 30;
                            break;
                        case 2:
                            $impacto = 'Medio-bajo';
                            $impacto_num = 20;
                            break;
                        default:
                            $impacto = 'Bajo';
                            $impacto_num = 10;
                            break;
                    }
                    $config_usuario_id = intval(rand($empleados->min('id'), $empleados->max('id')));
                    $id++;
                    array_push($datas, [
                        'id' => $id,
                        'proy_componentes_id' => intval($componente->id),
                        'config_usuario_id' => $config_usuario_id,
                        'titulo' => 'Tarea de calibración impacto componente ' . $i . ' impacto: ' . $impacto . ' valor numerico: ' . $impacto_num,
                        'fec_creacion' => '2024-04-' . rand(1, 11),
                        'fec_limite' => '2024-' . rand(4, 5) . '-' . rand(12, 28),
                        'objetivo' => 'Calibrar las tareas del proyecto, los componentes y las tareas segun el impacto ' . 'Tarea de calibración impacto componente ' . $i . ' impacto: ' . $impacto . ' valor numerico: ' . $impacto_num,
                        'impacto' => $impacto,
                        'impacto_num' => $impacto_num,
                    ]);
                }
            }
            foreach ($datas as $data) {
                DB::table('proy_tareas')->insert([
                    'proy_componentes_id' => $data['proy_componentes_id'],
                    'config_usuario_id' => $data['config_usuario_id'],
                    'titulo' => $data['titulo'],
                    'fec_creacion' => $data['fec_creacion'],
                    'fec_limite' => $data['fec_limite'],
                    'objetivo' => $data['objetivo'],
                    'impacto' => $data['impacto'],
                    'impacto_num' => $data['impacto_num'],
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
                $miembros[] = $data['config_usuario_id'];
                if ($proyecto->componentes->count()>0) {
                    foreach ($proyecto->componentes as $componente) {
                        $miembros[] = $componente->config_usuario_id;
                        if ($componente->tareas->count()>0) {
                            foreach ($componente->tareas as $tarea) {
                                $miembros[] = $tarea->config_usuario_id;
                            }
                        }
                    }
                }

                $proyecto->miembros_proyecto()->sync(array_unique($miembros));
                DB::table('proy_notificaciones')->insert([
                    'config_usuario_id' => $data['config_usuario_id'],
                    'fec_creacion' => $data['fec_creacion'] . ' ' . rand(8, 11) . ':' . rand(1, 59) . ':' . rand(1, 59) . '' ,
                    'titulo' => 'Se te asigno una nueva tarea',
                    'mensaje' => 'Se creo un nueva tarea '.$data['titulo'].' y te fue asignada',
                    'link' => route('tarea.gestion',['id'=>$data['id']]),
                    'id_link' => 1,
                    'tipo' => 'tarea',
                    'accion' => 'creacion',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
