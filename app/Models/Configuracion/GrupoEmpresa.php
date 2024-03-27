<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class GrupoEmpresa extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'config_grupo_empresas';
    protected $guarded = [];

    //==================================================================================
    public function tipos_docu()
    {
        return $this->belongsTo(ConfigTipoDocumento::class, 'config_tipo_documento_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function empresas()
    {
        return $this->hasMany(ConfigEmpresa::class, 'config_grupo_empresas_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
