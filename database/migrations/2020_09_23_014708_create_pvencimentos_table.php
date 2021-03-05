<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePvencimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pvencimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('vencimento');
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
        Schema::dropIfExists('pvencimentos');
    }
}
