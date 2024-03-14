<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\ConfigMenu;
use Illuminate\Http\Request;

class ConfigMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = ConfigMenu::getMenu();
        return view('intranet.config.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(ConfigMenu $configMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConfigMenu $configMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConfigMenu $configMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConfigMenu $configMenu)
    {
        //
    }

    public function guardarOrden(Request $request)
    {
        if ($request->ajax()) {
            $menu = new ConfigMenu();
            $menu->guardarOrden($request->menu);
            return response()->json(['respuesta' => 'ok']);
        } else {
            abort(404);
        }
    }
}
