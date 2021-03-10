<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeingKeyToPaypalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paypal', function (Blueprint $table) {
            $table->dropForeign("paypal_buy_id_foreign");

            $table->foreign("buy_id")->references("id")->on("buys")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paypal', function (Blueprint $table) {
            //
        });
    }
}
