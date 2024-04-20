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
        Schema::create('proy_notificaciones', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('config_usuario_id');
            $table->foreign('config_usuario_id', 'fk_config_usuario_notificaciones')->references('id')->on('config_usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->dateTime('fec_creacion');
            $table->string('titulo', 255);
            $table->longText('mensaje');
            $table->string('link', 255);
            $table->string('id_link', 255);
            $table->string('tipo', 50);
            $table->string('accion', 50);
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('proy_notificaciones');
    }
};
