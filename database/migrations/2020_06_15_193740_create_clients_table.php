<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('first_lastname');
            $table->string('second_lastname')->nullable();
            $table->date('date_of_admission');
            $table->enum('status',['Activo','Inactivo']);

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('contact_user_id')->nullable();
            $table->unsignedBigInteger('referred_id');

            //Foreing
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('contact_user_id')->references('id')->on('users');
            $table->foreign('referred_id')->references('id')->on('users');

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
        Schema::dropIfExists('clients');
    }
}
