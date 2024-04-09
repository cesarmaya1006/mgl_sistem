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
        Schema::create('proyecto_miembros', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('config_usuario_id');
            $table->foreign('config_usuario_id', 'fk_config_miembros_proyectos')->references('id')->on('config_usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('proyectos_id');
            $table->foreign('proyectos_id', 'fk_proyectos_config_usuario')->references('id')->on('proyectos')->onDelete('restrict')->onUpdate('restrict');
            $table->string('estado', 20)->default('activo');
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
        Schema::dropIfExists('proyecto_miembros');
    }
};
