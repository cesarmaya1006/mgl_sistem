<?php

use App\Models\Proyectos\Notificacion;

trait TraitNotificaciones
{
    function crear_notificacion_trait($notificacion){
        Notificacion::create($notificacion);
    }
}
