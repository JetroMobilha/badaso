<?php

namespace Database\Seeders\Badaso;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Models\MenuItem;

class EventosCRUDDataTypeAdded extends Seeder
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

            $data_type = Badaso::model('DataType')->where('name', 'caleventos')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'caleventos')->delete();
            }

            \DB::table(config('badaso.database.prefix').'data_types')->insert(array (
                'name' => 'caleventos',
                'slug' => 'caleventos',
                'display_name_singular' => 'Tarefas',
                'display_name_plural' => 'Tarefas',
                'icon' => 'calendar_today',
                'model_name' => 'Uasoft\\Badaso\\Models\\Evento',
                'policy_name' => NULL,
                'controller' => NULL,
                'order_column' => NULL,
                'order_display_column' => NULL,
                'order_direction' => NULL,
                'generate_permissions' => true,
                'server_side' => false,
                'is_maintenance' => 0,
                'description' => NULL,
                'details' => '"{}"',
                'notification' => '[]',
                'is_soft_delete' => false,
            ));

            Badaso::model('Permission')->generateFor('caleventos');

            $menu = Badaso::model('Menu')->where('key', config('badaso.default_menu'))->firstOrFail();

            $menu_item = Badaso::model('MenuItem')
                ->where('menu_id', $menu->id)
                ->where('url', '/general/caleventos')
                ->first();

            $order = Badaso::model('MenuItem')->highestOrderMenuItem($menu->id);

            if (!is_null($menu_item)) {
                $menu_item->fill([
                    'title' => 'Tarefas',
                    'target' => '_self',
                    'icon_class' => 'calendar_today',
                    'color' => null,
                    'parent_id' => null,
                    'permissions' => 'browse_caleventos',
                    'order' => $order,
                ])->save();
            } else {
                $menu_item = new MenuItem();
                $menu_item->menu_id = $menu->id;
                $menu_item->url = '/general/caleventos';
                $menu_item->title = 'Tarefas';
                $menu_item->target = '_self';
                $menu_item->icon_class = 'calendar_today';
                $menu_item->color = null;
                $menu_item->parent_id = null;
                $menu_item->permissions = 'browse_caleventos';
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
