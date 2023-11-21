<?php

namespace Database\Seeders\Badaso;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;

class CategoriasCRUDDataDeleted extends Seeder
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

			Badaso::model('Permission')->removeFrom('calcategorias');

			$menuItem = Badaso::model('MenuItem')::where('url', '/general/calcategorias');

            if ($menuItem->exists()) {
                $menuItem->delete();
            }

			\DB::commit();
       	} catch(Exception $e) {
        	\DB::rollBack();

        	throw new Exception('Exception occur ' . $e);
       	}
    }
}
