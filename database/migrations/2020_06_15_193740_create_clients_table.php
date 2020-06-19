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
            $table->date('date_of_admission');
            $table->enum('status',['Activo','Inactivo']);

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('contact_employee_id')->nullable();
            $table->unsignedBigInteger('referred_by_id')->nullable();

            //Foreing
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('contact_employee_id')->references('id')->on('employees');
            $table->foreign('referred_by_id')->references('id')->on('employees');

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
