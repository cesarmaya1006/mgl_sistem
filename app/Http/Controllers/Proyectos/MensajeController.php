<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\ConfigUsuario;
use App\Models\Proyectos\Mensaje;
use Illuminate\Http\Request;

class MensajeController extends Controller
{

    public function getusuarios(Request $request, $id){
        if ($request->ajax()) {
            $usuario = ConfigUsuario::findOrFail(session('id_usuario'));
            $usuarios = null;
            if (session('rol_id') < 3) {
                $usuarios = ConfigUsuario::get();
            } else {
                $config_empresa_id = $usuario->config_empresa_id;
                $usuarios1 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', $config_empresa_id)->where('estado', 1)->where('lider', 1)->get();
                $usuarios2 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', '!=', $config_empresa_id)->where('estado', 1)->where('lider', 1)->whereHas('empresas_tranv', function ($q) use ($config_empresa_id) {
                    $q->where('config_empresa_id', $config_empresa_id);
                })->get();
                $usuarios = $usuarios1->concat($usuarios2);
            }

            foreach ($usuarios as $usuario) {
                $usuario['cant_sin_leer'] = $usuario->remitentemensajes->where('estado',0)->where('destinatario_id' , session('id_usuario'))->count();
            }

            return response()->json(['usuarios' => $usuarios,'proyectos' => $usuario->proyectos]);
        } else {
            abort(404);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $tipo = $request['tipo_msj'];
            if ($tipo == 'persona') {
                $mensaje_new['fec_creacion'] = date('Y-m-d H:i:s');
                $mensaje_new['remitente_id'] = $request['remitente_id_msj'];
                $mensaje_new['destinatario_id'] = $request['destinatario_id_msj'];
                $mensaje_new['mensaje'] = $request['mensaje_envio'];
                $mensaje_new['tipo'] = $request['tipo_msj'];
            } else {
                $mensaje_new['fec_creacion'] = date('Y-m-d H:i:s');
                $mensaje_new['remitente_id'] = $request['remitente_id_msj'];
                $mensaje_new['proyectos_id'] = $request['proyectos_id_msj'];
                $mensaje_new['mensaje'] = $request['mensaje_envio'];
                $mensaje_new['tipo'] = $request['tipo_msj'];
            }
            $mensaje = Mensaje::create($mensaje_new);
            $mensaje_resp = Mensaje::where('id',$mensaje->id)->with('remitente')->with('destinatario')->first();
            return response()->json(['mensaje' => $mensaje_resp]);
        } else {
            abort(404);
        }
    }


    public function getmensajes_dest_rem(Request $request){
        if ($request->ajax()) {
            $mensajes = Mensaje::where(function ($query) use ($request) {
                $query->where('remitente_id',  $request['remitente_id'])->where('destinatario_id',  $request['destinatario_id']);
            })->orWhere(function ($query) use ($request) {
                $query->where('remitente_id',  $request['destinatario_id'])->where('destinatario_id',  $request['remitente_id']);
            })->with('remitente')->with('destinatario')->orderBy('fec_creacion', 'ASC')->get();
            foreach ($mensajes as $mensaje) {
                if ($mensaje->remitente_id != session('id_usuario')) {
                    $mensajeUpdate['estado'] = 1;
                    Mensaje::findOrfail($mensaje->id)->update($mensajeUpdate);
                }
            }
            return response()->json(['mensajes' => $mensajes]);
        } else {
            abort(404);
        }
    }

    public function getmensajes_dest_rem_ult(Request $request){
        if ($request->ajax()) {
            $mensajes = Mensaje::where(function ($query) use ($request) {
                $query->where('remitente_id',  $request['remitente_id'])->where('destinatario_id',  $request['destinatario_id']);
            })->orWhere(function ($query) use ($request) {
                $query->where('remitente_id',  $request['destinatario_id'])->where('destinatario_id',  $request['remitente_id']);
            })->with('remitente')->with('destinatario')->orderBy('fec_creacion', 'ASC')->get();
            $mensaje = $mensajes->last();
            if ($mensaje->remitente_id != session('id_usuario')) {
                $mensajeUpdate['estado'] = 1;
                //Mensaje::findOrfail($mensaje->id)->update($mensajeUpdate);
            }
            return response()->json(['mensaje' => $mensaje]);
        } else {
            abort(404);
        }
    }

    public function get_all_nuevos_mensajes(Request $request){
        if ($request->ajax()) {
            $mensaje_sin_leer_cant = Mensaje::where('destinatario_id',session('id_usuario'))->where('estado',0)->count();
            $mensaje_sin_leer = Mensaje::where('destinatario_id',session('id_usuario'))->where('estado',0)->with('remitente')->get();
            return response()->json(['mensaje_sin_leer' => $mensaje_sin_leer,'mensaje_sin_leer_cant' => $mensaje_sin_leer_cant]);
        } else {
            abort(404);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
