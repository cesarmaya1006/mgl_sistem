<?php

namespace App\Models\Empresa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmpresaCargo extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'empresa_cargo';
    protected $guarded = [];

    //----------------------------------------------------------------------------------
    public function area()
    {
        return $this->belongsTo(EmpresaArea::class, 'empresa_area_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function cargos()
    {
        return $this->hasMany(EmpresaEmpleado::class, 'empresa_cargo_id', 'id');
    }
    //----------------------------------------------------------------------------------

}
