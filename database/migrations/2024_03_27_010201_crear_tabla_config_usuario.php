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
        Schema::create('config_usuario', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('config_tipo_documento_id')->nullable();
            $table->foreign('config_tipo_documento_id', 'fk_mrc_config_tipo_documento_usuario')->references('id')->on('config_tipo_documento')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('config_empresa_id')->nullable();
            $table->foreign('config_empresa_id', 'fk_crm_config_empresa_usuario')->references('id')->on('config_empresa')->onDelete('restrict')->onUpdate('restrict');
            $table->string('identificacion', 100)->unique()->nullable();
            $table->string('nombres', 150);
            $table->string('apellidos', 150)->nullable();
            $table->string('email',150)->unique();
            $table->string('telefono', 50)->nullable();
            $table->string('password', 150);
            $table->string('direccion', 200)->nullable();
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->boolean('camb_password')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('estado')->default(1);
            $table->string('foto', 255)->default('usuario-inicial.jpg');
            $table->rememberToken();
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
        Schema::dropIfExists('config_usuario');
    }
};
