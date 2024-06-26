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
    //----------------------------------------------------------------------------------
    public function miembros_proyecto()
    {
        return $this->belongsToMany(ConfigUsuario::class, 'proyecto_miembros','proyectos_id', 'config_usuario_id')->withPivot('estado');
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function componentes()
    {
        return $this->hasMany(Componente::class, 'proyectos_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function adiciones()
    {
        return $this->hasMany(AdicionProyecto::class, 'proyectos_id', 'id');
    }
    //----------------------------------------------------------------------------------

}
