<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTableYjao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

            Schema::create('calgrupos', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->string('nome', 255);
			$table->bigInteger(config('badaso.database.prefix').'users_id')->unsigned();
			$table->timestamps();
        });

            Schema::table('calgrupos', function (Blueprint $table) {
            $table->foreign(config('badaso.database.prefix').'users_id')->references('id')->on(config('badaso.database.prefix').'users')->onDelete('no action')->onUpdate('no action');
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
        Schema::dropIfExists('calgrupos');
    }
}
