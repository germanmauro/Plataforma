<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCbuToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("banco")->default("")->after("cuentabancaria")->nullable()->change();
            $table->string("alias")->default("")->after("cuentabancaria")->nullable()->change();
            $table->string("titular")->default("")->after("cuentabancaria")->nullable()->change();
            $table->string("cbu")->default("")->after("cuentabancaria")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
