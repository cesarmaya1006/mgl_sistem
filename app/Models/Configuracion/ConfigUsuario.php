<?php

namespace App\Models\Configuracion;

use App\Models\Empresa\EmpresaEmpleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;

class ConfigUsuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'config_usuario';
    protected $guarded = [];


    //==================================================================================
    public function tipos_docu()
    {
        return $this->belongsTo(ConfigTipoDocumento::class, 'config_tipo_documento_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function rol()
    {
        return $this->belongsToMany(ConfigRol::class, 'config_usuario_rol', 'config_usuario_id', 'config_rol_id')->withPivot('estado');
    }
    public function empleado()
    {
        return $this->belongsTo(EmpresaEmpleado::class, 'id');
    }
    //----------------------------------------------------------------------------------
    public function empresa()
    {
        return $this->belongsTo(ConfigEmpresa::class, 'config_empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //==================================================================================
    public function setSession()
    {
        Session::put([
            'id_usuario' => $this->id,
            'config_empresa_id' => $this->config_empresa_id,
            'config_tipo_documento_id' => $this->config_tipo_documento_id,
            'identificacion' => $this->identificacion,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'estado' => $this->estado,
            'foto' => $this->foto,


        ]);
        if ($this->empleado) {
            Session::put([
            'empresa_cargo_id' => $this->empleado->cargo->cargo,
            'mgl' => $this->empleado->mgl?1:0,
            ]);
        }
        if ($this->empresa) {
            Session::put([
                'empresa' => $this->empresa->nombres,
            ]);
        }
        if ($this->config_empresa_id!=null) {
            $apariencia = ConfigApariencia::where('config_empresa_id',$this->config_empresa_id)->first();
        } else {
            $apariencia = ConfigApariencia::findOrFail(1);
        }
        Session::put([
            'apariencia' => $apariencia,
        ]);

    }
    //==========================================================================================
}
