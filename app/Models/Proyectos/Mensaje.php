<?php

namespace App\Models\Proyectos;

use App\Models\Configuracion\ConfigUsuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mensaje extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'mensajes';
    protected $guarded = [];

    //--------------------------------------------------------------------------------
    public function remitente()
    {
        return $this->belongsTo(ConfigUsuario::class, 'remitente_id', 'id');
    }
    //--------------------------------------------------------------------------------
    public function destinatario()
    {
        return $this->belongsTo(ConfigUsuario::class, 'destinatario_id', 'id');
    }
    //--------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
}
