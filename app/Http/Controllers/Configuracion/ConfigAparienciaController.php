<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\ConfigApariencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ConfigAparienciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function body_dark_mode(Request $request)
    {
        if ($request->ajax()) {
            $body_dark_mode_uptade['body_dark_mode'] = $_GET['body_dark_mode'];
            if (session('config_empresa_id') != null) {
                ConfigApariencia::where('config_empresa_id', session('config_empresa_id'))->first()->update($body_dark_mode_uptade);
                $apariencia = ConfigApariencia::where('config_empresa_id', session('config_empresa_id'))->first();
            } else {
                ConfigApariencia::findOrFail(1)->update($body_dark_mode_uptade);
                $apariencia = ConfigApariencia::findOrFail(1);
            }
            $request->session()->forget('apariencia');
            Session::put([
                'apariencia' => $apariencia,
            ]);
            return response()->json(['respuesta' => 'Modo de fondo cambiado correctamente', 'tipo' => 'success']);
        } else {
            abort(404);
        }
    }
    public function cambio_check(Request $request)
    {
        if ($request->ajax()) {
            $aparienciaUptade[$_GET['bd_variable']] = $_GET['valor_fijo'];
            if (session('config_empresa_id') != null) {
                ConfigApariencia::where('config_empresa_id', session('config_empresa_id'))->first()->update($aparienciaUptade);
                $apariencia = ConfigApariencia::where('config_empresa_id', session('config_empresa_id'))->first();
            } else {
                ConfigApariencia::findOrFail(1)->update($aparienciaUptade);
                $apariencia = ConfigApariencia::findOrFail(1);
            }
            $request->session()->forget('apariencia');
            Session::put([
                'apariencia' => $apariencia,
            ]);
            return response()->json(['respuesta' => 'cambio realizado correctamente', 'tipo' => 'success']);
        } else {
            abort(404);
        }
    }
    public function fondomenu_sup(Request $request)
    {
        if ($request->ajax()) {
            $aparienciaUptade['fondo_barra_sup'] = $_GET['bd_valor'];
            if (session('config_empresa_id') != null) {
                ConfigApariencia::where('config_empresa_id', session('config_empresa_id'))->first()->update($aparienciaUptade);
                $apariencia = ConfigApariencia::where('config_empresa_id', session('config_empresa_id'))->first();
            } else {
                ConfigApariencia::findOrFail(1)->update($aparienciaUptade);
                $apariencia = ConfigApariencia::findOrFail(1);
            }
            $request->session()->forget('apariencia');
            Session::put([
                'apariencia' => $apariencia,
            ]);
            return response()->json(['respuesta' => 'Fondo superior cambiado correctamente', 'tipo' => 'success']);
        } else {
            abort(404);
        }
    }
}
