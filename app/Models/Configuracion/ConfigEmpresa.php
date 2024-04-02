<?php

namespace App\Models\Configuracion;

use App\Models\Empresa\EmpresaArea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ConfigEmpresa extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'config_empresa';
    protected $guarded = [];

    //==================================================================================
    public function tipos_docu()
    {
        return $this->belongsTo(ConfigTipoDocumento::class, 'config_tipo_documento_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function grupo()
    {
        return $this->belongsTo(GrupoEmpresa::class, 'config_grupo_empresas_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function areas()
    {
        return $this->hasMany(EmpresaArea::class, 'config_empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function apariencias()
    {
        return $this->hasMany(ConfigApariencia::class, 'config_empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function usuarios()
    {
        return $this->hasMany(ConfigUsuario::class, 'config_empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
