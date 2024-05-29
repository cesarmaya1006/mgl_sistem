<?php

namespace Database\Seeders;

use App\Models\Configuracion\ConfigUsuario;
use App\Models\Proyectos\Proyecto;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('proy_componentes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');


        $proyectos = Proyecto::get();
        $datas = [];
        foreach ($proyectos as $proyecto) {
            $lideres1 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', $proyecto->config_empresa_id)->where('estado', 1)->whereHas('rol', function ($p) {
                $p->where('config_rol_id', '>', 3);
            })->get();
            $lideres2 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', '!=', $proyecto->config_empresa_id)->where('estado', 1)->whereHas('empresas_tranv', function ($q) use ($proyecto) {
                $q->where('config_empresa_id', $proyecto->config_empresa_id);
            })->whereHas('rol', function ($p) {
                $p->where('config_rol_id', '>', 3);
            })->get();
            $lideres = $lideres1->concat($lideres2);
            $presupuesto_proyecto_asignado = 0;
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
                $config_usuario_id = intval(rand($lideres->min('id'), $lideres->max('id')));
                $presupuesto = 0;
                $titulo = 'Calibración impacto componente ' . $i;
                $objetivo = 'Calibrar el proyecto, los componentes y las tareas segun el impacto';
                $fec_creacion = '2024-04-' . rand(1, 11);

                if ($proyecto->presupuesto > 0) {
                    if ($i == 5) {
                        $presupuesto = $proyecto->presupuesto -$presupuesto_proyecto_asignado;
                    } else {
                        $presupuesto = rand(1,5) * 0.1 *($proyecto->presupuesto -$presupuesto_proyecto_asignado);
                    }
                    $presupuesto_proyecto_asignado += $presupuesto;
                    $titulo = 'Calibración presupuestos ' . $i . ' presupuesto: $ ' . number_format($presupuesto,2);
                    $objetivo = 'Verificar el manejo de los presupuesto del componente '. $i . 'asociados al valor de presupuesto : $ '.  number_format($presupuesto,2);
                    $fec_creacion = '2024-'.rand(4, 5).'-' . rand(1, 20);
                }
                array_push($datas, [
                    'proyectos_id' => intval($proyecto->id),
                    'config_usuario_id' => $config_usuario_id,
                    'titulo' => $titulo,
                    'fec_creacion' => $fec_creacion,
                    'objetivo' => $objetivo,
                    'impacto' => $impacto,
                    'impacto_num' => $impacto_num,
                    'presupuesto' => $presupuesto,
                ]);
            }
        }
        foreach ($datas as $data) {
            DB::table('proy_componentes')->insert([
                'proyectos_id' => $data['proyectos_id'],
                'config_usuario_id' => $data['config_usuario_id'],
                'titulo' => $data['titulo'],
                'fec_creacion' => $data['fec_creacion'],
                'objetivo' => $data['objetivo'],
                'impacto' => $data['impacto'],
                'impacto_num' => $data['impacto_num'],
                'presupuesto' => $data['presupuesto'],
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
                'titulo' => 'Se te asigno un nuevo componente',
                'mensaje' => 'Se creo un nuevo componente '.$data['titulo'].' y te fue asignado ',
                'link' => route('proyecto.gestion',['id' => $data['proyectos_id'] ]),
                'id_link' => $data['proyectos_id'],
                'tipo' => 'componente',
                'accion' => 'creacion',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
