<?php

namespace App\Models\Configuracion;

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

    public function rol()
    {
        return $this->belongsToMany(ConfigRol::class, 'config_usuario_rol', 'config_usuario_id', 'config_rol_id')->withPivot('estado');
    }


    //==================================================================================
    public function setSession()
    {
        Session::put([
            'id_usuario' => $this->id,
            'config_tipo_documento_id' => $this->config_tipo_documento_id,
            'identificacion' => $this->identificacion,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
        ]);
    }
    //==========================================================================================
}
