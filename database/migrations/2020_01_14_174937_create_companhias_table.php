<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanhiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companhias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('cadastro');
            $table->string('endereco');
            $table->string('site');
            $table->string('email');
            $table->string('telefone');
            $table->string('nomeContato');
            $table->date('dataStatus');

            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->references('id')->on('grupos');

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
        Schema::dropIfExists('companhias');
    }
}
