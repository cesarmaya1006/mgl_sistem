<?php

namespace App\Models\Proyectos;

use App\Models\Configuracion\ConfigUsuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Notificacion extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'proy_notificaciones';
    protected $guarded = [];
    //--------------------------------------------------------------------------------
    public function usuario()
    {
        return $this->belongsTo(ConfigUsuario::class, 'config_usuario_id', 'id');
    }
    //--------------------------------------------------------------------------------
}
