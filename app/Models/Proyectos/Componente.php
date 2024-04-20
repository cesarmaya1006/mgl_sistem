<?php

namespace App\Models\Proyectos;

use App\Models\Configuracion\ConfigUsuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Componente extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'proy_componentes';
    protected $guarded = [];
    //--------------------------------------------------------------------------------
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyectos_id', 'id');
    }
    //--------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------
    public function responsable()
    {
        return $this->belongsTo(ConfigUsuario::class, 'config_usuario_id', 'id');
    }
    //--------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'proy_componentes_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
