<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\ConfigUsuario;
use App\Models\Proyectos\Componente;
use App\Models\Proyectos\Historial;
use App\Models\Proyectos\HistorialDoc;
use App\Models\Proyectos\Notificacion;
use App\Models\Proyectos\Proyecto;
use App\Models\Proyectos\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($proy_tareas_id)
    {
        $tarea = Tarea::findOrFail($proy_tareas_id);
        $proyecto = $tarea->componente->proyecto;
        $usuarios = $this->getUsuariosProyectosCrear($proyecto);
        $usuario = ConfigUsuario::findOrFail(session('id_usuario'));
        return view('intranet.proyectos.historial.crear', compact('tarea', 'usuarios', 'usuario'));
    }


    public function historialessubtarea_store(Request $request){
        $tarea = Tarea::findOrFail($request['proy_tareas_id']);
        $historialNew['proy_tareas_id'] = $request['proy_tareas_id'];
        $historialNew['fecha'] = $request['fecha'];
        $historialNew['config_usuario_id'] = $request['config_usuario_id'];
        $historialNew['titulo'] = $request['titulo'];
        $historialNew['usuarioasignado_id'] = $request['usuarioasignado_id'];
        $historialNew['progreso'] = $request['progreso'];
        $historialNew['resumen'] = $request['resumen'];

        $historial = Historial::create($historialNew);

        if ($request->hasFile('doc_historial')) {
            $this->guardar_archivos($request['doc_historial'], $historial->id);
        }

        $this->crearNotificacion('historial', $request['usuarioasignado_id'], $tarea->tarea->componente->proyecto, $request['proy_tareas_id']);
        return redirect('dashboard/proyectos/subtareas/gestion/' . $request['proy_tareas_id'])->with('mensaje', 'historial creado con éxito');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $tarea = Tarea::findOrFail($request['proy_tareas_id']);

        $historialNew['proy_tareas_id'] = $request['proy_tareas_id'];
        $historialNew['fecha'] = $request['fecha'];
        $historialNew['config_usuario_id'] = $request['config_usuario_id'];
        $historialNew['titulo'] = $request['titulo'];
        $historialNew['usuarioasignado_id'] = $request['usuarioasignado_id'];
        $historialNew['progreso'] = $request['progreso'];
        $historialNew['resumen'] = $request['resumen'];
        if ($tarea->componente->presupuesto > 0) {
            $historialNew['costo'] = $request['costo'];
        }

        $historial = Historial::create($historialNew);

        if ($request->hasFile('doc_historial')) {
            $this->guardar_archivos($request['doc_historial'], $historial->id);
        }
        if ($tarea->componente->presupuesto > 0) {
            $tareaUpdate['costo'] = $request['costo'] + $tarea->costo;
            Tarea::findOrFail($request['proy_tareas_id'])->update($tareaUpdate);

            $componente = Componente::findOrFail($tarea->proy_componentes_id);
            $componenteUpdate['ejecucion'] = $request['costo'] + $componente->ejecucion;
            $componenteUpdate['porc_ejecucion'] = (($request['costo'] + $componente->ejecucion) * 100) / $componente->presupuesto;
            Componente::findOrFail($tarea->proy_componentes_id)->update($componenteUpdate);

            $proyecto = Proyecto::findOrFail($componente->proyectos_id);
            $proyectoUpdate['ejecucion'] = $request['costo'] + $proyecto->ejecucion;
            $proyectoUpdate['porc_ejecucion'] = (($request['costo'] + $proyecto->ejecucion) * 100) / $proyecto->presupuesto;
            Proyecto::findOrFail($componente->proyectos_id)->update($proyectoUpdate);
        }
        $this->modificarprogresos($request['progreso'], $request['proy_tareas_id']);
        $this->crearNotificacion('historial', $request['usuarioasignado_id'], $tarea->componente->proyecto, $request['proy_tareas_id']);
        return redirect('dashboard/proyectos/tareas/gestion/' . $request['proy_tareas_id'])->with('mensaje', 'historial creado con éxito');
    }

    public function modificarprogresos($progreso_request, $proy_tareas_id)
    {
        $tareaFind = Tarea::findOrFail($proy_tareas_id);
        $tarea_update['progreso'] = $progreso_request;
        $tarea_update['estado'] = 'Activa';
        Tarea::findOrFail($proy_tareas_id)->update($tarea_update);

        $sumImpacto_numTarea_Componente = $tareaFind->componente->tareas->sum('impacto_num');
        $progesoComponenete = 0;
        foreach ($tareaFind->componente->tareas as $tarea) {
            $progesoComponenete += (($tarea->impacto_num / $sumImpacto_numTarea_Componente) * intval($tarea->progreso));
        }
        $componenteUpdate['progreso'] = $progesoComponenete;
        $componenteUpdate['estado'] = 'Activo';
        Componente::findOrFail($tareaFind->componente->id)->update($componenteUpdate);
        //--------------------------------------------------------------------------------------
        $sumImpacto_numComponente_Proyecto = $tareaFind->componente->proyecto->componentes->sum('impacto_num');
        $progesoProyecto = 0;
        foreach ($tareaFind->componente->proyecto->componentes as $componente) {
            $progesoProyecto += (($componente->impacto_num / $sumImpacto_numComponente_Proyecto) * floatval($componente->progreso));
        }
        $ProyectoUpdate['progreso'] = $progesoProyecto;
        $ProyectoUpdate['estado'] = 'Activo';
        Proyecto::findOrFail($tareaFind->componente->proyecto->id)->update($ProyectoUpdate);
    }




    public function crearNotificacion($elemento, $config_usuario_id, $proyecto, $id_link)
    {
        switch ($elemento) {
            case 'historial':
                $titulo = 'Se creo un historial';
                $mensaje = 'Se creo un nuevo historiala la tarea del proyecto ' . $proyecto->titulo . ' y te fue asignada -> ' . ucfirst($titulo);
                $link = route('tarea.gestion', ['id' => $id_link]);
                $id_link_upd = $id_link;
                $tipo = 'historial';
                $accion = 'creacion';
                break;
            default:
                # code...
                break;
        }
        //----------------------------------------------------------------------------------------------------
        $dia_hora = date('Y-m-d H:i:s');
        $notificacion['config_usuario_id'] =  $config_usuario_id;
        $notificacion['fec_creacion'] =  $dia_hora;
        $notificacion['titulo'] =  $titulo;
        $notificacion['mensaje'] = $mensaje;
        $notificacion['link'] =  $link;
        $notificacion['id_link'] =  $id_link_upd;
        $notificacion['tipo'] =  $tipo;
        $notificacion['accion'] =  $accion;
        Notificacion::create($notificacion);
        //----------------------------------------------------------------------------------------------------
    }

    public function guardar_archivos($doc_historial, $proy_historiales_id)
    {
        $i = 0;
        //dd($doc_historial);
        foreach ($doc_historial as $archivo) {
            $i++;
            $extension = $archivo->extension();
            $titulo = utf8_encode(utf8_decode($archivo->getClientOriginalName()));
            $tipo = $this->mime_content_type($titulo);
            $url = time() . '-' . utf8_encode(utf8_decode($archivo->getClientOriginalName()));
            $peso = filesize($archivo) / 1000000;
            $new_proy_historialdoc['proy_historiales_id'] = $proy_historiales_id;
            $new_proy_historialdoc['titulo'] = $titulo;
            $new_proy_historialdoc['tipo'] = $tipo;
            $new_proy_historialdoc['url'] = $url;
            $new_proy_historialdoc['peso'] = $peso;
            // - - - - - - - - - - - - - - - - - - - - - - - -
            $ruta = Config::get('constantes.folder_doc_historial');
            $ruta = trim($ruta);
            $doc_subido = $archivo;
            $doc_subido->move($ruta, $url);
            // - - - - - - - - - - - - - - - - - - - - - - - -
            HistorialDoc::create($new_proy_historialdoc);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Historial $historial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Historial $historial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Historial $historial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Historial $historial)
    {
        //
    }

    public function getUsuariosProyectosCrear($proyecto)
    {
        $usuarios1 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', $proyecto->config_empresa_id)->where('estado', 1)->whereHas('rol', function ($p) {
            $p->where('config_rol_id', 4);
        })->get();
        $usuarios2 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', '!=', $proyecto->config_empresa_id)->where('estado', 1)->whereHas('empresas_tranv', function ($q) use ($proyecto) {
            $q->where('config_empresa_id', $proyecto->config_empresa_id);
        })->whereHas('rol', function ($p) {
            $p->where('config_rol_id', 4);
        })->get();
        return  $usuarios1->concat($usuarios2);
    }

    public function mime_content_type($filename)
    {

        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'docx' => 'application/msword',
            'rtfx' => 'application/rtf',
            'xlsx' => 'application/vnd.ms-excel',
            'pptx' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = $file_extension = pathinfo($filename, PATHINFO_EXTENSION);;
        if (array_key_exists($file_extension, $mime_types)) {
            return $mime_types[$file_extension];
        } elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        } else {
            return 'application/octet-stream';
        }
    }
}
