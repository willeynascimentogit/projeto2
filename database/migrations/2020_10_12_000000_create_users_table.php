<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('nivel');
            $table->string('telefone');
            $table->date('dataStatus')->nullable();
            $table->date('aceitouTermo')->nullable();
            $table->boolean('status');
            $table->boolean('parametrizavel')->nullable();
            $table->boolean('primeiroAcesso')->nullable();
            $table->integer('companhia_id')->unsigned()->nullable();
            $table->foreign('companhia_id')->references('id')->on('companhias');


            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
