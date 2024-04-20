<?php

namespace App\Models\Proyectos;

use App\Models\Configuracion\ConfigUsuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tarea extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'proy_tareas';
    protected $guarded = [];
    //--------------------------------------------------------------------------------
    public function componente()
    {
        return $this->belongsTo(Componente::class, 'proy_componentes_id', 'id');
    }
    //--------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------
    public function responsable()
    {
        return $this->belongsTo(ConfigUsuario::class, 'config_usuario_id', 'id');
    }
    //--------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function historiales()
    {
        return $this->hasMany(Historial::class, 'proy_tareas_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
