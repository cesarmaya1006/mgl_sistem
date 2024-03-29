<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracion\ValidacionConfigEmpresa;
use App\Models\Configuracion\ConfigEmpresa;
use App\Models\Configuracion\ConfigTipoDocumento;
use App\Models\Configuracion\GrupoEmpresa;
use Illuminate\Http\Request;

class ConfigEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = ConfigEmpresa::orderBy('id')->get();
        return view('intranet.config.empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposdocu = ConfigTipoDocumento::get();
        $grupos = GrupoEmpresa::get();
        return view('intranet.config.empresas.crear',compact('tiposdocu','grupos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidacionConfigEmpresa $request)
    {
        ConfigEmpresa::create($request->all());
        return redirect('dashboard/configuracion_sis/empresas')->with('mensaje', 'Empresa creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(ConfigEmpresa $configEmpresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tiposdocu = ConfigTipoDocumento::get();
        $grupos = GrupoEmpresa::get();
        $empresa = ConfigEmpresa::findOrFail($id);
        return view('intranet.config.empresas.editar',compact('tiposdocu','empresa','grupos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidacionConfigEmpresa $request, $id)
    {
        ConfigEmpresa::findOrFail($id)->update($request->all());
        return redirect('dashboard/configuracion_sis/empresas')->with('mensaje', 'Empresa actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $empresa = ConfigEmpresa::FindOrFail($id);
            if ($empresa->areas->count()) {
                return response()->json(['mensaje' => 'ng']);
            } else {
                if (ConfigEmpresa::destroy($id)) {
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
            ConfigEmpresa::findOrFail($id)->update($cambioEstado);
            if ($request['data_estado'] == 0) {
                return response()->json(['mensaje' => 'Desactivada']);
            } else {
                return response()->json(['mensaje' => 'Activada']);
            }
        } else {
            abort(404);
        }
    }

}
