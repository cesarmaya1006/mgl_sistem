<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracion\ValidacionEmpresasCargos;
use App\Models\Configuracion\ConfigEmpresa;
use App\Models\Configuracion\GrupoEmpresa;
use App\Models\Empresa\EmpresaArea;
use App\Models\Empresa\EmpresaCargo;
use Illuminate\Http\Request;

class EmpresaCargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session('rol_id')<3) {
            $grupos = GrupoEmpresa::get();
        } else {
            # code...
        }
        return view('intranet.empresa.cargo.index',compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (session('rol_id')<3) {
            $grupos = GrupoEmpresa::get();
            return view('intranet.empresa.cargo.crear',compact('grupos'));
        } else {
            # code...
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidacionEmpresasCargos $request)
    {
        EmpresaCargo::create($request->all());
        return redirect('dashboard/configuracion/cargos')->with('mensaje', 'Cargo creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmpresaCargo $empresaCargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cargo_edit = EmpresaCargo::findOrFail($id);
        if (session('rol_id')<3) {
            $grupos = GrupoEmpresa::get();
            $empresas = ConfigEmpresa::get();
            $areas = EmpresaArea::get();
            return view('intranet.empresa.cargo.editar',compact('grupos','empresas','areas','cargo_edit','id'));
        } else {
            # code...
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidacionEmpresasCargos $request, $id)
    {
        EmpresaCargo::findOrFail($id)->update($request->all());
        return redirect('dashboard/configuracion/cargos')->with('mensaje', 'Cargo actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            if (EmpresaCargo::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
