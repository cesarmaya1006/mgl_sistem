<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigApariencia extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'config_empresa_id' => null,
                'body_dark_mode' => 'no',
                'encabezado_fijo' => 'no',
                'dropdown_legacy' => 'no',
                'border_bottom' => 'no',
                'sidebar_collapse' => 'no',
                'sidebar_fixed_checkbox' => 'si',
                'sidebar_mini_checkbox' => 'si',
                'sidebar_mini_md_checkbox' => 'no',
                'sidebar_mini_xs_checkbox' => 'no',
                'flat_sidebar_checkbox' => 'no',
                'legacy_sidebar_checkbox' => 'no',
                'compact_sidebar_checkbox' => 'no',
                'child_indent_sidebar_checkbox' => 'no',
                'child_hide_sidebar_checkbox' => 'no',
                'no_expand_sidebar_checkbox' => 'no',
                'footer_fixed_checkbox' => 'no',
                'text_sm_body_checkbox' => 'no',
                'text_sm_header_checkbox' => 'no',
                'text_sm_brand_checkbox' => 'no',
                'text_sm_sidebar_container' => 'no',
                'text_sm_footer_checkbox' => 'no',
                'fondo_barra_sup' => 'navbar-light',
                'fondo_barra_lat' => 'bg-light',
                'nombre_empresa' => 'Mgl - Tech',
                'logo_empresa' =>'logo_img.png',
                'logo_shake' => 'mgl_logo.png'

            ],
            [
                'config_empresa_id' => 1,
                'body_dark_mode' => 'no',
                'encabezado_fijo' => 'no',
                'dropdown_legacy' => 'no',
                'border_bottom' => 'no',
                'sidebar_collapse' => 'no',
                'sidebar_fixed_checkbox' => 'si',
                'sidebar_mini_checkbox' => 'si',
                'sidebar_mini_md_checkbox' => 'no',
                'sidebar_mini_xs_checkbox' => 'no',
                'flat_sidebar_checkbox' => 'no',
                'legacy_sidebar_checkbox' => 'no',
                'compact_sidebar_checkbox' => 'no',
                'child_indent_sidebar_checkbox' => 'no',
                'child_hide_sidebar_checkbox' => 'no',
                'no_expand_sidebar_checkbox' => 'no',
                'footer_fixed_checkbox' => 'no',
                'text_sm_body_checkbox' => 'no',
                'text_sm_header_checkbox' => 'no',
                'text_sm_brand_checkbox' => 'no',
                'text_sm_sidebar_container' => 'no',
                'text_sm_footer_checkbox' => 'no',
                'fondo_barra_sup' => 'navbar-light',
                'fondo_barra_lat' => 'bg-light',
                'nombre_empresa' => 'Empucol - ESP',
                'logo_empresa' =>'logo_mini_maya.png',
                'logo_shake' => 'logo_maya.png'

            ],
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('config_apariencia')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        foreach ($datas as $data) {
            DB::table('config_apariencia')->insert([
                'config_empresa_id' => $data['config_empresa_id'],
                'body_dark_mode' => $data['body_dark_mode'],
                'encabezado_fijo' => $data['encabezado_fijo'],
                'dropdown_legacy' => $data['dropdown_legacy'],
                'border_bottom' => $data['border_bottom'],
                'sidebar_collapse' => $data['sidebar_collapse'],
                'sidebar_fixed_checkbox' => $data['sidebar_fixed_checkbox'],
                'sidebar_mini_checkbox' => $data['sidebar_mini_checkbox'],
                'sidebar_mini_md_checkbox' => $data['sidebar_mini_md_checkbox'],
                'sidebar_mini_xs_checkbox' => $data['sidebar_mini_xs_checkbox'],
                'flat_sidebar_checkbox' => $data['flat_sidebar_checkbox'],
                'legacy_sidebar_checkbox' => $data['legacy_sidebar_checkbox'],
                'compact_sidebar_checkbox' => $data['compact_sidebar_checkbox'],
                'child_indent_sidebar_checkbox' => $data['child_indent_sidebar_checkbox'],
                'child_hide_sidebar_checkbox' => $data['child_hide_sidebar_checkbox'],
                'no_expand_sidebar_checkbox' => $data['no_expand_sidebar_checkbox'],
                'footer_fixed_checkbox' => $data['footer_fixed_checkbox'],
                'text_sm_body_checkbox' => $data['text_sm_body_checkbox'],
                'text_sm_header_checkbox' => $data['text_sm_header_checkbox'],
                'text_sm_brand_checkbox' => $data['text_sm_brand_checkbox'],
                'text_sm_sidebar_container' => $data['text_sm_sidebar_container'],
                'text_sm_footer_checkbox' => $data['text_sm_footer_checkbox'],
                'fondo_barra_sup' => $data['fondo_barra_sup'],
                'fondo_barra_lat' => $data['fondo_barra_lat'],
                'nombre_empresa' => $data['nombre_empresa'],
                'logo_empresa' => $data['logo_empresa'],
                'logo_shake' => $data['logo_shake'],

                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
