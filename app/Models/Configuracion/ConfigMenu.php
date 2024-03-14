<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ConfigMenu extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'config_menu';
    protected $guarded = [];

    //---------------------------------------------------------------
    public function roles ()
    {
        return $this->belongsToMany(ConfigRol::class,'config_menu_rol','config_menu_id','config_rol_id');
    }
    //---------------------------------------------------------------
    public function getHijos($padres, $line)
    {
        $children = [];
        foreach ($padres as $line1) {
            if ($line['id'] == $line1['config_menu_id']) {
                $children = array_merge($children, [array_merge($line1, ['submenu' => $this->getHijos($padres, $line1)])]);
            }
        }
        return $children;
    }
    public function getPadres($front)
    {
        if ($front) {
            return $this->whereHas('roles', function ($query) {
                $query->where('config_rol_id', session()->get('rol_id'))->orderby('config_menu_id');
            })->orderby('config_menu_id')
                ->orderby('orden')
                ->get()
                ->toArray();
        } else {
            return $this->orderby('config_menu_id')
                ->orderby('orden')
                ->get()
                ->toArray();
        }
    }
    public static function getMenu($front = false)
    {
        $menus = new ConfigMenu();
        $padres = $menus->getPadres($front);
        $menuAll = [];
        foreach ($padres as $line) {
            if ($line['config_menu_id'] != 0)
                break;
            $item = [array_merge($line, ['submenu' => $menus->getHijos($padres, $line)])];
            $menuAll = array_merge($menuAll, $item);
        }
        return $menuAll;
    }
    public function guardarOrden($menu)
    {
        $menus = json_decode($menu);
        foreach ($menus as $var => $value) {
            $this->where('id', $value->id)->update(['config_menu_id' => 0, 'orden' => $var + 1]);
            if (!empty($value->children)) {
                foreach ($value->children as $key => $vchild) {
                    $update_id = $vchild->id;
                    $parent_id = $value->id;
                    $this->where('id', $update_id)->update(['config_menu_id' => $parent_id, 'orden' => $key + 1]);
                    if (!empty($vchild->children)) {
                        foreach ($vchild->children as $key => $vchild1) {
                            $update_id = $vchild1->id;
                            $parent_id = $vchild->id;
                            $this->where('id', $update_id)->update(['config_menu_id' => $parent_id, 'orden' => $key + 1]);
                            if (!empty($vchild1->children)) {
                                foreach ($vchild1->children as $key => $vchild2) {
                                    $update_id = $vchild2->id;
                                    $parent_id = $vchild1->id;
                                    $this->where('id', $update_id)->update(['config_menu_id' => $parent_id, 'orden' => $key + 1]);
                                    if (!empty($vchild2->children)) {
                                        foreach ($vchild2->children as $key => $vchild3) {
                                            $update_id = $vchild3->id;
                                            $parent_id = $vchild2->id;
                                            $this->where('id', $update_id)->update(['config_menu_id' => $parent_id, 'orden' => $key + 1]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
