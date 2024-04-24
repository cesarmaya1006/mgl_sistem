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
        Schema::create('proy_historialdoc', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('proy_historiales_id');
            $table->foreign('proy_historiales_id', 'fk_proy_historiales_proy_historialdoc')->references('id')->on('proy_historiales')->onDelete('restrict')->onUpdate('restrict');
            $table->string('titulo', 255);
            $table->string('tipo', 50);
            $table->string('url', 255);
            $table->double('peso', 255);
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
        Schema::dropIfExists('proy_historialdoc');
    }
};
