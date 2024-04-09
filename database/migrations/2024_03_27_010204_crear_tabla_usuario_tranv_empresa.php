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
        Schema::create('usuario_tranv_empresa', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('config_usuario_id');
            $table->foreign('config_usuario_id', 'fk_crm_config_usuario_trnv_empresa')->references('id')->on('config_usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('config_empresa_id')->nullable();
            $table->foreign('config_empresa_id', 'fk_crm_config_empresa_usuario_trnv')->references('id')->on('config_empresa')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('usuario_tranv_empresa');
    }
};
