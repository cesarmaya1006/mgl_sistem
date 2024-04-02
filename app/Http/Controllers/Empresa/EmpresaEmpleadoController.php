<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracion\ValidacionEmpresasUsuarios;
use App\Models\Configuracion\ConfigTipoDocumento;
use App\Models\Configuracion\ConfigUsuario;
use App\Models\Configuracion\GrupoEmpresa;
use App\Models\Empresa\EmpresaCargo;
use App\Models\Empresa\EmpresaEmpleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Laravel\Facades\Image;


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
        $tiposdocu = ConfigTipoDocumento::get();
        if (session('rol_id')<3) {
            $grupos = GrupoEmpresa::get();
            return view('intranet.empresa.empleado.crear',compact('grupos','tiposdocu'));
        } else {
            # code...
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidacionEmpresasUsuarios $request)
    {
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('foto')) {
            $ruta = Config::get('constantes.folder_img_usuarios');
            $ruta = trim($ruta);

            $foto = $request->foto;
            $imagen_foto = Image::read($foto);
            $nombrefoto = time() . $foto->getClientOriginalName();
            $imagen_foto->resize(400, 500);
            $imagen_foto->save($ruta . $nombrefoto, 100);
            $usuario_new['foto'] = $nombrefoto;
        }else{
            $usuario_new['foto'] = 'usuario-inicial.jpg';
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $usuario_new['config_tipo_documento_id'] = $request['config_tipo_documento_id'];
        $usuario_new['config_empresa_id'] = $request['config_empresa_id'];
        $usuario_new['identificacion'] = $request['identificacion'];
        $usuario_new['nombres'] = ucwords($request['nombres']);
        $usuario_new['apellidos'] = ucwords($request['apellidos']);
        $usuario_new['email'] = $request['email'];
        $usuario_new['telefono'] = $request['telefono'];
        $usuario_new['password'] = bcrypt($request['identificacion']);
        $usuario_new['direccion'] = $request['direccion'];
        $usuario_new['camb_password'] = 1;
        $roles =[5];
        $usuario = ConfigUsuario::create($usuario_new);
        $usuario->rol()->sync($roles);
        $empleado_new['id'] = $usuario->id;
        $empleado_new['empresa_cargo_id'] = $request['empresa_cargo_id'];
        $usuario = EmpresaEmpleado::create($empleado_new);
        //-------------------------------------------------------------------------------
        return redirect('dashboard/configuracion/empleados')->with('mensaje', 'Empleado creado con éxito');

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
    public function edit($id)
    {
        $tiposdocu = ConfigTipoDocumento::get();
        $usuario_edit = ConfigUsuario::findOrFail($id);
        if (session('rol_id')<3) {
            $grupos = GrupoEmpresa::get();
            return view('intranet.empresa.empleado.editar',compact('grupos','tiposdocu','usuario_edit'));
        } else {
            # code...
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidacionEmpresasUsuarios $request, $id)
    {
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('foto')) {
            $ruta = Config::get('constantes.folder_img_usuarios');
            $ruta = trim($ruta);

            $foto = $request->foto;
            $imagen_foto = Image::read($foto);
            $nombrefoto = time() . $foto->getClientOriginalName();
            $imagen_foto->resize(400, 500);
            $imagen_foto->save($ruta . $nombrefoto, 100);
            $usuario_update['foto'] = $nombrefoto;
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $usuario_update['config_tipo_documento_id'] = $request['config_tipo_documento_id'];
        $usuario_update['config_empresa_id'] = $request['config_empresa_id'];
        $usuario_update['identificacion'] = $request['identificacion'];
        $usuario_update['nombres'] = ucwords($request['nombres']);
        $usuario_update['apellidos'] = ucwords($request['apellidos']);
        $usuario_update['email'] = $request['email'];
        $usuario_update['telefono'] = $request['telefono'];
        $usuario_update['password'] = bcrypt($request['identificacion']);
        $usuario_update['direccion'] = $request['direccion'];
        $usuario_update['camb_password'] = 1;
        ConfigUsuario::findOrFail($id)->update($usuario_update);
        $empleado_update['empresa_cargo_id'] = $request['empresa_cargo_id'];
        EmpresaEmpleado::findOrFail($id)->update($empleado_update);
        //-------------------------------------------------------------------------------
        return redirect('dashboard/configuracion/empleados')->with('mensaje', 'Empleado actualizado con éxito');
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
