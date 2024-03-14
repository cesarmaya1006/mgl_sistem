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
        Schema::create('config_menu_rol', function (Blueprint $table) {
            $table->unsignedBigInteger('config_menu_id');
            $table->foreign('config_menu_id', 'fk_cmr_configmenu')->references('id')->on('config_menu')->onDelete('cascade')->onUpdate('restrict');
            $table->unsignedBigInteger('config_rol_id');
            $table->foreign('config_rol_id', 'fk_cmr_configrol')->references('id')->on('config_rol')->onDelete('cascade')->onUpdate('restrict');
            $table->unique(['config_menu_id','config_rol_id'],'cmr_unico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_menu_rol');
    }
};
