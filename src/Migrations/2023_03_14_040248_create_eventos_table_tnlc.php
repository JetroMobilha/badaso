<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTableTnlc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

            Schema::create('caleventos', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
            $table->bigInteger('categoria_id')->unsigned();
			$table->string('nome', 255);
            $table->enum('status', ['pendente','em progresso','concluido'])->default('pendente');
			$table->dateTime('data_inicio');
			$table->dateTime('data_fim')->nullable(true);
            $table->string('localizacao', 255)->nullable(true);
            $table->text('descricao')->nullable(true);
            $table->integer('autor');
			$table->timestamps();
        });

        Schema::table('caleventos', function (Blueprint $table) {
            $table->foreign('categoria_id')->references('id')->on(config('badaso.database.prefix').'calcategorias')->onDelete('no action')->onUpdate('no action');
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
        Schema::dropIfExists(config('badaso.database.prefix').'caleventos');
    }
}
