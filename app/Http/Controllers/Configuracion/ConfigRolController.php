<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracion\ValidacionConfigRol;
use App\Models\Configuracion\ConfigRol;
use Illuminate\Http\Request;

class ConfigRolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = ConfigRol::orderBy('id')->get();
        return view('intranet.config.rol.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('intranet.config.rol.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidacionConfigRol  $request)
    {
        $request['slug'] = strtolower(str_replace(" ", "_",$request['nombre']));
        ConfigRol::create($request->all());
        return redirect('dashboard/configuracion/rol')->with('mensaje', 'Rol creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(ConfigRol $configRol)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rol = ConfigRol::findOrFail($id);
        return view('intranet.config.rol.editar', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidacionConfigRol $request, $id)
    {
        $request['slug'] = strtolower(str_replace(" ", "_",$request['nombre']));
        ConfigRol::findOrFail($id)->update($request->all());
        return redirect('dashboard/configuracion/rol')->with('mensaje', 'Rol actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            if (ConfigRol::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
