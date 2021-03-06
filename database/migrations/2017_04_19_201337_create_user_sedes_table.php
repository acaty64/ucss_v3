<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sedes', function (Blueprint $table) {
            $table->increments('id');

            $table->unSignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unSignedInteger('sede_id');
            $table->foreign('sede_id')->references('id')->on('sedes');

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
        Schema::dropIfExists('user_sedes');
    }
}
