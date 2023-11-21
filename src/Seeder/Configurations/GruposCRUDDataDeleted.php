<?php

namespace Database\Seeders\Badaso;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;

class GruposCRUDDataDeleted extends Seeder
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

			Badaso::model('Permission')->removeFrom('calgrupos');

			$menuItem = Badaso::model('MenuItem')::where('url', '/general/calgrupos');

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
