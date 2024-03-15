<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\ConfigMenu;
use App\Models\Configuracion\ConfigRol;
use Illuminate\Http\Request;

class ConfigMenuRolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rols = ConfigRol::orderBy('id')->pluck('nombre', 'id')->toArray();
        $menus = ConfigMenu::getMenu();
        $menusRols = ConfigMenu::with('roles')->get()->pluck('roles', 'id')->toArray();
        return view('intranet.config.menu_rol.index', compact('rols', 'menus', 'menusRols'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $menus = new ConfigMenu();
            if ($request->input('estado') == 1) {
                $menus->find($request->input('config_menu_id'))->roles()->attach($request->input('config_rol_id'));
                return response()->json(['respuesta' => 'El rol se asigno correctamente','tipo'=> 'success']);
            } else {
                $menus->find($request->input('config_menu_id'))->roles()->detach($request->input('config_rol_id'));
                return response()->json(['respuesta' => 'El rol se elimino correctamente','tipo'=> 'warning']);
            }
        } else {
            abort(404);
        }
    }
}
