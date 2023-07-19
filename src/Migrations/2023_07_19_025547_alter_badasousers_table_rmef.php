<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBadasousersTableRmef extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        try {
            Schema::table(config('badaso.database.prefix').'users', function (Blueprint $table) {
            $table->string('empresa', 255)->nullable(true);
        });



        } catch (PDOException $ex) {
            $this->down();
            throw $ex;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
    */
    public function down()
    {
        Schema::table(config('badaso.database.prefix').'users', function (Blueprint $table) {
            $table->dropColumn('empresa');
        });
    }
}
