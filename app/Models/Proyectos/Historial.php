<?php

namespace App\Models\Proyectos;

use App\Models\Configuracion\ConfigUsuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Historial extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'proy_historiales';
    protected $guarded = [];
    //--------------------------------------------------------------------------------
    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'proy_tareas_id', 'id');
    }
    //--------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------
    public function responsable()
    {
        return $this->belongsTo(ConfigUsuario::class, 'config_usuario_id', 'id');
    }
    //--------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------
    public function asignado()
    {
        return $this->belongsTo(ConfigUsuario::class, 'usuarioasignado_id', 'id');
    }
    //--------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function documentos()
    {
        return $this->hasMany(HistorialDoc::class, 'proy_historiales_id', 'id');
    }
    //----------------------------------------------------------------------------------


}
