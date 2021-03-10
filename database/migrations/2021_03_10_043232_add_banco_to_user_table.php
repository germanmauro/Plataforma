<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBancoToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
                $table->string("banco")->default("")->after("cuentabancaria");
                $table->string("alias")->default("")->after("cuentabancaria");
                $table->string("titular")->default("")->after("cuentabancaria");
                $table->string("cbu")->default("")->after("cuentabancaria");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            //
        });
    }
}
