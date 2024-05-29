<?php

namespace App\Models\Proyectos;

use App\Models\Configuracion\ConfigUsuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AdicionProyecto extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'adicionpresproy';
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
        return $this->belongsTo(ConfigUsuario::class, 'usuario_id', 'id');
    }
    //--------------------------------------------------------------------------------
}
