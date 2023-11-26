<?php

namespace Database\Seeders\Badaso;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Models\MenuItem;

class GruposCRUDDataTypeAdded extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     *
     * @throws Exception
     */
    public function run()
    {
        \DB::beginTransaction();

        try {

            $data_type = Badaso::model('DataType')->where('name', 'calgrupos')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'calgrupos')->delete();
            }

            \DB::table('badaso_data_types')->insert(array (
                'name' => 'calgrupos',
                'slug' => 'calgrupos',
                'display_name_singular' => 'Grupos',
                'display_name_plural' => 'Grupos',
                'icon' => 'work',
                'model_name' =>  'Uasoft\\Badaso\\Models\\Grupo',
                'policy_name' => NULL,
                'controller' => NULL,
                'order_column' => NULL,
                'order_display_column' => NULL,
                'order_direction' => NULL,
                'generate_permissions' => true,
                'server_side' => false,
                'is_maintenance' => 0,
                'description' => NULL,
                'details' => '"{\\"scope\\":\\"empresa\\"}"',
                'notification' => '[]',
                'is_soft_delete' => false,
            ));

            Badaso::model('Permission')->generateFor('calgrupos');

            $menu = Badaso::model('Menu')->where('key', config('badaso.default_menu'))->firstOrFail();

            $menu_item = Badaso::model('MenuItem')
                ->where('menu_id', $menu->id)
                ->where('url', '/general/calgrupos')
                ->first();

            $order = Badaso::model('MenuItem')->highestOrderMenuItem($menu->id);

            if (!is_null($menu_item)) {
                $menu_item->fill([
                    'title' => 'Grupos',
                    'target' => '_self',
                    'icon_class' => 'work',
                    'color' => null,
                    'parent_id' => null,
                    'permissions' => 'browse_calgrupos',
                    'order' => $order,
                ])->save();
            } else {
                $menu_item = new MenuItem();
                $menu_item->menu_id = $menu->id;
                $menu_item->url = '/general/calgrupos';
                $menu_item->title = 'Grupos';
                $menu_item->target = '_self';
                $menu_item->icon_class = 'work';
                $menu_item->color = null;
                $menu_item->parent_id = null;
                $menu_item->permissions = 'browse_calgrupos';
                $menu_item->order = $order;
                $menu_item->save();
            }

            \DB::commit();
        } catch(Exception $e) {
            \DB::rollBack();

           throw new Exception('Exception occur ' . $e);
        }
    }
}
