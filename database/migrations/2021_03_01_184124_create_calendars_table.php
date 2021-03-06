<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("publication_id");
            $table->dateTime("inicio");
            $table->dateTime("fechaactual");
            $table->dateTime("ultimaclase");
            $table->tinyInteger("cantidadcoutas");
            $table->tinyInteger("cuotaactual");
            $table->decimal("precioclase");
            $table->decimal("porcentajeprofesor");
            $table->timestamps();

            $table->foreign("publication_id")->references("id")->on("publications")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
