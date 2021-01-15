<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->id();
            $table->string('nombre',100);
            $table->string('apellido',100);
            $table->string('dni',10)->default('0');
            $table->string('direccion',200)->default('0');
            $table->string('usuario',10);
            $table->string('password',200);
            $table->string('email',200);
            $table->string('contrato',3000)->nullable();
            $table->string('titulo',3000)->nullable();
            $table->string('registroaceptado', 20)->default("false");
            $table->string('contratoaceptado', 20)->default("false");
            $table->string('telefono',20)->default('0');
            $table->string('perfil',20);
            $table->string('aceptado',20)->default("false");
            $table->string('cuentabancaria',50)->nullable();
            $table->string('baja',20)->default('false');

            $table->timestamps();
        });
        DB::insert("Insert into users(nombre,apellido,usuario,password,email,perfil) values ('Emmanuel','Perciante','emmanuel','$2y$10\$UkJVr/OvxPrJ4NjHcd4D1eFY.rCaGm/A60/8Wst9rpwI53skL7d.C','emmanuel.perciante85@hotmail.com','admin')");
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
