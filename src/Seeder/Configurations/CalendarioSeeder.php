<?php

namespace Database\Seeders\Badaso;

use Database\Seeders\Badaso\CRUD\Badaso_usersCRUDDataRowAdded;
use Database\Seeders\Badaso\CRUD\Badaso_usersCRUDDataTypeAdded;
use Illuminate\Database\Seeder;
use Uasoft\Badaso\Models\Configuration;

class CalendarioSeeder extends Seeder
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
        $this->call( Badaso_usersCRUDDataTypeAdded::class);
        $this->call( Badaso_usersCRUDDataRowAdded::class);

        $this->call( CategoriasCRUDDataTypeAdded::class);
        $this->call( CategoriasCRUDDataRowAdded::class);

        $this->call( EventosCRUDDataTypeAdded::class);
        $this->call( EventosCRUDDataRowAdded::class);

        $this->call( GruposCRUDDataTypeAdded::class);
        $this->call( GruposCRUDDataRowAdded::class);
    }
}
