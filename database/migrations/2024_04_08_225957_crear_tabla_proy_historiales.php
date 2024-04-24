<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proy_historiales', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('proy_tareas_id');
            $table->foreign('proy_tareas_id', 'fk_proy_tareas_historial')->references('id')->on('proy_tareas')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('config_usuario_id');
            $table->foreign('config_usuario_id', 'fk_config_usuario_historial')->references('id')->on('config_usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('usuarioasignado_id');
            $table->foreign('usuarioasignado_id', 'fk_usuarioasignado_tarea')->references('id')->on('config_usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->string('titulo', 255);
            $table->date('fecha');
            $table->longText('resumen');
            $table->bigInteger('progreso')->default(0);
            $table->double('costo')->default(0);
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proy_historiales');
    }
};
