<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->dateTime("fecha");
            $table->unsignedBigInteger("publication_id");
            $table->unsignedBigInteger("user_id");
            $table->string("estado",100)->default("generada");
            $table->boolean("aviso30m")->default(false);
            $table->boolean("aviso1h")->default(false);
            $table->smallInteger("calificacion");
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
        Schema::dropIfExists('meetings');
    }
}
