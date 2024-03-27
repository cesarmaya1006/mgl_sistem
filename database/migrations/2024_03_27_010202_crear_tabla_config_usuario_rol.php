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
        Schema::create('config_usuario_rol', function (Blueprint $table) {
            $table->unsignedBigInteger('config_rol_id');
            $table->foreign('config_rol_id', 'fk_mcr_config_rol_usuario')->references('id')->on('config_rol')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('config_usuario_id');
            $table->foreign('config_usuario_id', 'fk_mcr_config_usuario_rol')->references('id')->on('config_usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->boolean('estado')->default('1');
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
        Schema::dropIfExists('config_usuario_rol');
    }
};
