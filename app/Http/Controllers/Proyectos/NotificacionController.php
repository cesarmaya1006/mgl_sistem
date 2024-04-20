<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyectos\Notificacion;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getnotificaciones(Request $request, $id)
    {
        if ($request->ajax()) {
            return response()->json(['notificaciones' => Notificacion::where('config_usuario_id', $id)->where('estado', 1)->orderBy('fec_creacion', 'desc')->get(), 'cant_notificaciones' => Notificacion::where('config_usuario_id', $id)->where('estado', 1)->count()]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function readnotificaciones(Request $request)
    {
        if ($request->ajax()) {
            $notificacion_update['estado'] = 0;
            Notificacion::findOrFail($_GET['id'])->update($notificacion_update);
            return response()->json(['mensaje' => 'ok']);
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($notificacion)
    {
        Notificacion::create($notificacion);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notificacion $notificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notificacion $notificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notificacion $notificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notificacion $notificacion)
    {
        //
    }
}
