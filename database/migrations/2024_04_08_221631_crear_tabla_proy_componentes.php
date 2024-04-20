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
        Schema::create('proy_componentes', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('proyectos_id');
            $table->foreign('proyectos_id', 'fk_proyecto_componentes')->references('id')->on('proyectos')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('config_usuario_id');
            $table->foreign('config_usuario_id', 'fk_config_usuario_componente')->references('id')->on('config_usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->string('titulo', 255);
            $table->date('fec_creacion');
            $table->longText('objetivo');
            $table->string('estado', 20)->default('Activo');
            $table->string('impacto', 10);
            $table->integer('impacto_num')->default(0);
            $table->double('progreso')->default(0);
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
        Schema::dropIfExists('proy_componentes');
    }
};
