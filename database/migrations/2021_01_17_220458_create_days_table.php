<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->string("nombre",20);
            $table->timestamps();
        });
        DB::insert("insert into days (nombre) values('Lunes')");
        DB::insert("insert into days (nombre) values('Martes')");
        DB::insert("insert into days (nombre) values('Miercoles')");
        DB::insert("insert into days (nombre) values('Jueves')");
        DB::insert("insert into days (nombre) values('Viernes')");
        DB::insert("insert into days (nombre) values('Sábado')");
        DB::insert("insert into days (nombre) values('Domingo')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days');
    }
}
