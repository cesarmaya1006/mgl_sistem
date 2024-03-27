<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\GrupoEmpresa;
use App\Models\Empresa\EmpresaCargo;
use App\Models\Empresa\EmpresaEmpleado;
use Illuminate\Http\Request;

class EmpresaEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session('rol_id')<3) {
            $grupos = GrupoEmpresa::get();
            return view('intranet.empresa.empleado.index',compact('grupos'));
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
            return view('intranet.empresa.empleado.crear',compact('grupos'));
        } else {
            # code...
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EmpresaEmpleado $empresaEmpleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmpresaEmpleado $empresaEmpleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmpresaEmpleado $empresaEmpleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmpresaEmpleado $empresaEmpleado)
    {
        //
    }
    public function getCargos(Request $request){
        if ($request->ajax()) {
            return response()->json(['cargos' => EmpresaCargo::where('empresa_area_id',$_GET['id'])->get()]);
        } else {
            abort(404);
        }
    }
}
