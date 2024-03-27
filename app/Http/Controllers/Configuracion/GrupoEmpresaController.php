<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracion\ValidacionGrupoEmpresas;
use App\Models\Configuracion\ConfigEmpresa;
use App\Models\Configuracion\ConfigTipoDocumento;
use App\Models\Configuracion\GrupoEmpresa;
use Illuminate\Http\Request;

class GrupoEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos = GrupoEmpresa::orderBy('id')->get();
        return view('intranet.config.grupo_empresas.index', compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposdocu = ConfigTipoDocumento::get();
        return view('intranet.config.grupo_empresas.crear',compact('tiposdocu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidacionGrupoEmpresas $request)
    {
        GrupoEmpresa::create($request->all());
        return redirect('dashboard/configuracion_sis/grupo_empresas')->with('mensaje', 'Grupo Empresarial creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(GrupoEmpresa $grupoEmpresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $tiposdocu = ConfigTipoDocumento::get();
        $grupo = GrupoEmpresa::findOrFail($id);
        return view('intranet.config.grupo_empresas.editar',compact('tiposdocu','grupo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidacionGrupoEmpresas $request, $id)
    {
        GrupoEmpresa::findOrFail($id)->update($request->all());
        return redirect('dashboard/configuracion_sis/grupo_empresas')->with('mensaje', 'Grupo Empresarial actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $grupo = GrupoEmpresa::FindOrFail($id);
            if ($grupo->empresas->count()) {
                return response()->json(['mensaje' => 'ng']);
            } else {
                if (GrupoEmpresa::destroy($id)) {
                    return response()->json(['mensaje' => 'ok']);
                } else {
                    return response()->json(['mensaje' => 'ng']);
                }
            }

        } else {
            abort(404);
        }
    }

    public function activar(Request $request,$id){
        if ($request->ajax()) {
            $cambioEstado['estado'] = $request['data_estado'];
            GrupoEmpresa::findOrFail($id)->update($cambioEstado);
            if ($request['data_estado'] == 0) {
                return response()->json(['mensaje' => 'Desactivada']);
            } else {
                return response()->json(['mensaje' => 'Activada']);
            }
        } else {
            abort(404);
        }
    }

    public function getEmpresas(Request $request){
        if ($request->ajax()) {
            return response()->json(['empresas' => ConfigEmpresa::where('config_grupo_empresas_id',$_GET['id'])->get()]);
        } else {
            abort(404);
        }
    }
}
