<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers_pays', function (Blueprint $table) {
            $table->id();
            $table->decimal("pago");
            $table->string("estado")->default("A pagar");
            $table->unsignedBigInteger("buy_id");

            $table->foreign("buy_id")->references("id")->on("buys")->onDelete("cascade");
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
        Schema::dropIfExists('teachers_pays');
    }
}
