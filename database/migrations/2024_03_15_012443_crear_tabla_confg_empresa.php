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
        Schema::create('config_empresa', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('config_tipo_documento_id');
            $table->foreign('config_tipo_documento_id', 'fk_crm_empresas_config_tipo_documento')->references('id')->on('config_tipo_documento')->onDelete('restrict')->onUpdate('restrict');
            $table->string('identificacion', 100)->unique();
            $table->string('nombres', 150);
            $table->string('email',150)->unique();
            $table->string('telefono', 50)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->string('contacto', 200)->nullable();
            $table->string('cargo', 200)->nullable();
            $table->bigInteger('estado')->default(1);
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
        Schema::dropIfExists('config_empresa');
    }
};
