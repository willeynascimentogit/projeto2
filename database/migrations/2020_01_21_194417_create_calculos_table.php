<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomeSindico')->nullable();
            $table->string('chave');
            $table->string('nomeCondominio')->nullable();;
            $table->string('cnpjCondominio')->nullable();
            $table->integer('prazo');
            $table->string('dataEmissao');
            $table->string('primeiroVencimento');
            $table->string('comissaoInst');
            $table->string('custoTed');
            $table->string('custoBoleto');
            $table->string('tipoFinanciamento');
            $table->string('comissaoParc');
            $table->string('comissaoConCred');
            $table->string('tac');
            $table->string('iof');
            $table->string('valorFinanciamento');
            $table->string('valorFinanciado');
            $table->string('valorFinanciadoAt');
            $table->string('parcela');
            $table->integer('diasPrimeiroVenc');
            $table->integer('user_id');
            $table->date('data');
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
        Schema::dropIfExists('calculos');
    }
}
