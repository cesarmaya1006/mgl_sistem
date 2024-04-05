<?php

namespace App\Models\Proyectos;

use App\Models\Configuracion\ConfigEmpresa;
use App\Models\Configuracion\ConfigUsuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Proyecto extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'proyectos';
    protected $guarded = [];

    //--------------------------------------------------------------------------------
    public function empresa()
    {
        return $this->belongsTo(ConfigEmpresa::class, 'config_empresa_id', 'id');
    }
    //--------------------------------------------------------------------------------
    public function lider()
    {
        return $this->belongsTo(ConfigUsuario::class, 'config_usuario_id', 'id');
    }
    //--------------------------------------------------------------------------------

}
