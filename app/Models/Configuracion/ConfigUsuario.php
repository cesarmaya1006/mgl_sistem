<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ConfigUsuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'config_usuario';
    protected $guarded = [];

    public function rol ()
    {
        return $this->belongsToMany(ConfigRol::class,'config_usuario_rol','config_usuario_id','config_rol_id')->withPivot('estado');
    }
}
