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
        Schema::create('proy_tareas', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('proy_tareas_id')->nullable();
            $table->foreign('proy_tareas_id', 'fk_proy_tareas_tarea')->references('id')->on('proy_tareas')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('proy_componentes_id')->nullable();
            $table->foreign('proy_componentes_id', 'fk_proy_componentes_tarea')->references('id')->on('proy_componentes')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('config_usuario_id');
            $table->foreign('config_usuario_id', 'fk_config_usuario_tarea')->references('id')->on('config_usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->string('titulo', 255);
            $table->date('fec_creacion');
            $table->date('fec_limite');
            $table->date('fec_finalizacion')->nullable();
            $table->longText('objetivo');
            $table->bigInteger('progreso')->default(0);
            $table->string('estado', 20)->default('Activa');
            $table->string('impacto', 10)->nullable();
            $table->integer('impacto_num')->default(0)->nullable();
            $table->double('costo')->default(0)->nullable();
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
        Schema::dropIfExists('proy_tareas');
    }
};
