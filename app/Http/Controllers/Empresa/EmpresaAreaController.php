<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracion\ValidacionEmpresaArea;
use App\Models\Configuracion\ConfigEmpresa;
use App\Models\Empresa\EmpresaArea;
use Illuminate\Http\Request;

class EmpresaAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = EmpresaArea::get();
        if (session('rol_id')<3) {
            $empresas = ConfigEmpresa::get();
        } else {
            # code...
        }

        return view('intranet.empresa.area.index',compact('empresas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empresas = ConfigEmpresa::get();
        $areas = EmpresaArea::get();
        return view('intranet.empresa.area.crear',compact('empresas','areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidacionEmpresaArea $request)
    {
        EmpresaArea::create($request->all());
        return redirect('dashboard/configuracion/areas')->with('mensaje', 'Area creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmpresaArea $empresaArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $area_edit = EmpresaArea::findOrFail($id);
        $empresas = ConfigEmpresa::get();
        $areas = EmpresaArea::where('config_empresa_id',$area_edit->config_empresa_id)->get();
        return view('intranet.empresa.area.editar',compact('empresas','areas','area_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidacionEmpresaArea $request, $id)
    {
        EmpresaArea::findOrFail($id)->update($request->all());
        return redirect('dashboard/configuracion/areas')->with('mensaje', 'Área actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            if (EmpresaArea::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }

    public function getDependencias(Request $request,$id){
        if ($request->ajax()) {
            return response()->json(['dependencias' => EmpresaArea::where('empresa_area_id',$id)->get()]);
        } else {
            abort(404);
        }
    }
    public function getAreas(Request $request){
        if ($request->ajax()) {
            return response()->json(['areasPadre' => EmpresaArea::where('config_empresa_id',$_GET['id'])->get()]);
        } else {
            abort(404);
        }
    }

}
