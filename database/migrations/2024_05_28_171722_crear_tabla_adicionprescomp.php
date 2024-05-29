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
        Schema::create('adicionprescomp', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id', 'fk_config_usuario_componente_adicion')->references('id')->on('config_usuario')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('componente_id')->nullable();
            $table->foreign('componente_id', 'fk_componente_adicion')->references('id')->on('proy_componentes')->onDelete('cascade')->onUpdate('cascade');
            $table->double('adicion');
            $table->date('fecha');
            $table->longText('justificacion');
            $table->boolean('estado')->default(0);
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
        Schema::dropIfExists('adicionprescomp');
    }
};
