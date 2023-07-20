<?php

namespace Database\Seeders\Badaso;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Models\Configuration;

class EmpresaSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     *
     * @throws Exception
     */
    public function run()
    {
        $this->call( EmpresasCRUDDataTypeAdded::class);
        $this->call( EmpresasCRUDDataRowAdded::class);
    }
}
