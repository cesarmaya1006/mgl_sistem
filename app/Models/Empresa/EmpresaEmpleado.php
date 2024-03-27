<?php

namespace App\Models\Empresa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmpresaEmpleado extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'empresa_cargo';
    protected $guarded = [];

    //----------------------------------------------------------------------------------
    public function cargo()
    {
        return $this->belongsTo(EmpresaCargo::class, 'empresa_cargo_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
