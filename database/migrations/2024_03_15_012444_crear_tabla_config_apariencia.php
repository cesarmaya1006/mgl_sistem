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
        Schema::create('config_apariencia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('config_empresa_id')->nullable();
            $table->foreign('config_empresa_id', 'fk_crm_config_empresa_apariencia')->references('id')->on('config_empresa')->onDelete('restrict')->onUpdate('restrict');
            $table->string('body_dark_mode', 100)->nullable();
            $table->string('encabezado_fijo', 100)->nullable();
            $table->string('dropdown_legacy', 100)->nullable();
            $table->string('border_bottom', 100)->nullable();
            $table->string('sidebar_collapse', 100)->nullable();
            $table->string('sidebar_fixed_checkbox', 100)->nullable();
            $table->string('sidebar_mini_checkbox', 100)->nullable();
            $table->string('sidebar_mini_md_checkbox', 100)->nullable();
            $table->string('sidebar_mini_xs_checkbox', 100)->nullable();
            $table->string('flat_sidebar_checkbox', 100)->nullable();
            $table->string('legacy_sidebar_checkbox', 100)->nullable();
            $table->string('compact_sidebar_checkbox', 100)->nullable();
            $table->string('child_indent_sidebar_checkbox', 100)->nullable();
            $table->string('child_hide_sidebar_checkbox', 100)->nullable();
            $table->string('no_expand_sidebar_checkbox', 100)->nullable();
            $table->string('footer_fixed_checkbox', 100)->nullable();
            $table->string('text_sm_body_checkbox', 100)->nullable();
            $table->string('text_sm_header_checkbox', 100)->nullable();
            $table->string('text_sm_brand_checkbox', 100)->nullable();
            $table->string('text_sm_sidebar_container', 100)->nullable();
            $table->string('text_sm_footer_checkbox', 100)->nullable();
            $table->string('fondo_barra_sup', 100)->nullable();
            $table->string('fondo_barra_lat', 100)->nullable();
            $table->string('nombre_empresa', 255);
            $table->string('logo_empresa', 255);


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
        Schema::dropIfExists('config_apariencia');
    }
};
