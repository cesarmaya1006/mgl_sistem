<?php

namespace App\Models\Empresa;

use App\Models\Configuracion\ConfigEmpresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmpresaArea extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'empresa_area';
    protected $guarded = [];

    //==================================================================================
    public function empresa()
    {
        return $this->belongsTo(ConfigEmpresa::class, 'config_empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //==================================================================================
    public function area_sup($id)
    {
        $padres = $this->where('id',$id)->get();
        return $padres[0]->area;
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function cargos()
    {
        return $this->hasMany(EmpresaCargo::class, 'empresa_area_id', 'id');
    }
    //----------------------------------------------------------------------------------

//==================================================================================

}
