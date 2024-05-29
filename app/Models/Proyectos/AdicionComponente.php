<?php

namespace App\Models\Proyectos;

use App\Models\Configuracion\ConfigUsuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AdicionComponente extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'adicionprescomp';
    protected $guarded = [];
    //--------------------------------------------------------------------------------
    public function componente()
    {
        return $this->belongsTo(Componente::class, 'componente_id', 'id');
    }
    //--------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------
    public function responsable()
    {
        return $this->belongsTo(ConfigUsuario::class, 'usuario_id', 'id');
    }
    //--------------------------------------------------------------------------------
}
