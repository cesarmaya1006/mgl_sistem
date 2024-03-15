<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\ConfigEmpresa;
use App\Models\Configuracion\ConfigTipoDocumento;
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
        return view('intranet.config.empresas.crear',compact('tiposdocu'));
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
    public function show(ConfigEmpresa $configEmpresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConfigEmpresa $configEmpresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConfigEmpresa $configEmpresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConfigEmpresa $configEmpresa)
    {
        //
    }
}
