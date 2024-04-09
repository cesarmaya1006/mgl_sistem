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
        Schema::create('empresa_empleados', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->foreign('id', 'fk_crm_config_usuario_usuario')->references('id')->on('config_usuario')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('empresa_cargo_id');
            $table->foreign('empresa_cargo_id', 'fk_crm_empresa_cargo_usuario')->references('id')->on('empresa_cargo')->onDelete('restrict')->onUpdate('restrict');
            $table->boolean('mgl')->default(0)->nullable();
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
        Schema::dropIfExists('empresa_empleados');
    }
};
