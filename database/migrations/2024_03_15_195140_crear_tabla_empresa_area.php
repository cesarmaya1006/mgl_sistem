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
        Schema::create('empresa_area', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('config_empresa_id');
            $table->foreign('config_empresa_id', 'fk_crm_area_config_empresa')->references('id')->on('config_empresa')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('empresa_area_id')->nullable();
            $table->string('area', 150);
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
        Schema::dropIfExists('empresa_area');
    }
};
