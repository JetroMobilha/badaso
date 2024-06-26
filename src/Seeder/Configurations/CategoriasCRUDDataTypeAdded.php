<?php

namespace Database\Seeders\Badaso;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Models\MenuItem;

class CategoriasCRUDDataTypeAdded extends Seeder
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

            $data_type = Badaso::model('DataType')->where('name', 'calcategorias')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'calcategorias')->delete();
            }

            \DB::table(config('badaso.database.prefix').'data_types')->insert(array (
                'name' => 'calcategorias',
                'slug' => 'calcategorias',
                'display_name_singular' => 'Categoria',
                'display_name_plural' => 'Categorias',
                'icon' => 'settings',
                'model_name' => 'Uasoft\\Badaso\\Models\\Categoria',
                'policy_name' => NULL,
                'controller' => NULL,
                'order_column' => 'nome',
                'order_display_column' => 'nome',
                'order_direction' => 'ASC',
                'generate_permissions' => true,
                'server_side' => false,
                'is_maintenance' => 0,
                'description' => NULL,
                'details' => '{}',
                'notification' => '[]',
                'is_soft_delete' => false,
            ));

            Badaso::model('Permission')->generateFor('calcategorias');

            \DB::commit();
        } catch(Exception $e) {
            \DB::rollBack();

           throw new Exception('Exception occur ' . $e);
        }
    }
}
