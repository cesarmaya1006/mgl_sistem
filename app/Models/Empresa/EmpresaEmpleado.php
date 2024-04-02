<?php

namespace App\Models\Empresa;

use App\Models\Configuracion\ConfigUsuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmpresaEmpleado extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'empresa_empleados';
    protected $guarded = [];

    //----------------------------------------------------------------------------------
    public function usuario()
    {
        return $this->hasOne(ConfigUsuario::class, 'id');
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function cargo()
    {
        return $this->belongsTo(EmpresaCargo::class, 'empresa_cargo_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
