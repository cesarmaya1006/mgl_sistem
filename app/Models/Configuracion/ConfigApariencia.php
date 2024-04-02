<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ConfigApariencia extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'config_apariencia';
    protected $guarded = [];

    //==================================================================================
    public function empresa()
    {
        return $this->belongsTo(ConfigEmpresa::class, 'config_empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
