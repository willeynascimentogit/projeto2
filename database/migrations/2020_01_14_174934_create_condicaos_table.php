<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondicaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condicaos', function (Blueprint $table) {
            $table->increments('id');
            $table->double('valorFinanciamento');
            $table->double('valorFinAte');
            $table->integer('mesesMin');
            $table->integer('mesesMax');
            $table->float('taxa');
            $table->float('comissaoParc');
            $table->float('comissaoConCred');

            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')->references('id')->on('produtos');

            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->references('id')->on('grupos');

            $table->integer('parametro_id')->unsigned();
            $table->foreign('parametro_id')->references('id')->on('parametros');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condicaos');
    }
}
