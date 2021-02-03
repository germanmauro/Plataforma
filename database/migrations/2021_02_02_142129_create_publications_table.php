<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("titulo",100);
            $table->string("descripcion",1000);
            $table->string("duracion",100);
            $table->unsignedDecimal("precio");
            $table->string("imagen1", 1000);
            $table->string("imagen2", 1000);
            $table->string("imagen3", 1000);
            $table->string("video", 500);
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("specialty_id");
            $table->string("baja", 20);
            
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("specialty_id")->references("id")->on("specialties")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications');
    }
}
