<?php

namespace Database\Seeders\Badaso;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;

class Badaso_usersCRUDDataTypeAdded extends Seeder
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

            $data_type = Badaso::model('DataType')->where('name', config('badaso.database.prefix').'users')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', config('badaso.database.prefix').'users')->delete();
            }

            \DB::table(config('badaso.database.prefix').'data_types')->insert(array (
                'name' => config('badaso.database.prefix').'users',
                'slug' => config('badaso.database.prefix').'users',
                'display_name_singular' => 'Users',
                'display_name_plural' => 'Users',
                'icon' => NULL,
                'model_name' => 'Uasoft\\Badaso\\Models\\User',
                'policy_name' => NULL,
                'controller' => NULL,
                'order_column' => NULL,
                'order_display_column' => NULL,
                'order_direction' => NULL,
                'generate_permissions' => true,
                'server_side' => false,
                'description' => NULL,
                'details' => '{"scope":"empresa"}',
                'is_soft_delete' => false,
            ));

            Badaso::model('Permission')->generateFor(config('badaso.database.prefix').'users');
  
            \DB::commit();
        } catch(Exception $e) {
            \DB::rollBack();

           throw new Exception('Exception occur ' . $e);
        }
    }
}
