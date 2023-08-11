<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEmpresasTableClsq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        try {

            Schema::table('empresas', function (Blueprint $table) {
            $table->string('nome', 255)->charset('')->collation('')->change();
			$table->string('pais', 255)->charset('')->collation('')->change();
			$table->string('continente', 255)->charset('')->collation('')->change();
        });

        } catch (PDOException $ex) {
            $this->down();
            throw $ex;
        }*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      /*  Schema::table('empresas', function (Blueprint $table) {
            $table->string('nome', 255)->nullable(true)->charset('')->collation('')->change();
			$table->string('pais', 255)->nullable(true)->charset('')->collation('')->change();
			$table->string('continente', 255)->nullable(true)->charset('')->collation('')->change();
        });*/
    }
}
