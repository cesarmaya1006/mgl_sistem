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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('titulo', 255);
            $table->date('fec_creacion');
            $table->date('fec_cierre')->nullable();
            $table->longText('objetivo');
            $table->unsignedBigInteger('config_empresa_id');
            $table->foreign('config_empresa_id', 'fk_config_empresa_proyecto')->references('id')->on('config_empresa')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('config_usuario_id');
            $table->foreign('config_usuario_id', 'fk_config_usuario_proyecto')->references('id')->on('config_usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->string('estado', 20)->default('Activo');
            $table->double('progreso')->default(0);
            $table->double('presupuesto')->default(0);
            $table->double('ejecucion')->default(0);
            $table->double('porc_ejecucion')->default(0);
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
        Schema::dropIfExists('proyectos');
    }
};
