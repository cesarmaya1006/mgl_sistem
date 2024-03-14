<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ConfigRol extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'config_rol';
    protected $guarded = [];
}
