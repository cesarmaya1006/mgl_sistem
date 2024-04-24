<?php

namespace App\Models\Proyectos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HistorialDoc extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'proy_historialdoc';
    protected $guarded = [];
    //--------------------------------------------------------------------------------
    public function historial()
    {
        return $this->belongsTo(Historial::class, 'proy_historiales_id', 'id');
    }
    //--------------------------------------------------------------------------------
}
