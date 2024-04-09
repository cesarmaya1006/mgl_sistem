<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\ConfigUsuario;
use App\Models\Configuracion\GrupoEmpresa;
use App\Models\Proyectos\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session('rol_id')<3) {
            $grupos = GrupoEmpresa::get();
            return view('intranet.proyectos.proyecto.index_admin',compact('grupos'));
        } else {
            # code...
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (session('rol_id')<3) {
            $grupos = GrupoEmpresa::get();
            return view('intranet.proyectos.proyecto.crear',compact('grupos'));
        } else {
            # code...
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Proyecto::create($request->all());
        return redirect('dashboard/proyectos')->with('mensaje', 'Proyecto creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $proyecto = Proyecto::findOrfail($id);
        return view('intranet.proyectos.proyecto.detalle',compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        //
    }

    public function getproyectos(Request $request,$estado,$config_empresa_id){
        if ($request->ajax()) {
            if ($estado =='todos') {
                return response()->json(['proyectos' => Proyecto::where('config_empresa_id',$config_empresa_id)->with('miembros_proyecto')->with('lider')->get()]);
            } else {
                return response()->json(['proyectos' => Proyecto::where('config_empresa_id',$config_empresa_id)->where('estado',$estado)->with('miembros_proyecto')->with('lider')->get()]);
            }
        } else {
            abort(404);
        }
    }


}
